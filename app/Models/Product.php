<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'gallery', 'category_id'];
    
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    
    public function order()
    {
        return $this->belongsToMany(Order::class, 'order_details');
    }
}
