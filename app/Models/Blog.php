<?php

namespace App\Models;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function oneCategory(){
        return $this->hasOne(Category::class,'id','category_id');
    }


    public function oneUser(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
