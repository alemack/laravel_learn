<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // чтобы можно было использовать фабрику
    use HasFactory;
    // у этой модели автоматически появляется метод filter
    use Filterable;
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
