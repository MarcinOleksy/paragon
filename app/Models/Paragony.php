<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paragony extends Model
{
	protected $table = 'paragony';

	public $timestamps = false;

	public function Konto()
	{
		return $this->hasMany('App\Models\User');
	}
	
	public function Zakupy()
	{
		return $this->hasMany('App\Models\Zakupy', 'Paragon', 'Id');
	}

	public function Paragon()
	{
		return $this->belongsTo(Paragon::class, 'Paragon');
	}
}