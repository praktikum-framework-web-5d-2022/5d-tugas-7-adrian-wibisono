<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function matkuls(){
        return $this->belongsToMany(Matkul::class, 'dosen_matkul', 'dosen_id'
        ,'matkul_id')->withTimestamps();
    }
}
