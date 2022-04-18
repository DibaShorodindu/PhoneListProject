<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PhoneListUserModel extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'email',
        'password',
        'firstName',
        'lastName',
        'phone',
        'country',
        'google_id',
    ];

    protected $hidden = [
        'remember_token',
    ];

}
