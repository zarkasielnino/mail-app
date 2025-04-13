<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_surat',
        'prioritas',
        'tujuan',
        'perihal',
        'isi_surat',
        'lampiran',
        'template',
        'status',
    ];

    protected $casts = [
        'lampiran' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
