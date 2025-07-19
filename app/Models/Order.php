<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $casts = [
        'details_commande' => 'array',
    ];

    public function stand()
    {
        return $this->belongsTo(Stand::class);
    }
}
