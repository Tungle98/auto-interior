<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends BaseModel
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'title', 'desc', 'content','status','slug','image','is_top'
    ];
}
