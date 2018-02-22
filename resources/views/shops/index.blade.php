<form action="" method="post">
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