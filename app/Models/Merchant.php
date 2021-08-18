<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'phone', 'identity', 'location'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['location' => 'json'];
}
