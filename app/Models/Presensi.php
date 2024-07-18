<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Presensi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormatTanggalAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M Y');
    }

    public function getFormatJamAttribute()
    {
        return Carbon::parse($this->created_at)->format('H:i');
    }

    public function getFormatHariAttribute()
    {
        Carbon::setLocale('id');

        return Carbon::parse($this->created_at)->isoFormat('dddd');
    }
}
