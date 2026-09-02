<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
     * 'email_hash' dikecualikan agar blind-index SHA-256 tidak
     * bocor ke JSON response / API output.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_hash',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * Defense in Depth — Data Layer:
     *   - 'email' : AES-256-CBC via APP_KEY (Laravel Crypt)
     *   - 'name'  : AES-256-CBC via APP_KEY (Laravel Crypt) — PII protection
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'email'             => 'encrypted',
            'name'              => 'encrypted',
        ];
    }

    /**
     * @return HasMany<Laporan, $this>
     */
    public function laporans(): HasMany
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

    /**
     * @param  Builder<User>  $query
     * @return Builder<User>
     */
    public function scopeWhereEmail(Builder $query, string $email): Builder
    {
        return $query->where('email_hash', self::hashEmail($email));
    }

    protected static function booted(): void
    {
        // Sinkronkan blind index setiap kali email berubah atau jika hash masih kosong.
        static::saving(function (User $user) {
            if ((empty($user->email_hash) || $user->isDirty('email')) && ! empty($user->email)) {
                $user->forceFill(['email_hash' => self::hashEmail($user->email)]);
            }
        });
    }
}
