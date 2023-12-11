<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    use HasFactory;
    //protected $guarded = [];

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id')->select('id','name');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id')->select('id','name');
    }
    public function model(){
        return $this->belongsTo(Modele::class, 'model_id', 'id')->select('id','name');
    }
    public function capacity(){
        return $this->belongsTo(Capacity::class, 'capacity_id', 'id')->select('id','name');
    }
    public function color(){
        return $this->belongsTo(Color::class, 'color_id', 'id')->select('id','name');
    }
    public function size(){
        return $this->belongsTo(Size::class, 'size_id', 'id')->select('id','name');
    }

    public function stockout(){
        return $this->hasMany(StockOut::class, 'stockin_id');
    }    

    public function stockaddtotal(){
        return $this->hasMany(stockAddTotal::class, 'stockin_id');
    }
    public function stockqtydata(){
        return $this->hasMany(stockAddTotal::class, 'stockin_id');
    }

}
