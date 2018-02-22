<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sklepy extends Model
{
	protected $table = 'sklepy';

	public $timestamps = false;

	public function SklepyDoZakupy()
	{
		return $this->belongsTo('App\Models\zakupy');
	}
	
}