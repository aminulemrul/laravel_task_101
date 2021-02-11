<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserWork extends Model
{
    protected $guarded = [];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
