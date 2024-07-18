<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.ch
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function getFormatTanggalMemberAttribute()
    {
        return Carbon::parse($this->tanggal_bergabung)->format('d M Y');
    }

    public function getFormatTanggalAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M Y');
    }

    public function getFormatTanggalBerakhirAttribute()
    {
        return Carbon::parse($this->tanggal_berakhir)->format('d M Y');
    }


    public function getFormatJamAttribute()
    {
        return Carbon::parse($this->created_at)->format('H:i');
    }


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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
