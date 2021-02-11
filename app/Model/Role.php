<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $with = ['permission', 'user'];
    protected $guarded = [];



    public function permission()
    {
        return $this->hasOne(Permission::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
