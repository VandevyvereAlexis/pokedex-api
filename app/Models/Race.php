<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relation avec Creature (une race peut avoir plusieurs créatures)
    public function creatures()
    {
        return $this->hasMany(Creature::class);
    }
}
