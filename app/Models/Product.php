<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['nom', 'description', 'prix', 'image_url', 'stand_id'];

    // Relation vers le stand
    public function stand()
    {
        return $this->belongsTo(Stand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
