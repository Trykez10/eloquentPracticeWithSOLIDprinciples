<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserModel extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = "useraccount";
    protected $fillable = [
        "firstname",
        "middlename",
        "lastname",
        "age",
        "email",
        "password"
    ];

    protected $hidden = ["password"];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    //Relationship

    public function posts()
    {
        return $this->hasMany(PostModel::class, 'user_id', 'id');
    }
}
