<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $guarded = [''];

    public function category()
    {
       return $this->belongsTo(Category::class,'category_id','id');
    }

    public function admin()
    {
       return $this->belongsTo(Admin::class,'admin_id','id');
    }

    public function client()
    {
       return $this->belongsTo(User::class,'client_id','id');
    }

    public function details()
    {
       return $this->hasMany(OrderDetail::class,'order_id');
    }

}
