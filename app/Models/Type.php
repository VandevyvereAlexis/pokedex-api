<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // Relation avec Creature (un type peut avoir plusieurs créatures)
    public function creatures()
    {
        return $this->hasMany(Creature::class);
    }

    public static function searchByName(string $name)
    {
        return self::where('name', 'like', "%$name%");
    }
}
