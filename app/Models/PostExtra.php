<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostExtra extends Model
{
    
    //Models Information Data
    /********
     * 
     * type ==0 : Page
     * 
     * ------------------------
     *  Status==
     * ------------------------
     * 
     * Column:
     * 
     * id            =bigint(20):None,
     * src_id        =bigint(20):null,
     * name          =varchar(191):null,
     * content       =text:null,
     * parent_id     =bigint(20):null,
     * drag          =int(5):0
     * type          =int(1):0
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
     
     public function imageFile(){
    	return $this->hasOne(Media::class,'src_id')->where('src_type',9)->where('use_Of_file',1);
    }

    public function image(){

        if($this->imageFile){
            return webPath($this->imageFile->file_url);
        }else{
            return 'medies/profile.png';
        }
    }

    public function bannerFile(){
        return $this->hasOne(Media::class,'src_id')->where('src_type',9)->where('use_Of_file',2);
    }

    public function banner(){

        if($this->bannerFile){
            return webPath($this->bannerFile->file_url);
        }else{
            return 'app-assets/images/carousel/22.jpg';
        }
    }
     
     
    public function zoneLists(){
         return $this->hasMany(PostExtra::class,'parent_id')->where('type',3);
     }
     
     public function zoneId(){
         return $this->belongsTo(Country::class,'src_id');
     }
     
     public function parentId(){
         return $this->belongsTo(PostExtra::class,'parent_id');
     }
     
     public function product(){
         return $this->belongsTo(Post::class,'src_id');
     }
     
     
     public function products(){
         
         $products = Post::where('type',2)->where('status','active')->where('stock_status',true)->where('quantity','>',0)->whereHas('postDatas',function($q) { 
                            $q->where('parent_id',$this->id);
                    })->limit($this->product_limit)->get();
         
         if($this->product_type==4 || $this->product_type==5 || $this->product_type==6 || $this->product_type==7 && $this->product_limit){
             

             $products = Post::where('type',2)->where('status','active')->where('stock_status',true)->where('quantity','>',0)->where(function($q) {
                
                if($this->product_type==4){
                    $q->latest();
                }elseif($this->product_type==5){
                    //$q->latest();
                }elseif($this->product_type==6){
                    $q->latest()->where('fetured',true);
                }elseif($this->product_type==7){
                    //$q->ordeBy('sell_count','asc');
                    $q->orderBy('sell_count','asc');
                }
                
             })->limit($this->product_limit)->get();
         
         }
         
         
         return $products;
     }
     
     public function homeDataIds(){
         return $this->hasMany(PostExtra::class,'parent_id')->where('type',4);
     }
     
     

}
