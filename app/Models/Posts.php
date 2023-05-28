<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

use App\User;
 class Posts extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia ;
    protected $fillable = [
        'user_id',
        'describtion',
        'likes',
        'category_id'
    ];
    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
    public function category(){
        return $this->belongsTo(Categories::class , 'category_id');
    }
}
