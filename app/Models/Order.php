<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable=[
        'car_id','first_amenities','second_amenities','third_amenities',
        'day','period','city_id','address','phone','admin_id'
    ];

    public function car()
    {
       return $this->belongsTo(Car::class,'car_id','id');
    }

    public function city()
    {
       return $this->belongsTo(City::class,'city_id','id');
    }

    public function admin()
    {
       return $this->belongsTo(Admin::class,'admin_id','id');
    }

}
