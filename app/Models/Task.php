<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','goal_id','title','deadline'];

    public function goals()
    {
        return $this->hasMany(Goal::class, 'goal_id');
    }

}
