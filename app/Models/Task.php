<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id', //this can be changed to team_id if many users are assigned in that same task.
        'title',
        'status',
        'description',
        'completed',
        'duedate',

    ];

    
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

}
