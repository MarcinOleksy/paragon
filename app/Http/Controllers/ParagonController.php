<?php

namespace App\Http\Controllers;

use App\Models\Produkty;
use App\Models\Paragony;
use App\Models\Zakupy;
use App\Models\User;
use App\Models\Grupy;
use App\Models\Sklepy;

use Request;

class ParagonController extends Controller
{
 	public function index()
 	{	
 		return view('paragon.index');
 	}

 	public function zapiszParagon2(Request $request)
 	{
 		$sklep = strtoupper(Request::input('sklep'));
 		$data = Request::input('data');
 		$towar = array_map('strtoupper', Request::input('towar'));
 		$ile = Request::input('ile');
		$cena = str_replace(",",".", Request::input('cena'));
 
 	}



 	
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
			
			$idSklep = Sklepy::where('Nazwa', $sklep)->value('Id');
			if(is_null($idSklep))
			{
				$iSklep = new Sklepy;
				$iSklep->Nazwa = $sklep;
				$iSklep->Save();
				$idSklep = Sklepy::where('Nazwa', $sklep)->value('Id');
				echo "stworzono sklep";
			}else
				echo "jest sklep ".$idSklep;

			
			//data
			if($data > date('Y-m-d') || $data <= date('1972-01-01'))
			{
				echo "nie poprawna data";
				exit();
			}
			else
				echo "poprana data";

			//pragon
			$paragon = new Paragony;
			$paragon->Data = $data;
			$paragon->Konto = $konto;
			$paragon->Sklep = $idSklep;
			$paragon->Save();
			$idParagon = Paragony::where("Data", $data)->where("Konto", $konto)->where("Sklep", $idSklep)->value('Id');
			echo $idParagon;
			//zakupy
			for($i=0; $i<count($towar); $i++)	
			{
				//produkty
				echo $towar[$i];
				$idProd = Produkty::where('Nazwa', $towar[$i])->value('Id');

				if(is_null($idProd))
				{
					$iProd = new Produkty;
					$iProd->Nazwa = $towar[$i];
					$iProd->Save();
					$idProd = Produkty::where('Nazwa', $towar[$i])->value('Id');
					echo "stworzono Produkt";
				}else
					echo "nie tworzono produktu";
				
				$zakup = new Zakupy;
				$zakup->Paragon = $idParagon;
				$zakup->Produkt = $idProd;
				$zakup->Ile = $ile[$i];
				$zakup->Cena = $cena[$i];
				$zakup->Save();
				
			}
		}
	}
	
}