<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    // указываем имя таблицы, мы связали эту модель с этой таблицей
    protected $table = 'posts';
    protected $guarded = []; // разрешить добавлять и изменять данные в бд 
    // protected $fillable = ['title', 'content']; // разрешает добавлять и изменять данные указанных аттрибутов


    public $someProperty;
}
