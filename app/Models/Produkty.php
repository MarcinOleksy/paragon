<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Produkty extends Model
{
	protected $table = 'produkty';
	public $timestamps = false;
	
	public function ProduktyDoListy()
	{
		return $this->belongsTo('App\Models\Listy');
	}
	
	public function ProduktyDoGrupy()
	{
		return $this->belongsToMany('App\Models\Grupy', 'grupy_prodykty');
	}
	
	public function ProduktyDoZakupy()
	{
		return $this->belongsTo('App\Models\Zakupy', 'Id', 'Produkt');
	}
}