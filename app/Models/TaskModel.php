<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class TaskModel extends Model
{
    use HasApiTokens;
    protected $table = 'user_tasks';
    protected $primaryKey = 'task_id';
    protected $fillable = ['user_id', 'task_title', 'task_content', 'status'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }
}
