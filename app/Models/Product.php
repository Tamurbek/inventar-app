<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','price','price_visible','category_id','image'];
    public function people(){
        return $this->belongsTo(Category::class);
    }
}