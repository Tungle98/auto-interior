<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedBackVideo extends BaseModel
{
    use HasFactory;
    protected $table = "feedback_videos";
    protected $fillable =['title','link','status','image'];
}
