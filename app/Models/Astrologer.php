<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Astrologer extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'astrologers';

    protected $fillable = [
        'astrologer',
        'name',
        'email',
        'phone',
        'gender',
        'service',
        'profile_pic'
    ];
}
