<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Nama tabel di database
    protected $table = 'users';
    protected $fillable = [
        'username',  // Sesuai dengan kolom di tabel migrasi
        'password',
        'role',      // Tambahkan kolom role
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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Create a new user with a specific role.
     *
     * @param string $username
     * @param string $password
     * @param string $role
     * @return static
     */
    public static function createWithRole(string $username, string $password, string $role = 'dosenberjabatan')
    {
        return self::create([
            'username' => $username,
            'password' => bcrypt($password), // Enkripsi password
            'role' => $role,
        ]);
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'users_id', 'id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);  // Pastikan relasi ini benar
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }
}
