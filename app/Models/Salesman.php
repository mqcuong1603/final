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
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Salesman extends Authenticatable
{
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fullName', 'email', 'username', 'isAdmin', 'isLocked', 'isActivated', 'profilePicture', 'password', 'activation_token', 'reset_token', 'reset_token_expiry', 'activation_token_expiry', 'is_first_login'];
}
