<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use NotificationChannels\WebPush\HasPushSubscriptions;
class User extends Authenticatable implements JWTSubject
{
   
    use HasPushSubscriptions;

     use Notifiable;

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

     public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [
            'id'=>$this->id,
            'email'=>$this->email,
            'id_rol'=>$this->id_rol,
            'id_fraccionamiento'=>$this->id_fraccionamiento

        ];
    }
}
