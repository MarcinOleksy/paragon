<?php

namespace App\Http\Controllers;

use App\Models\Produkty;
use App\Models\Paragony;
use App\Models\Zakupy;
use App\Models\User;
use App\Models\Grupy;
use App\Service\service;

class WolletController extends Controller
{
 	public function index()
 	{	
<<<<<<< HEAD
		$kwota = service::Kwota(1);
		$suma = service::Suma();
		$array = [ 'products' => ['Wydane' => $suma, 'Wolne' => $kwota - $suma], 'Kwota' => $kwota];
=======
 		$Suma = 0; 
		$start = date('Y-m-d', mktime(0,0,0,date('m'),1,date('Y'))); 
		$stop = date('Y-m-d', mktime(0,0,0,date('m')+1,0,date('Y')));
		// $Zapytanie = Paragony::where('Konto', 1)->whereBetween('Data', [$start, $stop])->with('Zakupy')->get();
		// $Kwota = User::where('Id', 1)->value('Kwota');

		// foreach ($Zapytanie as $Paragony)
		// 	foreach ($Paragony->Zakupy as $Wiersz)
		// 		$Suma += $Wiersz->Cena*$Wiersz->Ile;
			
		Zakupy::selectRaw('SUM(Cena*Ile) as Suma')->whereHas('Paragon', function($query) use($start, $stop){
			$query->whereBetween('Data', [$start, $stop]);
		})->first();


		$array = [ 'products' => ['Wydane' => $Suma, 'Wolne' => $Kwota - $Suma], 'innazmiena' => 355];

>>>>>>> 2bcac35b4777ddb7949cab1ca325c72fa6bdbbf3
		return view('wollet.index', $array);	
 	}
}
