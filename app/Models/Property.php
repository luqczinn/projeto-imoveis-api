<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'city',
        'price',
        'owner_id'
    ];
    public function owner()
{
    return $this->belongsTo(Owner::class);
}

}
