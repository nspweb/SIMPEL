<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // admin, pimpinan, pemberdayaan, penyelenggara, produktivitas, lsp, pengadaan, umum, keuangan
        'active',
        'phone',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPimpinan(): bool
    {
        return in_array($this->role, ['admin', 'pimpinan']);
    }

    public function isPemberdayaan(): bool
    {
        return in_array($this->role, ['admin', 'pemberdayaan']);
    }

    public function isPenyelenggara(): bool
    {
        return in_array($this->role, ['admin', 'penyelenggara']);
    }

    public function isProduktivitas(): bool
    {
        return in_array($this->role, ['admin', 'produktivitas']);
    }

    public function isLsp(): bool
    {
        return in_array($this->role, ['admin', 'lsp']);
    }

    public function isPengadaan(): bool
    {
        return in_array($this->role, ['admin', 'pengadaan']);
    }

    public function isUmum(): bool
    {
        return in_array($this->role, ['admin', 'umum']);
    }

    public function isKeuangan(): bool
    {
        return in_array($this->role, ['admin', 'keuangan']);
    }
}
