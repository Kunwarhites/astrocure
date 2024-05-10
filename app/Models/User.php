<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users'; // Replace 'users' with your actual table name

    protected  $fillable = ['name', 'email', 'password', 'phone', 'gender', 'dob', 'service', 'picture'];
    public static function getUserBySomeCriteria($criteria)
    {
        return self::where('id', $criteria)->first();
    }
}
