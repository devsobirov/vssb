<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Person extends Model
{
    use HasFactory, HasTranslations;

    const IMAGE_BASE_DIR = 'images/persons';

    protected $table = 'people';

    protected $guarded = [];

    public $translatable = ['position', 'info'];

    public static function getOrCreatePerson($id = null) : Person
    {
        if (!empty($id)) {
            return self::findOrFail($id);
        }
        return new Person();
    }

    public function image_path()
    {
        return $this->image;
    }
}
