<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Costumer extends Model
{
    /** @use HasFactory<\Database\Factories\CostumerFactory> */
    use HasFactory;

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

}
