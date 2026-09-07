<?php

namespace App\Models;

use Cookie;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    //Models Information Data
    /********
     * 
     * type ==0 : Page
     * type ==1 : Post
     * type ==2 : Product
     * 
     * ------------------------
     *  Status==temp, active, inactive
     * ------------------------
     * 
     * Column:
     * 
     * id            =bigint(20):None,
     * name          =varchar(200):null,
     * slug          =varchar(250):null,
     * short_description =text:null,
     * description   =longtext:null,
     * view          =bigint(20):0
     * type          =int(1):0
     * seo_title     =varchar(191):null
     * seo_desc      =text:null
     * seo_keyword   =text:null
     * search_key    =text:null
     * status        =varchar(10):null
     * fetured       =tinyint(1):null
     * addedby_id    =bigint(20):null
     * editedby_id   =bigint(20)::null
     * created_at    =timestamp:null
     * updated_at    =timestamp:null
     * 
     * 
     * 
     ****/


    //Image and Banner Functions Start
    /********
     * 
     * *********/

    public function imageFile(){
    	return $this->hasOne(Media::class,'src_id')->where('src_type',1)->where('use_Of_file',1);
    }

    public function image(){
        if($this->imageFile){
            return webPath($this->imageFile->file_url);
        }else{
            return 'medies/noimage.jpg';
        }
    }

    public function bannerFile(){
        return $this->hasOne(Media::class,'src_id')->where('src_type',1)->where('use_Of_file',2);
    }

    public function banner(){
        if($this->bannerFile){
            return webPath($this->bannerFile->file_url);
        }else{
            return 'medies/no-banner.png';
        }
    }

    public function galleryFiles(){
        return $this->hasMany(Media::class,'src_id')->where('src_type',1)->where('use_Of_file',3);
    }
    
    public function productGalleries(){
        $b = array('c', 'd');
        
        //$gallery[]=$this->image();
        
        
        return $b;
    }
    //Image and Banner Functions End


    //Post Category tag, comments Functions 
    public function postCtgs(){
        return $this->hasMany(PostAttribute::class,'src_id')->where('type',1)->orderBy('drag','asc');
    }
    
    public function postDatas(){
        return $this->hasMany(PostExtra::class,'src_id')->where('type',4);
    }

    public function postTags(){
        return $this->hasMany(PostAttribute::class,'src_id')->where('type',2)->orderBy('drag','asc');
    }
    
    public function relatedPosts(){
        return Post::whereHas('ctgPosts',function($q){
                    $q->whereIn('reff_id',$this->ctgPosts->pluck('reff_id'));
                })
                ->whereNot('id',$this->id)
                ->where('status','active')
                ->whereDate('created_at','<=',date('Y-m-d'));
 
    }
    
    

    public function postComments(){
        return $this->hasMany(Review::class,'src_id')->where('type',1);
    }
    
    public function postCategories(){
        return $this->belongsToMany(Attribute::class, PostAttribute::class,'src_id','reff_id')->wherePivot('type',1)->orderBy('drag', 'asc');
    }
    
     public function Tags(){
        return $this->belongsToMany(Attribute::class, PostAttribute::class,'src_id','reff_id')->wherePivot('type',2)->orderBy('drag', 'asc');
    }

    public function ctgPosts(){
        return $this->hasMany(PostAttribute::class,'src_id')->where('type',1);
    }

    public function tagPosts(){
        return $this->hasMany(PostAttribute::class,'src_id')->where('type',2);
    }

    //Post Category tag, comments Functions End

    //Product Functions 
    public function productCtgs(){
        return $this->hasMany(PostAttribute::class,'src_id')->where('type',0)->orderBy('drag','asc');
    }

    public function productTags(){
        return $this->hasMany(PostAttribute::class,'src_id')->where('type',4)->orderBy('drag','asc');
    }
    
    public function productBranches(){
        return $this->hasMany(PostAttribute::class,'src_id')->where('type',5)->orderBy('drag','asc');
    }
    
    public function productBranchesStockList(){
        return $this->hasMany(PostAttribute::class,'src_id')->where('type',6)->orderBy('drag','asc');
    }
    
    public function productBranchesStock(){
        return $this->productBranchesStockList->sum('stock');
    }
    
    public function productFullStock(){
        return $this->productBranchesStock()+$this->quantity;
    }
    
    public function productWeight(){
        $unit =$this->weight_unit?:'kg';
        
        $UnitWeight ='';
        
        if($this->weight_amount >= 1000){

            if($unit=='gram'){
                $unit='Kg';
            }elseif($unit=='ml'){
                $unit='Liter';
            }
            
            $UnitWeight=$this->weight_amount/1000;
        }elseif($this->weight_amount == 1){
            $UnitWeight ='';   
        }else{
            $UnitWeight =$this->weight_amount?:'';
        }
        
        return $UnitWeight.' '.$unit;
        
    }
   
    public function productWeightAmount(){
        $unit =$this->weight_unit?:'kg';
        $UnitWeight =1;
        if($this->weight_amount){
            $UnitWeight=$this->weight_amount;
        }
        return $UnitWeight.' '.$unit;
    }
    
    public function productGrossWeightAmount(){
        $unit =$this->weight_unit?:'kg';
        $UnitWeight =1;
        if($this->weight_amount){
            $UnitWeight=$this->weight_amount;
        }
        
        $UnitWeight +=$this->weight_per_ices?:0;
        
        return $UnitWeight.' '.$unit;
    }
    
    public function productWeightUnit(){

        $UnitWeight ='';
        
        if($this->weight_amount >= 1000){

            if($unit=='gram'){
                $unit='Kg';
            }elseif($unit=='ml'){
                $unit='Liter';
            }
            
            $UnitWeight=$this->weight_amount/1000;
        
        }else{
            $UnitWeight =$this->weight_amount?:'';
        }
        
        return $UnitWeight;
        
    }

    public function productCategories(){
        return $this->belongsToMany(Attribute::class, PostAttribute::class,'src_id','reff_id')->wherePivot('type',0)->orderBy('drag', 'asc');
    }

    public function ctgProducts(){
        return $this->hasMany(PostAttribute::class,'src_id')->where('type',0);
    }

    public function extraAttribute(){
        return $this->hasMany(PostExtra::class,'src_id')->where('type',2)->orderBy('drag','asc');
    }

    public function productAttibutes(){
        return $this->hasMany(PostAttribute::class,'src_id')->where('type',3)->where('parent_id','<>',null)->orderBy('drag','asc');
    }
    
    public function productSizes(){
        return $this->hasMany(PostAttribute::class,'src_id')->where('type',3)->where('parent_id','<>',null)->where('reff_id',73)->orderBy('drag','asc')->whereHas('attributeItem')->whereHas('attribute',function($q){$q->where('status','active');});
    }

    public function productColors(){
        return $this->hasMany(PostAttribute::class,'src_id')->where('type',3)->where('parent_id','<>',null)->where('reff_id',68)->orderBy('drag','asc')->whereHas('attributeItem')->whereHas('attribute',function($q){$q->where('status','active');});
    }

    public function productSkus(){
        return $this->hasMany(PostAttribute::class,'src_id')->where('type',4)->where('parent_id','<>',null)->orderBy('drag','asc');
    }
    
    public function productReviews(){
        return $this->hasMany(Review::class,'src_id')->where('type',0);
    }
    
    public function reviewTotal(){
       return $this->productReviews->count();
    }
    
    public function productRating(){
        $reviews =$this->productReviews->count();
        $totalRating =$this->productReviews->sum('rating');
        
        $averageRating =0;
        
        if($reviews > 0 && $totalRating > 0){
            (int)$averageRating =number_format($totalRating/$reviews);
        }
        
        if($averageRating > 5){
            $averageRating =5;
        }
        
        return $averageRating;
        
    }

    public function brand(){
        return $this->belongsTo(Attribute::class,'brand_id');
    }
    
    public function productMinQty(){
        $min =1;
        if($this->min_order_quantity){
           $min =$this->min_order_quantity;
        }
        
        return $min;
    }
    
    public function productMaxQty(){
        $max =$this->quantity;
        if($this->max_order_quantity){
           $max =$this->max_order_quantity;
        }
        
        return $max;
    }
    
    public function offerPrice(){
        if(general()->product_discount > 0 && general()->product_discount <= 100){
            $price =$this->regular_price - ($this->regular_price*general()->product_discount/100);
        }else{
            $price =$this->final_price;
        }
        return $price;
    }
    
    public function discountPercent(){
        $discount =0;
        if($this->regular_price > $this->offerPrice()){
            if(general()->product_discount > 0 && general()->product_discount <= 100){
                $discount=round(general()->product_discount);
            }else{
                
                if($this->discount_type=='flat'){
                    $discount = round((($this->regular_price - $this->offerPrice()) / $this->regular_price)  * 100);
                }else{
                    $discount=round($this->discount);
                }
            }
        }
        return $discount;
    }
    
    public function itemType(){
        $hasFrozen =$this->productCtgs->where('reff_id',166)->first();
        $hasDye =$this->productCtgs->where('reff_id',165)->first();
        if($hasFrozen){
            return 1;
        }elseif($hasDye){
            return 2;
        }else{
            return 0;
        }
    }
    
    public function stockStatus(){
        $status = true;
        
        if($this->stock_status){
            
            if($this->quantity > $this->stock_out_limit){
                if($this->quantity==0){
                    $status = false;
                }
            }else{
                $status = false;
            }
            
        }else{
         $status = false;  
        }
        
        
        return $status;
    }

    public function relatedProducts(){
        return Post::whereHas('ctgProducts',function($q){
                    $q->whereIn('reff_id',$this->ctgProducts->pluck('reff_id'));
                })
                ->whereNot('id',$this->id)
                ->where('status','active')
                ->whereDate('created_at','<=',date('Y-m-d'));
 
    }
    
    public function transfers(){
        return $this->hasMany(OrderItem::class,'product_id')->whereHas('order',function($q){
            $q->where('order_type','transfers_order');
        });
    }
    
    public function purchases(){
        return $this->hasMany(OrderItem::class,'product_id')->whereHas('order',function($q){
            $q->where('order_type','purchase_order');
        });
    }
    
    public function salesAll(){
        return $this->hasMany(OrderItem::class,'product_id')->whereHas('order',function($q){
            $q->whereIn('order_type',['pos_order','customer_order']);
        });
    }
    
    
    public function wishlists()
    {
        return $this->hasMany(WishList::class,'product_id')->where('type',0);
    }

    
    public function comparelists()
    {
        return $this->hasMany(WishList::class,'product_id')->where('type',1);
    }
    

    public function isWl()
    {
        
        
        return (bool) $this->wishlists()->where('cookie', Cookie::get('carts'))->where('type',0)->count();
    }
    
    public function isCP()
    {
        return (bool) $this->comparelists()->where('cookie', Cookie::get('carts'))->where('type',1)->count();
    }

    //Product Functions End


    
    public function user(){
    	return $this->belongsTo(User::class,'addedby_id');
    }

    

    

    
}
