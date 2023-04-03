<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // 此模型不需要维护 created_at 和 updated_at 两个字段
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description'
    ];
}
