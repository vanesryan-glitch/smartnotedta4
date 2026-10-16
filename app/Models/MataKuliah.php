<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = ['kode', 'nama', 'dosen'];

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'mata_kuliah_id');
    }
}