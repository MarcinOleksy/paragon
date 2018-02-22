<?php

namespace App\Http\Controllers;

use App\Models\Produkty;
use App\Models\Paragony;
use App\Models\Zakupy;
use App\Models\User;
use App\Models\Grupy;

class WolletController extends Controller
{
 	public function index()
 	{	
 		$Suma = 0; 
		$start = date('Y-m-d', mktime(0,0,0,date('m'),1,date('Y'))); 
		$stop = date('Y-m-d', mktime(0,0,0,date('m')+1,0,date('Y')));
		$Zapytanie = Paragony::where('Konto', 1)->whereBetween('Data', ['$start', $stop])->with('Zakupy')->get();
		$Kwota = User::where('Id', 1)->value('Kwota');

		foreach ($Zapytanie as $Paragony)
			foreach ($Paragony->Zakupy as $Wiersz)
				$Suma += $Wiersz->Cena*$Wiersz->Ile;
			
		$tablica = array(array('Wydane', $Suma), array('Wolne', $Kwota - $Suma));
		
		return view('wollet.index', [ 'products' => $tablica]);	
 	}
}
