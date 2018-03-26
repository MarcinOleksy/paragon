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
		$kwota = service::Kwota(1);
		$suma = service::Suma();
		$array = [ 'products' => ['Wydane' => $suma, 'Wolne' => $kwota - $suma], 'Kwota' => $kwota];
		return view('wollet.index', $array);	
 	}
}
