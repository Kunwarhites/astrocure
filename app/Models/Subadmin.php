<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Subadmin extends Authenticatable
{
    use HasFactory, HasRoles;


    protected $fillable = [
        'name',
        'email',
        'password',
        'isadmin',
    ];
}
