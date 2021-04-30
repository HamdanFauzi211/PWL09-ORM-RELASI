<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;

class MataKuliah extends Model //Definisi Model
{   
    use HasFactory;
    protected $table="matakuliah"; // Eloquent akan membuat model matakuliah menyimpan record di tabel matakuliah
    /**
     * The attributes that are mass assignable. *
     * @var array
     */
    protected $fillable = [ 
        'nama_matkul', 
        'sks',
        'jam', 
        'Kelas', 
        'semester', 
    ]; 
    
    public function matakuliah() {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_matakuliah', 'matakuliah_id', 'mahasiswa_nim')
        ->withPivot('nilai');
    }
}; 