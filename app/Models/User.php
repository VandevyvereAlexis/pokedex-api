<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pseudo',
        'email',
        'password',
        'image',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relation avec Role (user appartient à un rôle)
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relation avec Creature (un utilisateur peut avoir plusieurs créatures)
    public function creatures()
    {
        return $this->hasMany(Creature::class);
    }

    // Méthode pour vérifier si l'utilisateur est admin
    public function isAdmin(): bool
    {
        return $this->role && $this->role->role === 'admin';
    }

    public static function searchByPseudo(string $name)
    {
        return self::where('pseudo', 'like', "%$name%");
    }
}
