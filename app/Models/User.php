<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * Catatan: 'role' dan 'poin' sengaja TIDAK mass-assignable
     * agar tidak bisa dieskalasi lewat input request.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'email' => 'encrypted',
        ];
    }

    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }

    /**
     * Blind index deterministik untuk pencarian email terenkripsi.
     * Jangan pernah pakai where('email') langsung — email di DB adalah ciphertext.
     */
    public static function hashEmail(string $email): string
    {
        return hash('sha256', strtolower(trim($email)));
    }

    public function scopeWhereEmail($query, string $email)
    {
        return $query->where('email_hash', self::hashEmail($email));
    }

    protected static function booted(): void
    {
        // Sinkronkan blind index setiap kali email berubah
        static::saving(function (User $user) {
            if ($user->isDirty('email') && ! empty($user->email)) {
                $user->forceFill(['email_hash' => self::hashEmail($user->email)]);
            }
        });
    }
}
