<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'fullName', 'phone', 'dept_id','status', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function departments()
    {
        return $this->belongsTo('App\Models\Department', 'dept_id', 'id');
    }
    protected $appends = [
        'work_list',
    ];

    /**
     * Get products categories.
     *
     * @return string
     */
    public function getWorkListAttribute()
    {
        return $this->works->pluck('id');
    }

    public function works()
    {
        return $this->belongsToMany('App\Models\Work');
    }
}
