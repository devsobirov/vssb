<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory, HasTranslations;

    const POST_EXCERPT_LENGTH = 120;
    const IMAGE_BASE_DIR = 'images/posts';

    protected $guarded = [];

    public $translatable = ['title','excerpt','body'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeFilter($query)
    {
        $category_id = request()->category_id;
        $query->when(!empty($category_id), function ($query) use ($category_id) {
           $query->where('category_id', $category_id);
        });
    }

    public static function getPaginatedForAdminList($perPage = 15)
    {
        return self::select(['id', 'title', 'image', 'category_id','published','created_at'])
            ->with('category:id,name')
            ->orderByDesc('id')
            ->paginate($perPage)->withQueryString();
    }

    public function image_path()
    {
        return $this->image;
    }
}
