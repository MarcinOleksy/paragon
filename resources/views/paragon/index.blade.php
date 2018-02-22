<!DOCTYPE html>
<html>
	<head>
		<title>Tytul strony</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="css/reset.css"/>
		<link rel="stylesheet" type="text/css" href="css/style.css" />	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script>
		
		function dodaj_element(kontener)
		{
			var kontener = document.getElementById(kontener);
			
			var row = document.createElement('div');
			
			var znacznik1 = document.createElement('span');
			znacznik1.innerHTML = "Towar: ";
			
			var znacznik2 = document.createElement('input');
			znacznik2.setAttribute('type', 'text');
			znacznik2.setAttribute('name', 'towar[]');
			znacznik2.className = 'top right';
			
			var znacznik3 = document.createElement('span');
			znacznik3.innerHTML = "Ile: ";
			
			var znacznik4 = document.createElement('input');
			znacznik4.setAttribute('type', 'test');
			znacznik4.setAttribute('name', 'ile[]');
			znacznik4.style.width = "40px";
			znacznik4.setAttribute('onclick', 'selectText(this.name)');
			znacznik4.value = "1";
			znacznik4.className = 'top right';
			
			var znacznik5 = document.createElement('span');
			znacznik5.innerHTML = "Cena: ";
			
			var znacznik6 = document.createElement('input');
			znacznik6.setAttribute('type', 'test');
			znacznik6.setAttribute('name', 'cena[]');
			znacznik6.className = 'top right';
			
			var znacznik7 = document.createElement('input');
			znacznik7.setAttribute('type', 'button');
			znacznik7.setAttribute('onclick', 'usun(this)');
			znacznik7.setAttribute('value','usun');
			znacznik7.className = 'top right';
			
			row.appendChild(znacznik1);
			row.appendChild(znacznik2);
			row.appendChild(znacznik3);
			row.appendChild(znacznik4);
			row.appendChild(znacznik5);
			row.appendChild(znacznik6);
			row.appendChild(znacznik7);
			kontener.appendChild(row);
		}
		
		function usun(row)
		{
			row.parentNode.parentNode.removeChild(row.parentNode);
		}
		
		function selectText(da) 
		{
                var oTextbox1 = document.getElementById(da);
                oTextbox1.focus();
                oTextbox1.select();
        }
		</script>
		
	</head>
	<body onload="dodaj_element('kopia');">
	
	<div class="strona">
	
		<div id="header">
			<div id="logo">
				<img src = "image/tlo2.png" />
			</div>	
		</div>
	</div>
		<div id="menu">
			<ul>
				<li><a href="portfel.php"> Stan zasilenia </a></li>
				<li><a href="zapisywanie.html"> Wprowadzanie paragonu </a></li>
				<li><a href="sprawdzanie.html">  Sprawdzanie paragonu </a></li>
				<li><a href="lista.html"> Lista Zakupów </a></li>
			</ul>
			<div id="menu2">
			</div>
		</div>
		<div class="strona">
		
			<div class="zawartosc1">
				<form action="/zapisz" method="post" class="zawartosc1">
					<div class="zawartosc2">					
						<div class="top"><div class="etykieta">Sklep:</div><input type="test" id="sklep" name="sklep" onclick="selectText(this.name)"/></div>
						<div class="top"><div class="etykieta">Data:</div><input type="data" id="data" name="data" placeholder='rok-miesiac-dzien' /></div>
					</div>
					<div id="kopia">
						<div class="row">
							
						</div>
					</div>
					
					<div class="zawartosc2">
						<input type="button" value="Dodaj produkt" onclick="dodaj_element('kopia');" class="top right"/>
						<input type="submit" value="Gotowe" class="przycisk"/>
					</div>
				</form>
			</div>
		</div>	
	</body>
</html>