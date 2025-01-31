<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequsetModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [''];

    public function oneUser(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
