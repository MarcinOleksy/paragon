<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Listy extends Model
{
	protected $table = 'listy';
	public $timestamps = false;
	
	public function Produkty()
	{
		return $this->hasMany('App\Models\Produkty');
	}
}