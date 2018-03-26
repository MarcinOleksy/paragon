<?php

namespace App\Service;

use App\Models\Produkty;
use App\Models\Paragony;
use App\Models\Zakupy;
use App\Models\User;
use App\Models\Grupy;
use App\Models\Sklepy;

use Request;

class Service
{
	static public function Suma()
	{
		$start = date('Y-m-d', mktime(0,0,0,date('m'),1,date('Y'))); 
		$stop = date('Y-m-d', mktime(0,0,0,date('m')+1,0,date('Y')));
		return Zakupy::selectRaw('IF(SUM(Cena*Ile),SUM(Cena*Ile) ,0) as suma')->whereHas('ZakupyDoParagonu', function($query) use($start, $stop){
			$query->whereBetween('Data', [$start, $stop]);})->value('suma');
		//mnozy cene z ilosiac z danego miesiaca
		//potem sumuje otrzymane wyniki
	}

	static public function Kwota($id)
	{
		return User::where('Id', $id)->value('Kwota');
		//wyciaga wartosc pola kwota
	}

	
	static public function TworzSklep($nazwa)
	{
		$iSklep = new Sklepy;
		$iSklep->Nazwa = $nazwa;
		$iSklep->Save();
	}

	static public function SzukajSkelp($nazwa)
	{
		return Sklepy::where('Nazwa', $nazwa)->value('Id');
	}

	static public function TworzParagon($data, $konto, $sklep)
	{
		$paragon = new Paragony;
		$paragon->Data = $data;
		$paragon->Konto = $konto;
		$paragon->Sklep = $sklep;
		$paragon->Save();
	}

	static public function SzukajParagon($data, $konto, $idSklep)
	{
		return Paragony::where("Data", $data)->where("Konto", $konto)->where("Sklep", $idSklep)->value('Id');
	}

	static public function TworzProdukt($nazwa)
	{
		$iProd = new Produkty;
		$iProd->Nazwa = $nazwa;
		$iProd->Save();
	}

	static public function SzukajProdukt($nazwa)
	{
		return Produkty::where('Nazwa', $nazwa)->value('Id');
	}

	static public function TworzZakup($idParagon, $idProd, $ile, $cena)
	{
		$zakup = new Zakupy;
		$zakup->Paragon = $idParagon;
		$zakup->Produkt = $idProd;
		$zakup->Ile = $ile;
		$zakup->Cena = $cena;
		$zakup->Save();
	}

	static public function UzupełnianieDanychZakupów($towar, $idParagon, $ile, $cena)
	{
		for($i=0; $i<count($towar); $i++)	
			{
				//produkty
				$idProd = Service::SzukajProdukt($towar[$i]);
				if(is_null($idProd))
				{
					Service::TworzProdukt($towar[$i]);
					$idProd = Service::SzukajProdukt($towar[$i]);
				}
				
				Service::TworzZakup($idParagon, $idProd, $ile[$i], $cena[$i]);
			}
	}


	static public function ProduktyKlienta($Konto)
	{
		return Produkty::selectRaw('Nazwa')->whereHas('ProduktyDoZakupy.ZakupyDoParagonu', function($query) use($Konto){
			$query->where('Konto', $Konto);})->get();
		//lista produktow danego klienta
	}

	static public function ParagonyKlienta($Konto)
	{
		return Paragony::selectRaw('Id')->where('Konto', $Konto)->get();
		//numery paragonow danego klienta
	}

	static public function ProduktyJedenParagon($NrParagonu)
	{
		return Produkty::selectRaw('Nazwa')->whereHas('ProduktyDoZakupy', function($query) use($NrParagonu){
			$query->where('Paragon', $NrParagonu);})->get();
		//jedna lista produktów danego klienta w danym paragonie
	}

	static public function ProduktyKlientaParagony($Konto)
	{
		$Paragony = service::ParagonyKlienta($Konto);
		foreach ($Paragony as $value) 
				$tablica[] = service::ProduktyJedenParagon($value->Id);
		return $tablica;

		//listy produktow z paragonu danego klienta
	}

	

	static public function Kombinacje()
	{
		$produkt = service::ProduktyKlienta(1);

		for($i=0;$i<count($produkt);$i++)
		{
			$tablica[0][] = [$produkt[$i]->Nazwa];
			for($j=$i+1;$j<count($produkt);$j++)
			{
				$tablica[1][] = [$produkt[$i]->Nazwa,$produkt[$j]->Nazwa];
				for($k=$j+1;$k<count($produkt);$k++)
				{
					$tablica[2][] = [$produkt[$i]->Nazwa,$produkt[$j]->Nazwa,$produkt[$k]->Nazwa];
					for($p=$k+1;$p<count($produkt);$p++)
					{
						$tablica[3][] = [$produkt[$i]->Nazwa,$produkt[$j]->Nazwa,$produkt[$k]->Nazwa,$produkt[$p]->Nazwa];
						for($l=$p+1;$l<count($produkt);$l++)
						{
							$tablica[4][] = [$produkt[$i]->Nazwa,$produkt[$j]->Nazwa,$produkt[$k]->Nazwa,$produkt[$p]->Nazwa, $produkt[$l]->Nazwa];
						}
					}
				}
			}
		}

		return $tablica;
	}

	static public function Grupowanie()
	{
		$Paragony = service::ProduktyKlientaParagony(1);
		$KombinacjeProduktow = service::Kombinacje();
		$KombinacjaPowtarzaSie = 0;
		foreach ($Paragony as $Paragon) {
			$ile = 0;
			echo "<div></div>";
			foreach ($KombinacjeProduktow[0][1] as $value) {
				foreach ($Paragon as $value2) {
					echo $value2->Nazwa." = ".$value." | ";
					if($value2->Nazwa == $value)
					{
						$ile++;
					}
				}
			}
			if($ile == count($KombinacjeProduktow[0][1]))
			{
				$KombinacjaPowtarzaSie++;
				echo "TAK".$ile;
			}
		}

		echo $KombinacjaPowtarzaSie;

		dd($KombinacjeProduktow);
		//dd($Paragony);
		//rozdziela jedna liste na kilka mniejszych o wielkosci 2,3,4...
	}

	static public function Zestawienie()
	{
		//poruwnuje Grupe o wielkosci 2,3,4 do innych paragow i sprawdza ile jest takich grup
		//woda piwo  |chleb 3elementowa = 10powtórzeń. 2elementowa = 15powtorzeń. czyli 10/15 czyli 66%, żę kupujac wode i piwo kupuej sie chleb 
		//woda chleb |piwo  3elementowa = 10powtorzen. 2elementowa = 11powtorzeń. czyli 10/11 czyli 91%, że kujując wode i chleb kupuje sie piwo <- powinno zaproponowac piwo do listy
		//piwo chleb |woda  3elementowa = 10powtorzen. 2elementowa = 25powtorzen. czyli 10/25 czyli 40%, ze kupujac piwo i chleb kupuje sie wode 
	}

	static public function Poruwnuje()
	{
		//to co jest na liscie z zestawieniami, i jak znajduje się jakieś to dodaje produkt
	}
}