<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guard extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'first_name', 'last_name', 'function', 'degree', 'service',
        'unite', 'avatar', 'birth_date', 'adresse', 'phone', 'hire_date','role_id','user_id'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function arme()
    {
        return $this->hasOne(Weapon::class);
    }
}
