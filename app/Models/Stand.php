<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Stand extends Model
{
    use HasFactory;

    protected $fillable = ['nom_stand', 'description', 'user_id'];

    // Un stand appartient à un utilisateur (entrepreneur)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un stand peut avoir plusieurs produits
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

