<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    // protected $fillables = 'services';
    protected $fillable = ['name', 'description', 'short_description', 'status'];

}

