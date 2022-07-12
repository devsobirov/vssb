<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Appointment extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];

    public $translatable = ['weekday'];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

    public static function getOrCreate($id = null) : Appointment
    {
        if (!empty($id)) {
            return self::findOrFail($id);
        }
        return new Appointment();
    }

}
