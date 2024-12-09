<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = ['nama', 'foto', 'sku','harga','stok','category_id'];
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brgmasuk() {
        return $this->hasMany(BrgMasuk::class);
    }

    public function brgkeluar() {
        return $this->hasMany(BrgKeluar::class);
    }
}
