<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends BaseModel
{
    use HasFactory;
    protected $fillable = ["name","desc",'status','image'];
}
