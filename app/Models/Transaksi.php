<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getFormatTanggalAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
