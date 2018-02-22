<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
	use Notifiable;
	
	protected $table = 'konta';
	public $timestamps = false;
	
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
	
	public function KontoDoParagonu()
	{
		return $This->belongsTo('App\Models\Paragony');
	}
	
	public function KontoDoGrupy()
	{
		return $this->belongsTo('App\Models\Grupy');
	}
	
	public function KontoDoListy()
	{
		return $This->hasOne('App\Models\Listy');
	}
}