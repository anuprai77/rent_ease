<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
   
    
    protected $fillable = ['order_id','item_id','price','weeks'];
    
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    
    
public function order()
{
    return $this->belongsTo(Order::class);
}
}
