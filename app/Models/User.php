<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'npsn',
        'password',
        'is_admin',
         // adding this
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getStatus(){
      $user_status = [];
      $user_status[] = $this->is_admin == 1 ? 'Admin' : null;
      $user_status[] = $this->is_admin == 0 ? 'User' : null;
      $user_status = array_filter($user_status);

      return implode(',', $user_status);
    }

    public function proposal(){
      return $this->hasMany(Proposal::class);
    }
}
