<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Str;
use Hash;
use File;
use DB;
use Session;
use Cookie;
use Validator;
use Redirect,Response;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Post;
use App\Models\Transaction;
use App\Models\PostExtra;
use App\Models\Review;
use App\Models\General;
use App\Models\Country;
use App\Models\Media;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderReturnItem;
use App\Models\Attribute;
use App\Models\Permission;
use App\Models\PostAttribute;
use GuzzleHttp\Client;

use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{

 	// Product management Function
     public function products(Request $r){

      $allPer = empty(json_decode(Auth::user()->permission->permission, true)['products']['all']);
      // Filter Action Start

      if($r->action){
        if($r->checkid){

        $datas=Post::latest()->where('type',2)->whereIn('id',$r->checkid)->get();

        foreach($datas as $data){

          if($allPer && $data->addedby_id!=Auth::id()){
            // You are unauthorized Try!!
          }else{

            if($r->action==1){
              $data->status='active';
              $data->save();
            }elseif($r->action==2){
              $data->status='inactive';
              $data->save();
            }elseif($r->action==3){
              $data->fetured=true;
              $data->save();
            }elseif($r->action==4){
              $data->fetured=false;
              $data->save();
            }elseif($r->action==5){
              
              $medias =Media::latest()->where('src_type',1)->where('src_id',$data->id)->get();
              foreach($medias as $media){
                if(File::exists($media->file_url)){
                  File::delete($media->file_url);
                }
                $media->delete();
              }

              $data->productCtgs()->delete();
              $data->delete();
            }

          }

        }

        Session()->flash('success','Action Successfully Completed!');

        }else{
          Session()->flash('info','Please Need To Select Minimum One Post');
        }

        return redirect()->back();
      }

      //Filter Action End
      
        
      $products =Post::latest()->where('type',2)
        ->where(function($q) use ($r,$allPer) {

            if($r->search){
                $q->where('name','LIKE','%'.$r->search.'%');
            }
            
            if($r->startDate || $r->endDate)
            {
                if($r->startDate){
                    $from =$r->startDate;
                }else{
                    $from=Carbon::now()->format('Y-m-d');
                }

                if($r->endDate){
                    $to =$r->endDate;
                }else{
                    $to=Carbon::now()->format('Y-m-d');
                }

                $q->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to);
            }

            if($r->status){
             $q->where('status',$r->status); 
            }

            // Check Permission
            if($allPer){
             $q->where('addedby_id',auth::id()); 
            }


        })
        ->select(['id','name','final_price','slug','view','type','weight_unit','weight_amount','brand_id','created_at','addedby_id','status','fetured'])
        ->paginate(25)->appends([
          'search'=>$r->search,
          'status'=>$r->status,
          'startDate'=>$r->startDate,
          'endDate'=>$r->endDate,
        ]);
        
        
        //Total Count Results
        $totals = DB::table('posts')
        ->where('type',2)
        ->selectRaw('count(*) as total')
        ->selectRaw("count(case when status = 'active' then 1 end) as active")
        ->selectRaw("count(case when status = 'inactive' then 1 end) as inactive")
        ->selectRaw("count(case when status = 'temp' then 1 end) as temp")
        ->first();

        return view(adminTheme().'products.productsAll',compact('products','totals','r'));
    }

    public function productsAction(Request $r,$action,$id=null){
        
        if($action=='create'){
          $product =Post::where('type',2)->where('status','temp')->where('addedby_id',Auth::id())->first();
          if(!$product){
            $product =new Post();
            $product->type =2;
            $product->status ='temp';
            $product->addedby_id =Auth::id();
          }
          $product->discount =10;
          $product->created_at =Carbon::now();
          $product->save();
          return redirect()->route('admin.productsAction',['edit',$product->id]);
        }

        $product =Post::where('type',2)->find($id);
        if(!$product){
          Session()->flash('error','This Product Are Not Found');
          return redirect()->route('admin.products');
        }

        //Check Authorized User
        $allPer = empty(json_decode(Auth::user()->permission->permission, true)['products']['all']);
        if($allPer && $product->addedby_id!=Auth::id()){
          Session()->flash('error','You are unauthorized Try!!');
          return redirect()->route('admin.products');
        }


        if($action=='view'){
          return view(adminTheme().'products.productsView',compact('product'));
        }

        if($action=='update'){
            
        $check = $r->validate([
            'name' => 'required|max:191',
            'seo_title' => 'nullable|max:200',
            'seo_description' => 'nullable|max:250',
            'catagoryid.*' => 'nullable|numeric',
            'brand' => 'nullable|numeric',
            'tags.*' => 'nullable|numeric',
            'branchs.*' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'gallery_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if(!$check){
            Session::flash('error','Need To validation');
            return back();
        }

        $product->name=$r->name;
        $product->short_description=$r->short_description;
        $product->description=$r->description;
        $product->seo_title=$r->seo_title;
        $product->seo_description=$r->seo_description;
        $product->seo_keyword=$r->seo_keyword;
        $product->brand_id=$r->brand;

        ///////Image Uploard Start////////////
        if($r->hasFile('image')){
          $file =$r->image;
          $src  =$product->id;
          $srcType  =1;
          $fileUse  =1;
          
          uploadFile($file,$src,$srcType,$fileUse);
        }
        ///////Image Uploard End////////////

        ///////Gallery Uploard Start////////////
        $files=$r->file('gallery_image');
        if($files){
            foreach($files as $file)
            {
                $file =$file;
                $src =$product->id;
                $srcType =1;
                $fileUse =3;
                $author =Auth::id();
                $fileStatus=false;
                uploadFile($file,$src,$srcType,$fileUse,$author,$fileStatus);
            }
        }
        ///////Gallery Uploard End////////////

        $slug =Str::slug($r->name);
        if($slug==null){
        $product->slug=$product->id;
        }else{
        if(Post::where('type',2)->where('slug',$slug)->whereNotIn('id',[$product->id])->count() >0){
        $product->slug=$slug.'-'.$product->id;
        }else{
        $product->slug=$slug;
        }
        }
        if($r->created_at){
          $product->created_at =$r->created_at;
        }
        $product->status =$r->status?'active':'inactive';
        $product->fetured =$r->fetured?1:0;
        $product->bestSale =$r->bestSale?1:0;
        $product->editedby_id =Auth::id();
        $product->save();

      //Category posts
      if($r->categoryid){

      $product->productCtgs()->whereNotIn('reff_id',$r->categoryid)->delete();

       for ($i=0; $i < count($r->categoryid); $i++) {

        $ctg = $product->productCtgs()->where('reff_id',$r->categoryid[$i])->first();

        if($ctg){}else{
        $ctg =new PostAttribute();
        $ctg->src_id=$product->id;
        $ctg->reff_id=$r->categoryid[$i];
        $ctg->type=0;
        }
        $ctg->drag=$i;
        $ctg->save();
       }

     }else{
        $product->productCtgs()->delete();
       }


       //Tags posts
      if($r->tags){

      $product->productTags()->whereNotIn('reff_id',$r->tags)->delete();

       for ($i=0; $i < count($r->tags); $i++) {

        $tag = $product->productTags()->where('reff_id',$r->tags[$i])->first();

        if($tag){}else{
        $tag =new PostAttribute();
        $tag->src_id=$product->id;
        $tag->reff_id=$r->tags[$i];
        $tag->type=4;
        }
        $tag->drag=$i;
        $tag->save();
       }

     }else{
        $product->productTags()->delete();
       }
       
      //Tags posts
      if($r->branchs){

      $product->productBranches()->whereNotIn('reff_id',$r->branchs)->delete();

       for ($i=0; $i < count($r->branchs); $i++) {

        $tag = $product->productBranches()->where('reff_id',$r->branchs[$i])->first();

        if($tag){}else{
        $tag =new PostAttribute();
        $tag->src_id=$product->id;
        $tag->reff_id=$r->branchs[$i];
        $tag->type=5;
        }
        $tag->drag=$i;
        $tag->save();
       }

     }else{
        $product->productBranches()->delete();
       }
       
      //Attribute Serialize Date
      if($r->attributeSerial){
        for ($i=0; $i < count($r->attributeSerial); $i++) {
          $data = $product->productAttibutes()->find($r->attributeSerial[$i]);
          if($data){
            $data->drag=$i;
            $data->save();
          }
        }
      }

      if($r->extraAttributeSerial){
        for ($i=0; $i < count($r->extraAttributeSerial); $i++) {
          $data = $product->extraAttribute()->find($r->extraAttributeSerial[$i]);
          if($data){
            $data->drag=$i;
            $data->save();
          }
        }
      }
      //Attribute Serialize Date

        Session()->flash('success','Your Are Successfully Done');
        return redirect()->back();
      }

      if($action=='delete'){
        $medias =Media::latest()->where('src_type',1)->where('src_id',$product->id)->get();
          foreach($medias as $media){
            if(File::exists($media->file_url)){
              File::delete($media->file_url);
            }
            $media->delete();
          }

        $product->productCtgs()->delete();
        $product->delete();

        Session()->flash('success','Your Are Successfully Done');
        return redirect()->back();
      }

      $categories =Attribute::where('type',0)->where('status','<>','temp')->where('parent_id',null)->get();
      $brands =Attribute::where('type',2)->where('status','<>','temp')->where('parent_id',null)->get();
      $attributes =Attribute::where('type',9)->where('status','active')->where('parent_id',null)->get();
      $tags =Attribute::where('type',10)->where('status','active')->where('parent_id',null)->get();
      $branchs =Attribute::where('type',13)->where('status','<>','temp')->where('parent_id',null)->get();

      $attriMessage ='';
      $selectSku =array();

      

      if($r->skus){
        //return $r;

        for ($i=0; $i < count($r->skus); $i++) { 
          
          $result = $r->skus[$i];
          if($result){

            $result_explode = explode('|', $result);

            $list =array('item'=>$result_explode[0],'skuid'=>$result_explode[1]);

            $selectSku =array(
                'items' => $list,
            );

          }


        }

      }
  
      $selectItems ='';
      
      return view(adminTheme().'products.productsEdit',compact('product','categories','brands','attributes','tags','branchs','attriMessage','selectSku','selectItems','r'));

    }


    public function productsUpdateAjax(Request $r,$column,$id){

      $product =Post::where('type',2)->find($id);
      $attriMessage='';
      if($r->ajax() && $product){

        //Product Attribute Filters
        if($column=='attributesItemFilter'){
          $attri =Attribute::where('type',9)->where('parent_id',null)->find($r->attriID);
          if($attri){
            $viewData = view(adminTheme().'products.includes.attritubeItems',compact('product','attri'))->render();
            return Response()->json([
                'success' => true,
                'viewData' => $viewData,
            ]);

          }
        }

        //Product Attribute 
        if($column=='attributesItemAdd' || $column=='attributesItemDelete' || $column=='attributesItemColor' || $column=='attributesItemImage'){


          if($column=='attributesItemAdd'){
            $attri =Attribute::where('type',9)->where('parent_id','<>',null)->find($r->attriID);
            if($attri){
              $data =$product->productAttibutes()->where('parent_id',$attri->id)->first();
              if(!$data){
                $data =new PostAttribute();
                $data->src_id=$product->id; //Product ID
                $data->parent_id=$attri->id; //Attribute Items ID
                $data->reff_id=$attri->parent_id; //Main Attribute ID
                $data->type=3;
                $data->addedby_id=auth::id();
                $data->save();
              }else{
                $attriMessage='<span class="text-danger">Already Added Attribute item!</span>';
              }
            }
          }

          if($column=='attributesItemColor'){
            $data =$product->productAttibutes()->find($r->attriID);
            if($data){
              $data->value_1=$r->attriValue?:null;
              $data->save();
            }
          }


          if($column=='attributesItemImage'){
            $data =$product->productAttibutes()->find($r->attriID);
            if($r->hasFile('attriValue')){
              $file =$r->attriValue;
              $src  =$data->id;
              $srcType  =8;
              $fileUse  =1;
              uploadFile($file,$src,$srcType,$fileUse);
            }
            ///////Image Uploard End////////////
        }
        


        if($column=='attributesItemDelete'){
            $data =$product->productAttibutes()->find($r->attriID);
            if($data){
              //More Additional Work..
              if($data->imageFile){
                if(File::exists($data->imageFile->file_url)){
                      File::delete($data->imageFile->file_url);
                  }
              }
              if(count($product->productSkus()->where('parent_id',$data->parent_id)->pluck('sku_id'))>0){
                $product->productSkus()->whereIn('sku_id',$product->productSkus()->where('parent_id',$data->parent_id)->pluck('sku_id'))->delete();
              }
              $data->delete();
            }
        }

          $viewData = view(adminTheme().'products.includes.attributeItemsList',compact('product','attriMessage'))->render();
          $viewData2 = view(adminTheme().'products.includes.productVariation',compact('product','attriMessage'))->render();
          return Response()->json([
              'success' => true,
              'viewData' => $viewData,
              'viewData2' => $viewData2,
          ]);
        //Product Attribute End
        }


        //Product Variations Start
        if($column=='priceVariationStatus'){
          $product->variation_status=$product->variation_status?false:true;
          $product->save();

          $viewData = view(adminTheme().'products.includes.productVariation',compact('product','attriMessage'))->render();

          return Response()->json([
              'success' => true,
              'viewData' => $viewData,
          ]);

        }

        if($column=='variationItemsAdd' || $column=='variationItemsDelete'){
            
            if($column=='variationItemsDelete'){
                $product->productSkus()->where('sku_id',$r->skuId)->delete();
            }
            
            if($column=='variationItemsAdd'){
    
              if($r->variationItems){
    
                $uniIDS =$product->id;
                for ($i=0; $i < count($r->variationItems); $i++) {
                  $uniIDS.=$r->variationItems[$i];
                }
    
                $checkSku =$product->productSkus()->where('sku_id',$uniIDS)->first();
    
                if($checkSku){
                  $attriMessage ='<span class="text-danger">Already Added Items!!</span>';
                }else{
                    //Sku Items 
                    for ($i=0; $i < count($r->variationItems); $i++) {
                      if($r->variationItems[$i]!=null){
    
                          $attri =Attribute::where('type',9)->where('parent_id','<>',null)->find($r->variationItems[$i]);
                          if($attri){
                            $data =new PostAttribute();
                            $data->src_id=$product->id; //Product ID
                            $data->parent_id=$attri->id; //Attribute Items ID
                            $data->reff_id=$attri->parent_id; //Main Attribute ID
                            $data->sku_id=$uniIDS; //Sku  ID
                            $data->type=4;
                            $data->addedby_id=auth::id();
                            $data->save();
                          }
                      }
                    }
                  
                }
    
              }else{
                $attriMessage ='<span class="text-danger">Please Select Variation Items!!</span>';
              }
            }
            
              $viewData = view(adminTheme().'products.includes.productVariation',compact('product','attriMessage'))->render();
              return Response()->json([
                  'success' => true,
                  'viewData' => $viewData,
              ]);
           
            
        }
        
        //Product Variations End


        //Extra Product Attribute
        if($column=='extraAttributeAdd' || $column=='extraAttributeDelete'){

          //Extra Product Attribute Add
          if($column=='extraAttributeAdd'){
            $extraAttribue =new PostExtra();
            $extraAttribue->src_id=$product->id;
            $extraAttribue->type=2;
            $extraAttribue->name=Str::limit($r->title,150);
            $extraAttribue->content=Str::limit($r->value,150);
            $extraAttribue->save(); 
          }

          //Extra Product Attribute Delete
          if($column=='extraAttributeDelete'){
              $extraAttri =PostExtra::where('type',2)->find($r->attriID);
              if($extraAttri){
                $extraAttri->delete();
              }
          }
          

          $viewData = view(adminTheme().'products.includes.extraAttributeList',compact('product'))->render();

          return Response()->json([
                'success' => true,
                'viewData' => $viewData,
            ]);

        }


        if($column=='discount'){
          $product->discount=$r->data?:0;
          $product->save();
        }
        
        if($column=='pos_price'){
          $product->pos_price=$r->data?:0;
          $product->save();
        }
        
        

        if($column=='discount_type'){
          $product->discount_type=$r->data?:null;
          $product->save();
        }

        if($column=='regular_price'){
          $product->regular_price=$r->data?:0;
          $product->save();
        }

        if($column=='discount' || $column=='discount_type' || $column=='regular_price'){

          if($product->discount_type=='flat' && $product->discount < $product->regular_price){
            $product->final_price =$product->regular_price - $product->discount;
          }elseif($product->discount_type=='percent' &&  $product->discount < 100 || $product->regular_price > 0){
            $product->final_price =round($product->regular_price - ($product->regular_price * $product->discount/100));
          }else{
            $product->final_price=$product->regular_price;
          }

          $product->save();

        }


        if($column=='purchase_price'){
          $product->purchase_price=$r->data?:0;
          $product->save();
        }

        if($column=='quantity'){
          $product->quantity=$r->data?:null;
          $product->save();
        }

        if($column=='stock_out_limit'){
          $product->stock_out_limit=$r->data?:0;
          $product->save();
        }

        if($column=='sku_code'){
          $product->sku_code=$r->data?:null;
          $product->save();
        }
        
        if($column=='stock_status'){
          $product->stock_status=$r->data==0?0:1;
          $product->save();
        }

        if($column=='bar_code'){
          $product->bar_code=$r->data?:null;
          $product->save();
        }

        if($column=='offer_start_date'){
          $product->offer_start_date=$r->data?:null;
          $product->save();
        }

        if($column=='offer_end_date'){
          $product->offer_end_date=$r->data?:null;
          $product->save();
        }

        if($column=='min_order_quantity'){
          $product->min_order_quantity=$r->data?:1;
          $product->save();
        }

        if($column=='max_order_quantity'){
          $product->max_order_quantity=$r->data?:null;
          $product->save();
        }

        if($column=='weight_unit'){
          $product->weight_unit=$r->data?Str::limit($r->data,100):null;
          $product->save();
        }
        if($column=='weight_amount'){
          $product->weight_amount=$r->data?Str::limit($r->data,50):null;
          $product->save();
        }
        if($column=='weight_per_pices'){
          $product->weight_per_pices=$r->data?Str::limit($r->data,100):null;
          $product->save();
        }
        if($column=='weight_per_ices'){
          $product->weight_per_ices=$r->data?:null;
          $product->save();
        }
        if($column=='weight_per_quantity'){
          $product->weight_per_quantity=$r->data?:null;
          $product->save();
        }
        if($column=='dimensions_unit'){
          $product->dimensions_unit=$r->data?Str::limit($r->data,100):null;
          $product->save();
        }

        if($column=='dimensions_length'){
          $product->dimensions_length=$r->data?Str::limit($r->data,50):null;
          $product->save();
        }

        if($column=='dimensions_width'){
          $product->dimensions_width=$r->data?Str::limit($r->data,50):null;
          $product->save();
        }

        if($column=='dimensions_height'){
          $product->dimensions_height=$r->data?Str::limit($r->data,50):null;
          $product->save();
        }


        return Response()->json([
                'success' => true,
            ]);

      }
    }
  // Products Management Function End


  //Products Category Function
  public function productsCategories(Request $r){

    $allPer = empty(json_decode(Auth::user()->permission->permission, true)['productsCtg']['all']);
    // Filter Action Start

      if($r->action){
        if($r->checkid){

          $datas=Attribute::where('type',0)->whereIn('id',$r->checkid)->get();

          foreach($datas as $data){

            if($allPer && $data->addedby_id!=Auth::id()){
              // You are unauthorized Try!!
            }else{

              if($r->action==1){
                $data->status='active';
                $data->save();
              }elseif($r->action==2){
                $data->status='inactive';
                $data->save();
              }elseif($r->action==3){
                $data->fetured=true;
                $data->save();
              }elseif($r->action==4){
                $data->fetured=false;
                $data->save();
              }elseif($r->action==5){
                
                $medias =Media::latest()->where('src_type',3)->where('src_id',$data->id)->get();
                foreach($medias as $media){
                  if(File::exists($media->file_url)){
                    File::delete($media->file_url);
                  }
                  $media->delete();
                }

                //Post Category sub Category replace
                foreach($data->subctgs as $subctg){
                  $subctg->parent_id=$data->parent_id;
                  $subctg->save();
                }
                
                $data->delete();
              }

            }
          }

          Session()->flash('success','Action Successfully Completed!');

        }else{
          Session()->flash('info','Please Need To Select Minimum One Post');
        }

        return redirect()->back();
      }

      //Filter Action End

      $categories =Attribute::latest()->where('type',0)->where('status','<>','temp')
      ->where(function($q) use ($r,$allPer) {

            if($r->search){
                $q->where('name','LIKE','%'.$r->search.'%');
            }

            if($r->status){
              $q->where('status',$r->status); 
            }

          // Check Permission
            if($allPer){
            $q->where('addedby_id',auth::id()); 
            }

      })
      ->select(['id','name','slug','parent_id','view','type','created_at','addedby_id','status','fetured'])
          ->paginate(25)->appends([
            'search'=>$r->search,
            'status'=>$r->status,
          ]);

      //Total Count Results
      $totals = DB::table('attributes')->where('status','<>','temp')
      ->where('type',0)
      ->selectRaw('count(*) as total')
      ->selectRaw("count(case when status = 'active' then 1 end) as active")
      ->selectRaw("count(case when status = 'inactive' then 1 end) as inactive")
      ->selectRaw("count(case when status = 'temp' then 1 end) as temp")
      ->first();

      
      return view(adminTheme().'products.category.categoriesAll',compact('categories','totals','r'));

  }

  public function productsCategoriesAction(Request $r,$action,$id=null){
      if($action=='create'){

        $category =Attribute::where('type',0)->where('status','temp')->where('addedby_id',Auth::id())->first();
        if(!$category){
          $category =new Attribute();
          $category->type =0;
          $category->status ='temp';
          $category->addedby_id =Auth::id();
        }
        $category->created_at =Carbon::now();
        $category->save();
        return redirect()->route('admin.productsCategoriesAction',['edit',$category->id]);
      }
      $category =Attribute::where('type',0)->find($id);
      if(!$category){
        Session()->flash('error','This Category Are Not Found');
        return redirect()->route('admin.productsCategories');
      }

      //Check Authorized User
      $allPer = empty(json_decode(Auth::user()->permission->permission, true)['productsCtg']['all']);
      if($allPer && $category->addedby_id!=Auth::id()){
        Session()->flash('error','You are unauthorized Try!!');
        return redirect()->route('admin.productsCategories');
      }
      
      if($action=='update'){
        $check = $r->validate([
            'name' => 'required|max:191',
            'seo_title' => 'nullable|max:200',
            'seo_description' => 'nullable|max:200',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        
        $createDate = $r->created_at ? Carbon::parse($r->created_at . ' ' . Carbon::now()->format('H:i:s')) : Carbon::now();
        
        $category->name=$r->name;
        $category->description=$r->description;
        $category->seo_title=$r->seo_title;
        $category->seo_description=$r->seo_description;
        $category->seo_keyword=$r->seo_keyword;
        if($r->parent_id==$category->parent_id){}else{
          $category->parent_id=$r->parent_id;
        }
        
        ///////Image Uploard Start////////////
        if($r->hasFile('image')){
          $file =$r->image;
          $src  =$category->id;
          $srcType  =3;
          $fileUse  =1;
          
          uploadFile($file,$src,$srcType,$fileUse);
        }
        ///////Image Uploard End////////////

      ///////Banner Uploard End////////////

        if($r->hasFile('banner')){
          $file =$r->banner;
          $src  =$category->id;
          $srcType  =3;
          $fileUse  =2;
          
          uploadFile($file,$src,$srcType,$fileUse);
        }

      ///////Banner Uploard End////////////


        $slug =Str::slug($r->name);
        if($slug==null){
          $category->slug=$category->id;
        }else{
          if(Attribute::where('type',0)->where('slug',$slug)->whereNotIn('id',[$category->id])->count() >0){
          $category->slug=$slug.'-'.$category->id;
          }else{
          $category->slug=$slug;
          }
        }
        if (!$createDate->isSameDay($category->created_at)) {
            $category->created_at = $createDate;
          }
        $category->status =$r->status?'active':'inactive';
        $category->fetured =$r->fetured?1:0;
        $category->editedby_id =Auth::id();
        $category->save();
        Session()->flash('success','Your Are Successfully Done');
        return redirect()->back();
      }

      if($action=='delete'){
        //Category Media File Delete
        $medias =Media::latest()->where('src_type',3)->where('src_id',$category->id)->get();
        foreach($medias as $media){
          if(File::exists($media->file_url)){
            File::delete($media->file_url);
          }
          $media->delete();
        }

        //Product Category sub Category replace
        foreach($category->subctgs as $subctg){
          $subctg->parent_id=$category->parent_id;
          $subctg->save();
        }
        
        $category->delete();

        Session()->flash('success','Your Are Successfully Done');
        return redirect()->back();
      }

      $parents =Attribute::where('type',0)->where('status','<>','temp')->where('parent_id',null)->get();

      return view(adminTheme().'products.category.categoryEdit',compact('category','parents'));


  }

    //Product Category Function End

    //Product Tags Function
  
  public function productsTags(Request $r){

      $allPer = empty(json_decode(Auth::user()->permission->permission, true)['productsCtg']['all']);
      // Filter Action Start

      if($r->action){
        if($r->checkid){

        $datas=Attribute::where('type',10)->whereIn('id',$r->checkid)->get();

        foreach($datas as $data){

          if($allPer && $data->addedby_id!=Auth::id()){
            // You are unauthorized Try!!
          }else{

            if($r->action==1){
              $data->status='active';
              $data->save();
            }elseif($r->action==2){
              $data->status='inactive';
              $data->save();
            }elseif($r->action==5){
              $data->delete();
            }

          }


        }

        Session()->flash('success','Action Successfully Completed!');

        }else{
          Session()->flash('info','Please Need To Select Minimum One Post');
        }

        return redirect()->back();
      }

    //Filter Action End

      $tags =Attribute::latest()->where('type',10)
      ->where(function($q) use($r){

        if($r->search){
          $q->where('name','like','%'.$r->search.'%');
        }
        
      })
      ->paginate(25);

      //Total Count Results
    $totals = DB::table('attributes')
    ->where('type',10)
    ->selectRaw('count(*) as total')
    ->selectRaw("count(case when status = 'active' then 1 end) as active")
    ->selectRaw("count(case when status = 'inactive' then 1 end) as inactive")
    ->first();

      return view(adminTheme().'products.tags.tagsAll',compact('tags','totals','r'));
  }

  public function productsTagsAction(Request $r,$action,$id=null){
      if($action=='create'){
        $tag =Attribute::where('type',10)->where('status','temp')->where('addedby_id',Auth::id())->first();
        if(!$tag){
          $tag =new Attribute();
          $tag->type =10;
          $tag->status ='temp';
          $tag->addedby_id =Auth::id();
        }
        $tag->created_at=Carbon::now();
        $tag->save();
        return redirect()->route('admin.productsTagsAction',['edit',$tag->id]);
      }

      $tag =Attribute::where('type',10)->find($id);
      if(!$tag){
        Session()->flash('error','This Tag Are Not Found');
        return redirect()->route('admin.productsTags');
      }

      //Check Authorized User
      $allPer = empty(json_decode(Auth::user()->permission->permission, true)['productsCtg']['all']);
      if($allPer && $tag->addedby_id!=Auth::id()){
        Session()->flash('error','You are unauthorized Try!!');
        return redirect()->route('admin.productsTags');
      }

      if($action=='update'){
        $check = $r->validate([
            'name' => 'required|max:191|unique:attributes,name,'.$tag->id,
        ]);

        $tag->name=$r->name;
        $tag->description=$r->description;
        $tag->status =$r->status?'active':'inactive';
        $tag->addedby_id =Auth::id();
        $tag->save();

        Session()->flash('success','Your Are Successfully Done');
        return redirect()->back();
      }

      if($action=='update'){
        $tag->delete();
        Session()->flash('success','Your Are Successfully Done');
        return redirect()->back();
      }

      return view(adminTheme().'products.tags.tagEdit',compact('tag'));
  }

    //Product Tags Function End

    //Product Attributes Function 
  public function productsAttributes(Request $r){
      // Filter Action Start

      if($r->action){
        if($r->checkid){

        $datas=Attribute::latest()->where('type',9)->where('status','<>','temp')->whereIn('id',$r->checkid)->get();

        foreach($datas as $data){

            if($r->action==1){
              $data->status='active';
              $data->save();
            }elseif($r->action==2){
              $data->status='inactive';
              $data->save();
            }elseif($r->action==5){
              
              foreach($data->subAttributes as $item){

                $medias =Media::latest()->where('src_type',3)->where('src_id',$item->id)->get();
                foreach($medias as $media){
                  if(File::exists($media->file_url)){
                    File::delete($media->file_url);
                  }
                  $media->delete();
                }

                $item->delete();

              }

              $data->delete();
            }

        }

        Session()->flash('success','Action Successfully Completed!');

        }else{
          Session()->flash('info','Please Need To Select Minimum One Post');
        }

        return redirect()->back();
      }

      //Filter Action End

      $attributes=Attribute::latest()->where('type',9)->where('status','<>','temp')->where('parent_id',null)
        ->where(function($q) use ($r) {

          if($r->search){
              $q->where('name','LIKE','%'.$r->search.'%');
          }

      })
      ->paginate(25)->appends([
        'search'=>$r->search,
      ]);

      return view(adminTheme().'products.attributes.attributesAll',compact('attributes'));
  }

  public function productsAttributesAction(Request $r,$action,$id=null){
    // if($action=='create'){
    //   $attribute =Attribute::latest()->where('type',9)->where('addedby_id',Auth::id())->where('status','temp')->first();
    //   if(!$attribute){
    //   $attribute =new Attribute();
    //   $attribute->type =9;
    //   $attribute->status ='temp';
    //   $attribute->addedby_id =Auth::id();
    //   $attribute->save();
    //   }else{
    //   $attribute->parent_id =null;
    //   $attribute->created_at =Carbon::now();
    //   $attribute->save();
    //   }
    //   return redirect()->route('admin.productsAttributesAction',['edit',$attribute->id]);
    // }

    $attribute =Attribute::where('type',9)->where('parent_id',null)->find($id);
    if(!$attribute){
      Session()->flash('error','This Attribute Are Not Found');
      return redirect()->route('admin.productsAttributes');
    }

    if($action=='update'){
      
      $check = $r->validate([
          'name' => 'required|max:191',
      ]);

      if(!$check){
          Session::flash('error','Need To validation');
          return back();
      }
      //View =1=text,2=color,3=image
      $attribute->name=$r->name;
      $attribute->description=$r->description;
      $attribute->view=$r->type;
      $slug =Str::slug($r->name);
      if($slug==null){
        $attribute->slug=$attribute->id;
      }else{
        if(Attribute::where('type',9)->where('slug',$slug)->whereNotIn('id',[$attribute->id])->count() >0){
        $attribute->slug=$slug.'-'.$attribute->id;
        }else{
        $attribute->slug=$slug;
        }
      }
      $attribute->status =$r->status?'active':'inactive';
      $attribute->fetured =$r->fetured?1:0;
      $attribute->editedby_id =Auth::id();
      $attribute->save();

      Session()->flash('success','Your Are Successfully Done');
      return redirect()->back();
    }
    
    // if($action=='delete'){

    //   $attribute->subAttributes()->delete();
    //   $attribute->delete();

    //   Session()->flash('success','Your Are Successfully Done');
    //   return redirect()->back();
    // }


    if($r->checkid){

      $datas=$attribute->subAttributes()->whereIn('id',$r->checkid)->get();

      foreach($datas as $data){

          if($r->action==5){
            
            $medias =Media::latest()->where('src_type',3)->where('src_id',$data->id)->get();
            foreach($medias as $media){
              if(File::exists($media->file_url)){
                File::delete($media->file_url);
              }
              $media->delete();
            }

            $data->delete();
          }

      }

      Session()->flash('success','Action Successfully Completed!');
      return back();
    }

    $items=$attribute->subAttributes()
        ->where(function($q) use ($r) {

          if($r->search){
              $q->where('name','LIKE','%'.$r->search.'%');
          }

      })
      ->paginate(50)->appends([
        'search'=>$r->search,
      ]);


    return view(adminTheme().'products.attributes.attributesEdit',compact('attribute','r','items'));
  }

  public function productsAttributesItemAction(Request $r,$action,$id){
    if($action=='create'){
      $attribute =Attribute::where('type',9)->find($id);
      if(!$attribute){
        Session()->flash('error','This Attribute Are Not Found');
        return redirect()->route('admin.productsAttributes');
      }

      $attributeItem =Attribute::latest()->where('type',9)->where('parent_id',$attribute->id)->where('addedby_id',Auth::id())->where('status','temp')->first();
      if(!$attributeItem){
      $attributeItem =new Attribute();
      $attributeItem->type =9;
      $attributeItem->parent_id =$attribute->id;
      $attributeItem->status ='temp';
      $attributeItem->addedby_id =Auth::id();
      $attributeItem->save();
      }else{
      $attributeItem->parent_id =$attribute->id;
      $attributeItem->created_at =Carbon::now();
      $attributeItem->save();
      }
      return redirect()->route('admin.productsAttributesItemAction',['edit',$attributeItem->id]);

    }

    $attribute =Attribute::where('type',9)->find($id);
    if(!$attribute){
      Session()->flash('error','This Attribute Item Are Not Found');
      return redirect()->route('admin.productsAttributes');
    }

    if($action=='update'){
        $check = $r->validate([
          'name' => 'required|max:191',
          'color' => 'nullable|max:191',
          'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

      //View =1=text,2=color,3=image
      $hasAttribute =Attribute::where('type',9)->where('name',$r->name)->where('id','<>',$attribute->id)->first();
      if($hasAttribute){
        Session()->flash('error','This Attribute Item Name Already');
        return redirect()->back();
      }
      $attribute->name=$r->name;
      $attribute->description=$r->description;
      $attribute->icon=$r->color;

      ///////Image Uploard Start////////////
        if($r->hasFile('image')){
          $file =$r->image;
          $src  =$attribute->id;
          $srcType  =3;
          $fileUse  =1;
          
          uploadFile($file,$src,$srcType,$fileUse);
        }
        ///////Image Uploard End////////////


      $slug =Str::slug($r->name);
      if($slug==null){
        $attribute->slug=$attribute->id;
      }else{
        if(Attribute::where('type',9)->where('slug',$slug)->whereNotIn('id',[$attribute->id])->count() >0){
        $attribute->slug=$slug.'-'.$attribute->id;
        }else{
        $attribute->slug=$slug;
        }
      }
      $attribute->status ='active';
      $attribute->editedby_id =Auth::id();
      $attribute->save();
      Session()->flash('success','Your Are Successfully Done');
      return redirect()->back();
    }

    return view(adminTheme().'products.attributes.attributesItemEdit',compact('attribute'));

  }


    public function ecommerceSetting(Request $r,$action){
        $general =general();
        if($action=='general'){
            
        if($r->isMethod('post')){
            
            $check = $r->validate([
              'currency' => 'nullable|max:10',
              'currency_decimal' => 'nullable|numeric',
              'currency_position' => 'nullable|numeric',
              'inside_dhaka_shipping_charge' => 'nullable|numeric',
              'outside_metro_charge' => 'nullable|numeric',
              'outside_dhaka_shipping_charge' => 'nullable|numeric',
              'minimum_shopping' => 'nullable|numeric',
              'product_discount' => 'nullable|numeric',
              'tax' => 'nullable|numeric',
              'tax_status' => 'nullable|numeric',
            ]);
        
            $general->currency=$r->currency;
            $general->currency_decimal=$r->currency_decimal;
            $general->currency_position=$r->currency_position;
            $general->inside_dhaka_shipping_charge=$r->inside_dhaka_shipping_charge?:0;
            $general->outside_metro_charge=$r->outside_metro_charge?:0;
            $general->outside_dhaka_shipping_charge=$r->outside_dhaka_shipping_charge?:0;
            $general->minimum_shopping=$r->minimum_shopping?:0;
            $general->product_discount=$r->product_discount?:0;
            $general->tax=$r->tax?:0;
            $general->tax_status=$r->tax_status?:0;
            $general->save();

            Session::flash('success','General Information Are Update Successfully Done!');
            return redirect()->back();
        }


        
        return view(adminTheme().'ecommerce-setting.settings');
      }else{

        Session()->flash('error','Unknown Type Action Not Allow');
        return redirect()->route('admin.ecommerceSetting',['type'=>'general']);
      }
      
    }
    
    public function ecommerceCoupons(Request $r){
        $coupons =Attribute::latest()->where('type',13)->where('status','<>','temp')->where('parent_id',null)
                    ->where(function($q) use ($r) {
                      if($r->search){
                        $q->where('name','LIKE','%'.$r->search.'%');
                      }
                    })
                    ->paginate(10);
        return view(adminTheme().'ecommerce-setting.coupons.couponsAll',compact('coupons'));
    }
    
    public function ecommerceCouponsAction(Request $r,$action,$id=null){
 
        if($action=='create'){
            $coupon =Attribute::where('type',13)->where('status','temp')->where('addedby_id',Auth::id())->first();
            if(!$coupon){
                $coupon =new Attribute();
                $coupon->type=13;
                $coupon->status='temp';
                $coupon->addedby_id=Auth::id();
            }
            $coupon->created_at=Carbon::now();
            $coupon->save();
            
            return redirect()->route('admin.ecommerceCouponsAction',['edit',$coupon->id]);
            
        }
        
        $coupon =Attribute::where('type',13)->find($id);
        if(!$coupon){
            Session()->flash('error','Coupon Are Not Found');
            return redirect()->route('admin.ecommerceCoupons');
        }
        
        if($action=='search-product'){
            
            $products =Post::where('type',2)->where('status','active')->where('name','like','%'.$r->search.'%')->limit(10)->get(['id','name']);
            
            if($r->ajax()){
                $view = view(adminTheme().'ecommerce-setting.includes.searchProduct',compact('products','coupon'))->render();
                  return Response()->json([
                      'view' => $view
                  ]);
            }
        }
        
        if($action=='add-product'){
            
            $postProduct =$coupon->couponProductPosts()->where('reff_id',$r->product_id)->first();
            if(!$postProduct){
                $postProduct =new PostAttribute();
                $postProduct->src_id=$coupon->id;
                $postProduct->reff_id=$r->product_id;
                $postProduct->type=6;
                $postProduct->save();
            }
            if($r->ajax()){
                $view = view(adminTheme().'ecommerce-setting.includes.couponProductsList',compact('coupon'))->render();
                  return Response()->json([
                      'view' => $view
                  ]);
            }
        }
        
        if($action=='delete-product'){
            
            $coupon->couponProductPosts()->whereIn('id',$r->checkedId)->delete();
            
            if($r->ajax()){
                $view = view(adminTheme().'ecommerce-setting.includes.couponProductsList',compact('coupon'))->render();
                  return Response()->json([
                      'view' => $view
                  ]);
            }
        }
        
        if($action=='update'){
            
            $check = $r->validate([
              'name' => 'required|max:100',
              'discount' => 'nullable|numeric',
              'discount_type' => 'nullable|max:100',
              'min_shopping' => 'nullable|numeric',
              'max_shopping' => 'nullable|numeric',
              'start_date' => 'nullable|date',
              'end_date' => 'nullable|date',
              'status' => 'required|max:20',
            ]);
            
            $coupon->name=$r->name;
            $coupon->amounts=$r->discount;
            $coupon->menu_type=$r->discount_type;
            $coupon->min_shopping=$r->min_shopping;
            $coupon->max_shopping=$r->max_shopping;
            $coupon->start_date=$r->start_date;
            $coupon->description=$r->description;
            $coupon->end_date=$r->end_date;
            $coupon->location=$r->coupon_type?:'order';
            
            $slug =Str::slug($r->name);
            if($slug==null){
              $coupon->slug=$coupon->id;
            }else{
              if(Attribute::where('type',13)->where('slug',$slug)->whereNotIn('id',[$coupon->id])->count() >0){
              $coupon->slug=$slug.'-'.$coupon->id;
              }else{
              $coupon->slug=$slug;
              }
            }
            $coupon->status =$r->status?'active':'inactive';
            $coupon->editedby_id =Auth::id();
            $coupon->save();
            
            //Tags posts
            if($r->categories){
              $coupon->couponCtgs()->whereNotIn('reff_id',$r->categories)->delete();
               for ($i=0; $i < count($r->categories); $i++) {
                $ctg = $coupon->couponCtgs()->where('reff_id',$r->categories[$i])->first();
                if($ctg){}else{
                $ctg =new PostAttribute();
                $ctg->src_id=$coupon->id;
                $ctg->reff_id=$r->categories[$i];
                $ctg->type=5;
                }
                $ctg->drag=$i;
                $ctg->save();
               }
            }else{
                $coupon->couponCtgs()->delete();
            }
            
            Session()->flash('success','Your Are Successfully Done');
            return redirect()->back();

        }
        
        if($action=='delete'){
            $coupon->delete();
            Session()->flash('success','Your Are Successfully Done');
            return redirect()->route('admin.ecommerceCoupons');
        }
        
        $categories =Attribute::where('type',0)->where('status','active')->where('parent_id',null)->get();
        
        return view(adminTheme().'ecommerce-setting.coupons.couponsEdit',compact('coupon','categories'));
    }










}
