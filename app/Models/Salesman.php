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
        'fullName', 'email', 'username', 'isAdmin', 'isLocked', 'isActivated', 'profilePicture', 'password', 'activation_token', 'reset_token', 'reset_token_expiry', 'activation_token_expiry', 'is_first_login  => true',
    ];
}