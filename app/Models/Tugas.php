<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Tugas extends Model
{
    protected $table = 'tugas';

    protected $fillable = [
        'mata_kuliah_id', 'judul', 'tanggal', 'waktu', 'prioritas', 'catatan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }
}