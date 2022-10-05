<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // posts - потому что одни (категория) ко многим (посты)
    public function posts() 
    {

        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
