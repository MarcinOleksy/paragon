<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupy extends Model
{
	protected $table = 'grupy';
	
	public $timestamps = false;
	
	public function GrupyDoProduktu()
	{
		return $this->belongsToMany('App\Models\Produkty', 'grupy_prodykty');
	}
	
	public function Konto()
    {
        return $this->belongsTo('App\Models\User', 'Konto', 'Id');
    }
}