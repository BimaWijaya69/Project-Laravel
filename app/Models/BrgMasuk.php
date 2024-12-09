<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrgMasuk extends Model
{
    use HasFactory;
    
    protected $table = 'brg_masuks';

    protected $fillable = ['product_id','supplier_id','stok','tanggal'];

    protected $hidden = ['created_at','updated_at'];

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
