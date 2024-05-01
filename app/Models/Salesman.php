<?php

namespace App\Models;

// Remove unnecessary use directives
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

/**
 * The Salesman model represents a salesman in the application.
 *
 * This model extends the User model and inherits its properties and methods.
 */
class Salesman extends User
{
    protected $fillable = [
        'email_verified_at',
        'remember_token',
        'created_at',
        'updated_at',
   ];

}
