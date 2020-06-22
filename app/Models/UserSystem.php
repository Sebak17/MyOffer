<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSystem extends Model
{
    protected $table = 'users_system';

	public $timestamps = false;

	protected $fillable = [
        'user_id', 'firstIP', 'activationHash', 'activationMailTime', 'passwordResetHash', 'passwordResetMailTime',
    ];

	public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
