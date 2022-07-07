<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $guarded = [];

    public $translatable = ['name'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }

    public static function getOrCreateCategory($id): Category
    {
        if (!empty($id)) {
            return self::findOrFail($id);
        }
        return new Category();
    }

    public static function getGlobalCategories()
    {
        return self::select(['id', 'name', 'slug', 'location'])->get();
    }
}
