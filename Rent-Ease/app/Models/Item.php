<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;
    
    
protected $fillable = [
        'user_id',
        'category_id', // Add this
        'name',
        'description',
        'min_rental_duration', // Add this
        'weekly_rent', // Add this
        'condition', // Add this
        'min_deposit', // Add this
        'delivery_option', // Add this
        'is_available', // Add this
        'image_path',
        'is_featured',
];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
