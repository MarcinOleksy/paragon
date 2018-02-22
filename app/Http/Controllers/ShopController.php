<?php

namespace App\Http\Controllers;

use App\Models\Sklepy;

class ShopController extends Controller
{
 	public function index()
 	{
		$shop = Sklepy::All(); 
		
		return view('shops.index', [ 'shops' => $shop ]);
		
		
		/*
 		$options = 'REAL';

		$shop = new Shop();
		
		$lista = $shop->getShopByKryteria($options);


 		return view('shops.index', [ 'shops' => $lista ]);
		*/
 	}

 	//dodawala sklep
 	public function create()
 	{

 		return 'dodaj';
 	}

 	//edytowanie
 	public function update()
 	{

 		return 'update';
 	}

 	//delete
	public function delete()
	{

		return 'delete';
	}

}

