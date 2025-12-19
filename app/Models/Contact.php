<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // This line is vital
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory; // This enables the Contact::factory() method

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
    ];
}