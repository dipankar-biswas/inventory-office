<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stockAddTotal extends Model
{
    use HasFactory;

    public function stockin(){
        return $this->belongsTo(StockIn::class, 'stockin_id');
    }

}
