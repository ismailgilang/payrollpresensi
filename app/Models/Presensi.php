<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'nip',
        'shift',
        'keterangan',
        'keterangan2',
        'bukti',
        'created_at',
    ];
}
