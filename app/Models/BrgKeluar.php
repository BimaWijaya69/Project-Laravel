<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrgKeluar extends Model
{
    protected $table = 'brg_keluars';

    protected $fillable = ['product_id','stok','tanggal'];

    protected $hidden = ['created_at','updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    
}
