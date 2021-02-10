<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Work extends Model
{
    protected $fillable = [
        'work_name',
        'dept_id'
    ];

    protected $appends = [
        'user_list',
    ];

    /**
     * Get products categories.
     *
     * @return string
     */
    public function getUserListAttribute()
    {
        return $this->users->pluck('id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'dept_id', 'id');
    }
}
