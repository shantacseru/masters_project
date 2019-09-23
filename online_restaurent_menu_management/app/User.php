<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use TCG\Voyager\Traits\VoyagerUser;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;
    use VoyagerUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // $canVisitAdmin = $user->hasPermission('browse_admin');
    // $canVisitAdmin = auth()->user()->hasPermission('browse_admin');

    // Voyager::can('browse_admin');
}
