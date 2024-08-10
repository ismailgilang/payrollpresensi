<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapAbsensi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function namakaryawan(){
        return $this->belongsTo(User::class,'karyawan');
    }
}
