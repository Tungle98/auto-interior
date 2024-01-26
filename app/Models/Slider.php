<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends BaseModel
{
    use HasFactory;
    protected $table='sliders';
    protected $fillable=['title','desc','status','image'];
}
