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

class ListaController extends Controller
{
 	public function index()
 	{	
 		//echo service::ProduktyKlienta(1);
 		//echo service::ProduktyJedenParagon(3);
 		//echo service::ParagonyKlienta(1);

 		service::grupowanie();

 		//return view('lista.index');
 	}

 	public function zapiszLista()
 	{
 		//$towar= array_map('strtoupper', Request::input('towar'));
 		//$ile = Request::input('ile');
 	}
 	

}