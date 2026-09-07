<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function cancelItems()
    {
        return $this->hasMany(OrderReturnItem::class,'order_id')->where('return_type',false);
    }
    
    public function returnItems()
    {
        return $this->hasMany(OrderReturnItem::class,'order_id')->where('return_type',true);
    }
    
    public function branch(){
        return $this->belongsTo(Attribute::class,'branch_id')->where('type',13);
    }
    
    public function TotalGramUnit(){
        
        $gram =0;
        
        $un='';
        
        foreach($this->items as $item){

            if($item->product){
                if($item->product->weight_unit=='gram'){
                    $gram+=  $item->quantity*$item->product->weight_amount;   
                }
            }
            
        }
        
        return $gram;
        
    }
    
    public function isDhaka(){
        $isDhaka=null;
        
        if($this->district && $this->district==73 && $this->city){
	        $aresId =$this->city;
            $datas = general()->outside_metro_area;
            $dataArray = array_filter(explode(',', $datas));
            if(in_array($aresId, $dataArray)){
                $isDhaka='yes';
            }else{
                $isDhaka='yes';
            }
        }else{
           if($this->district==73){
                $isDhaka='yes';
            }else{
                $isDhaka='no';
            } 
        }
        return $isDhaka;
    }
    
    public function TotalLiterUnit(){
        $ml =0;
        foreach($this->items as $item){
            if($item->product){
               if($item->product->weight_unit=='ml'){
                   $ml+=$item->product->weight_amount?$item->product->weight_amount*$item->quantity:0;
               }
            }
            
        }
        
        return $ml;
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function posByuser(){
        return $this->belongsTo(User::class,'pending_by');
    }

     public function customerDelivery(){
        return $this->belongsTo(User::class,'order_delivery_By');
    }
    
    public function transections()
    {
        return $this->hasMany(Transaction::class,'src_id')->whereIn('type',[0,3,8])->where('status','<>','temp');
    }
    
    public function transactionsAll()
    {
        return $this->hasMany(Transaction::class,'src_id')->whereIn('type',[0,3,2])->where('status','<>','temp');
    }

    public function transectionsTemp()
    {
        return $this->hasMany(Transaction::class,'src_id')->whereIn('type',[0,3])->where('type',3)->where('status','temp');
    }

    public function transactionsSuccess()
    {
        return $this->hasMany(Transaction::class,'src_id')->whereIn('type',[0,3])->where('status','success');
    }
    
    public function transactionsRefund()
    {
        return $this->hasMany(Transaction::class,'src_id')->whereIn('type',[2])->where('status','success');
    }

    
    public function returnTransections()
    {
        return $this->hasMany(Transaction::class,'order_id')->where('type',2);
    }
    
    public function countryN(){
        return $this->belongsTo(Country::class,'country');
    }
    
    public function divitionN(){
        return $this->belongsTo(Country::class,'division');
    }

    public function districtN(){
        return $this->belongsTo(Country::class,'district');
    }
    
    
    public function cityN(){
        return $this->belongsTo(Country::class,'city');
    }


    public function fullAddress(){
        
        $addr ='';
        
        if($this->postal_code){
           $addr .=$this->postal_code;
        }
        if($this->districtN){
           $addr .=', '.$this->districtN->name;
        }
        if($this->cityN){
           $addr .=', '.$this->cityN->name;
        }
        if($this->address){
          $addr .=', '.$this->address;  
        }

        return $addr;
        
    }
    


}
