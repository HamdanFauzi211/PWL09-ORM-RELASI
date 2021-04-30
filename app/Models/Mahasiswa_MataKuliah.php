<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa_MataKuliah;

class Mahasiswa_MataKuliah extends Model
{
    use HasFactory;
    protected $table='mahasiswa_matakuliah'; //mendefiniskan bahwa model ini terkait dengan tabel mahasiswa_matakuliah
    /**
     * The attributes that are mass assignable. *
     * @var array
     */
    protected $fillable = [ 
        'mahasiswa_id', 
        'matakuliah_id',
        'nilai', 
    ]; 
}