<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class PostModel extends Model
{
    use HasApiTokens;
    protected $table = 'user_post';
    protected $fillable = ['user_id', 'title', 'body'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }
}
