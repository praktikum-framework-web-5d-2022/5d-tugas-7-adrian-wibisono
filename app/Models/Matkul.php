<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function dosen(){
        return $this->belongsToMany(Dosen::class, 'dosen_matkul', 'matkul_id'
        ,'dosen_id')->withTimestamps();
    }
}
