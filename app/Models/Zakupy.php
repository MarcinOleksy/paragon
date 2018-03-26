<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zakupy extends Model
{
	protected $table = 'zakupy';
	
	public $timestamps = false;
	
	public function ZakupyDoParagonu()
	{
		//tu jest ok
		return $this->belongsTo('App\Models\Paragony', 'Paragon', 'Id');
	}
	
	public function Produkty()
    {
        return $this->hasMany('App\Models\Produkty', 'Id', 'Produkt');
    }
}