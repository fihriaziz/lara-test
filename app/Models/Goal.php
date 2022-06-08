<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = ['title','description', 'user_id', 'attachments'];

    public function tasks()
    {
        return $this->hasMany(Task::class,'goal_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id');
    }
}
