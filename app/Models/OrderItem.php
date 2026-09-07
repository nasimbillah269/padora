<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

     public function order(){
            return $this->belongsTo(Order::class);
        }
        
    public function branch(){
            return $this->belongsTo(Attribute::class,'branch_id');
        }

    public function returnItems(){
            return $this->hasMany(OrderReturnItem::class,'order_item_id')->where('return_type',true);
        }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function product(){
        return $this->belongsTo(Post::class,'product_id')->where('type',2);
    }
    
    public function productWeightTotal(){
        
        $unit =$this->product->weight_unit?:'';
        
        $UnitWeight =$this->product->weight_amount?$this->product->weight_amount*$this->quantity:0;
        
        if($UnitWeight >= 1000){

            if($unit=='gram'){
                $unit='Kg';
            }elseif($unit=='ml'){
                $unit='Liter';
            }
            
            $UnitWeight=$UnitWeight/1000;
            
        }
        
        return $UnitWeight.' '.$unit; 
    }
    
    public function review(){
        return $this->hasOne(ProductReview::class,'item_id');
    }

    public function sellerDelivery(){
        return $this->belongsTo(User::class,'seller_delivery_user');
    }


}
