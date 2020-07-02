<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'active', 'avatar',
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
    ];

    public function history()
    {
        return $this->hasMany('App\Models\UserHistory');
    }

    public function personal()
    {
        return $this->hasOne('App\Models\UserPersonal');
    }

    public function system()
    {
        return $this->hasOne('App\Models\UserSystem');
    }

    public function favorites()
    {
        return $this->hasOne('App\Models\UserFavorites');
    }

    public function getAvatarURL()
    {

        if ($this->avatar == null) {
            return "/assets/img/avatar_1.png";
        } else {
            return "/storage/avatars/" . $this->avatar;
        }

    }

    public function getFavorites()
    {
        $fav = $this->favorites;

        if ($fav == null) {
            $fav = \App\Models\UserFavorites::create([
                'user_id'  => $this->id,
                'offers' => json_encode([]),
            ]);
        }

        return $fav;
    }

}
