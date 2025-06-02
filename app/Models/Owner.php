<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    /** @use HasFactory<\Database\Factories\OwnerFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
    public function properties()
{
    return $this->hasMany(Property::class);
}
}
