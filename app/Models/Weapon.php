<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'serie_number', 'acquisition_date', 'state', 'guard_id',
    ];

    public function garde()
    {
        return $this->belongsTo(Guard::class,'guard_id');
    }
}
