<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];

    public $translatable = ['title', 'body'];

    public function scopeLocation($query)
    {
        $location = request()->location;
        $query->when(!empty($location), function ($query) use ($location) {
           $query->where('location', $location);
        });
    }

    public static function getOrCreatePage($id = null) : Page
    {
        if (!empty($id)) {
            return self::findOrFail($id);
        }
        return new Page();
    }
}
