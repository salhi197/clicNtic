<?php

namespace App;
use App\Wilaya;
use App\Commune;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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

    public function getWilaya()
    {
        return Wilaya::where('id',$this->wilaya_id)->first()['name'];
    }
   
    public function getCommune()
    {
        return Commune::where('id',$this->wilaya_id)->first()['name'];
    }
    
}
