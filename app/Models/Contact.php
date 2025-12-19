<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // This tells Laravel it's okay to mass-assign these specific fields
    protected $fillable = [
        'name',
        'email',
        'phone_number',
    ];
}