<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory,HasTranslations;
    public $translatable = ['name'];
    protected $fillable=['name'];
    protected $table='cities';
    protected $hidden=['created_at','updated_at','name'];
    protected $appends    = ['name_ar', 'name_en'];

    public function getNameArAttribute()
    {
        return $this->getTranslation('name', 'ar');
    }

    public function getNameEnAttribute()
    {
        return $this->getTranslation('name', 'en');
    }
}
