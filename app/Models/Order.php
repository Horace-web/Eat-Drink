<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['stand_id', 'details_commande'];
    protected $casts = [
        'details_commande' => 'array',
    ];

    public function stand()
    {
        return $this->belongsTo(Stand::class);
    }
}
