<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table='order_details';
    protected $fillable=[
        'order_id','category_id','subcategory_id','number'
    ];

    public function order()
    {
       return $this->belongsTo(Order::class,'order_id','id');
    }

    public function category()
    {
       return $this->belongsTo(Category::class,'category_id','id');
    }

    public function subcategory()
    {
       return $this->belongsTo(Category::class,'subcategory_id','id');
    }
}
