<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pv',
        'atk',
        'def',
        'speed',
        'capture_rate',
        'image',
        'user_id',
        'type_id',
        'race_id',
    ];

    // Relation avec User (une créature appartient à un utilisateur)
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relation avec Type (une créature a un type)
    public function type() {
        return $this->belongsTo(Type::class);
    }

    // Relation avec Race (une créature a une race)
    public function race() {
        return $this->belongsTo(Race::class);
    }

    public static function searchByName(string $name = null, string $minPv = null, string $maxPv = null)
    {
        $query = self::query();

        if ($name) {
            $query->where('name', 'like', "%$name%");
        }

        if (is_numeric($minPv)) {
            $query->where('pv', '>', $minPv);
        }

        if (is_numeric($maxPv)) {
            $query->where('pv', '<', $maxPv);
        }

        return $query;
    }
}

