<html>
<head>
<head>
	<title>Tytul strony</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="css/reset.css"/>
	<link rel="stylesheet" type="text/css" href="css/style.css" />	
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
      @if(count($products))
        @foreach($products as $label => $value)
         [' {{ $label  }}',  {{ $value }} ],
      @endforeach
      @else
       Nie ma kurwa danych
      @endif
        ]);

        var options = {
          title: 'Wydatki'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
  </script>
</head>
<body>
	<div class="strona">
		
			<div id="header">
				<div id="logo">
					<img src = "tlo2.png" />
				</div>	
			</div>
		</div>
			<div id="menu">
				<ul>
					<li><a href="/wollet"> Stan zasilenia </a></li>
					<li><a href="/paragon"> Wprowadzanie paragonu </a></li>
					<li><a href="sprawdzanie.html"> Sprawdzanie paragonu </a></li>
					<li><a href="lista.html"> Lista Zakupow </a></li>
				</ul>
				<div id="menu2">
				</div>
			</div>

		<div class="strona">
			<P>Budżet:{{$Kwota}}</P>
			@foreach($products as $label => $value)
			<P>{{$label}}:{{$value}}</P>
			@endforeach

			<div id="piechart" style="width: 900px; height: 500px; margin: 0 auto;"></div>
		</div>
</body>
</html>

