<?php

namespace App\Http\Controllers;

use App\Models\Produkty;
use App\Models\Paragony;
use App\Models\Zakupy;
use App\Models\User;
use App\Models\Grupy;
use App\Models\Sklepy;
use App\Service\service;

use Request;

class ParagonController extends Controller
{
 	public function index()
 	{	
 		return view('paragon.index');
 	}
<<<<<<< HEAD
=======

 	public function zapiszParagon2(Request $request)
 	{
 		$sklep = strtoupper(Request::input('sklep'));
 		$data = Request::input('data');
 		$towar = array_map('strtoupper', Request::input('towar'));
 		$ile = Request::input('ile');
		$cena = str_replace(",",".", Request::input('cena'));
 
 	}

 	public function test()
 	{
 		if($warunek)
 		{
 			//costam
 			return $zmienna;
 		} else
 		{
 			//costam
 			return $zmienna2;
 		}	

 	}
	
	public function test2()
 	{
		if(!$warunek) return $zmienna2;
 		
 			//costam
 			return $zmienna;
 	}

>>>>>>> 2bcac35b4777ddb7949cab1ca325c72fa6bdbbf3
 	
 	public function zapiszParagon() 
 	{
		$sklep = strtoupper(Request::input('sklep'));
 		$data = Request::input('data');
 		$towar = array_map('strtoupper', Request::input('towar'));
 		$ile = Request::input('ile');
		$cena = str_replace(",",".", Request::input('cena'));
		$konto = 1;

		if($sklep and $data and $towar and $cena)
		{
			//sklep
			$idSklep = Service::SzukajSkelp($sklep);
			if(is_null($idSklep))
			{
				Service::TworzSklep($sklep);
				$idSklep = Service::SzukajSkelp($sklep);
			}

			//data
			if($data > date('Y-m-d') || $data <= date('1972-01-01'))
				exit();

			//pragon
			Service::TworzParagon($data, $konto, $idSklep);
			$idParagon = Service::SzukajParagon($data, $konto, $idSklep);

			//zakupy
			Service::Zakupy($towar, $idParagon, $ile, $cena);
		}
	}

}