<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'entrega',
        'path',
        'album_id'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
