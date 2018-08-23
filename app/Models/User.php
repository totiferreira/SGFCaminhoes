<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Webpatser\Uuid\Uuid;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    
    protected $fillable = [
        'uuid', 'id', 'name', 'email', 'role', 'status', 'password', 'remember_token'
    ];
    
    public static function boot()
    {   
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

   /* public function fillByRequest(Array $data) {
        $this->name = (array_key_exists('name', $data)) ? $data ['name'] : $this->name;
        $this->email = (array_key_exists('email', $data)) ? $data ['email'] : $this->email;
        $this->role = (array_key_exists('role', $data)) ? $data ['role'] : $this->role;
        $this->status = (array_key_exists('status', $data)) ? $data ['status'] : $this->status;
        //$this->password = (array_key_exists('password', $data)) ? $data ['password'] : $this->password;
    }*/
}