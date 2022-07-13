<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Document extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];

    public $translatable = ['name'];

    public const  BASE_DIR = 'docs';

    public function scopeCategory($query, $category = '')
    {
        $query->when(!empty($category), function ($query) use ($category) {
            $category = strtolower($category);
            $query->where('category', $category);
        });
    }

    public static function getOrCreate($id = null): Document
    {
        if (!empty($id)) {
            return self::findOrFail($id);
        }
        return new Document();
    }
}
