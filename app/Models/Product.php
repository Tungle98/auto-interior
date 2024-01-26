<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name', 'desc', 'content', 'price','price_discount','status','brand_id','quantity','image','img_list','slug','category_id'];
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
