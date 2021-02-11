<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];
    protected $casts = [
        'permission' => 'json',

    ];



    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
