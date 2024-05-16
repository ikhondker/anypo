<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" >
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
<style>
	/* body {
	  font-family: "Sofia", sans-serif;
	} */

	#my-header-table {
		font-family: Arial, Helvetica, sans-serif;
		/* font-family: "Poppins", sans-serif; */
		border-collapse: collapse;
		border: 0px solid white;
		width: 100%;
		font-size: 12px;
		padding-bottom: 8px;
	}
	#my-header-table h1,h3 {
		font-family: Arial, Helvetica, sans-serif;
		margin-top: 0px;
		margin-bottom: 1px;
	}
	/* #my-header-table td {
		text-align: center;
	} */
	#my-header-table table, th, td {
		border: 0px solid white;
	}

	.header, .footer {
		width: 100%;
		text-align: center;
		position: fixed;
	}
	.header {
		top: 0px;
	}
	.footer {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 10px;
		bottom: 0px;
	}

	#report-footer {
		font-family: Arial, Helvetica, sans-serif;
		/* font-family: "Poppins", sans-serif; */
		border-collapse: collapse;
		width: 100%;
		font-size: 10px;
		padding-bottom: 2px;
		color: #808080;
	}
	#report-footer  tr {
		padding-top: 4px;
		border-top: 1px solid #C0C0C0;
	}

	.pagenum:before {
		content: counter(page);
	}

	#my-table {
		font-family: Arial, Helvetica, sans-serif;
		/* font-family: "Poppins", sans-serif; */
		border-collapse: collapse;
		width: 100%;
		font-size: 12px;
	}

	#my-table td, #my-table th {
		border: 1px solid #f2f2f2;
		padding: 5px;
	}

	#my-table tr:nth-child(even){background-color: #f2f2f2;}

	#my-table tr:hover {background-color: #FFFFFF;}

	#my-table th {
		padding-top: 8px;
		padding-bottom: 8px;
		text-align: left;
		background-color: #3F80EA;
		border: 1px solid #3F80EA;
		color: white;
	}

</style>
</head>
<body>
	{{-- <div class="header">
		Page <span class="pagenum"></span>
	</div> --}}
	<div class="footer">
		<table id="report-footer">
			<tr>
				<td>
					Printed By: Iqbal H Khondker at : 8-Jun-22
				</td>
				<td style="text-align:right">
					Page <span class="pagenum"></span>
				</td>
			</tr>
		</table>

	</div>

	<table id="my-header-table">
		<tr>
			<td width="80%" style="text-align:left">
				<h1>Sample PDF Report</h1>
				<h3>{{ $title }}</h3>
				Flat#C3, Plot# 222, Road# 8,Block-C, Bashundhara R/A , Dhaka -1229</br>
				email: info@khondker.com, cell: 01911310509</br>
				Report Date: {{ $date}}
				{{-- Facebook https://www.facebook.com/Demo-Shop-for-my-table-103052285788580/</br>
				TIN Number: 9790404436093 --}}
			</td>
			<td style="text-align:right">
			  {{-- <img src="{{ storage_path('app/img/avatar.png') }}" style="width: 80px"> --}}
			  <img src="{{ storage_path('app/logo/logo.png') }}" style="width: 80px">
			</td>

		</tr>
	</table>

	<table id="my-table">
		<tr>
			<th>COMPANY</th>
			<th>Contact</th>
			<th>Country</th>
		</tr>
		<tr>
			<td>Alfreds Futterkiste</td>
			<td>Maria Anders</td>
			<td>Germany</td>
		</tr>
		<tr>
			<td>Berglunds snabbköp</td>
			<td>Christina Berglund</td>
			<td>Sweden</td>
		</tr>
		<tr>
			<td>Centro comercial Moctezuma</td>
			<td>Francisco Chang</td>
			<td>Mexico</td>
		</tr>
		<tr>
			<td>Ernst Handel</td>
			<td>Roland Mendel</td>
			<td>Austria</td>
		</tr>
		<tr>
			<td>Island Trading</td>
			<td>Helen Bennett</td>
			<td>UK</td>
		</tr>
		<tr>
			<td>Königlich Essen</td>
			<td>Philip Cramer</td>
			<td>Germany</td>
		</tr>
		<tr>
			<td>Laughing Bacchus Winecellars</td>
			<td>Yoshi Tannamuri</td>
			<td>Canada</td>
		</tr>
		<tr>
			<td>Magazzini Alimentari Riuniti</td>
			<td>Giovanni Rovelli</td>
			<td>Italy</td>
		</tr>
		<tr>
			<td>North/South</td>
			<td>Simon Crowther</td>
			<td>UK</td>
		</tr>
		<tr>
			<td>Paris spécialités</td>
			<td>Marie Bertrand</td>
			<td>France</td>
		</tr>
		<tr>
			<td>Alfreds Futterkiste</td>
			<td>Maria Anders</td>
			<td>Germany</td>
		</tr>
		<tr>
			<td>Berglunds snabbköp</td>
			<td>Christina Berglund</td>
			<td>Sweden</td>
		</tr>
		<tr>
			<td>Centro comercial Moctezuma</td>
			<td>Francisco Chang</td>
			<td>Mexico</td>
		</tr>
		<tr>
			<td>Ernst Handel</td>
			<td>Roland Mendel</td>
			<td>Austria</td>
		</tr>
		<tr>
			<td>Island Trading</td>
			<td>Helen Bennett</td>
			<td>UK</td>
		</tr>
		<tr>
			<td>Königlich Essen</td>
			<td>Philip Cramer</td>
			<td>Germany</td>
		</tr>
		<tr>
			<td>Laughing Bacchus Winecellars</td>
			<td>Yoshi Tannamuri</td>
			<td>Canada</td>
		</tr>
		<tr>
			<td>Magazzini Alimentari Riuniti</td>
			<td>Giovanni Rovelli</td>
			<td>Italy</td>
		</tr>
		<tr>
			<td>North/South</td>
			<td>Simon Crowther</td>
			<td>UK</td>
		</tr>
		<tr>
			<td>Paris spécialités</td>
			<td>Marie Bertrand</td>
			<td>France</td>
		</tr>
		<tr>
			<td>Alfreds Futterkiste</td>
			<td>Maria Anders</td>
			<td>Germany</td>
		</tr>
		<tr>
			<td>Berglunds snabbköp</td>
			<td>Christina Berglund</td>
			<td>Sweden</td>
		</tr>
		<tr>
			<td>Centro comercial Moctezuma</td>
			<td>Francisco Chang</td>
			<td>Mexico</td>
		</tr>
		<tr>
			<td>Ernst Handel</td>
			<td>Roland Mendel</td>
			<td>Austria</td>
		</tr>
		<tr>
			<td>Island Trading</td>
			<td>Helen Bennett</td>
			<td>UK</td>
		</tr>
		<tr>
			<td>Königlich Essen</td>
			<td>Philip Cramer</td>
			<td>Germany</td>
		</tr>
		<tr>
			<td>Laughing Bacchus Winecellars</td>
			<td>Yoshi Tannamuri</td>
			<td>Canada</td>
		</tr>
		<tr>
			<td>Magazzini Alimentari Riuniti</td>
			<td>Giovanni Rovelli</td>
			<td>Italy</td>
		</tr>
		<tr>
			<td>North/South</td>
			<td>Simon Crowther</td>
			<td>UK</td>
		</tr>
		<tr>
			<td>Paris spécialités</td>
			<td>Marie Bertrand</td>
			<td>France</td>
		</tr>
		<tr>
			<td>Königlich Essen</td>
			<td>Philip Cramer</td>
			<td>Germany</td>
		</tr>
		<tr>
			<td>Laughing Bacchus Winecellars</td>
			<td>Yoshi Tannamuri</td>
			<td>Canada</td>
		</tr>
		<tr>
			<td>Magazzini Alimentari Riuniti</td>
			<td>Giovanni Rovelli</td>
			<td>Italy</td>
		</tr>
		<tr>
			<td>North/South</td>
			<td>Simon Crowther</td>
			<td>UK</td>
		</tr>
		<tr>
			<td>Paris spécialités</td>
			<td>Marie Bertrand</td>
			<td>France</td>
		</tr>
		<tr>
			<td>Königlich Essen</td>
			<td>Philip Cramer</td>
			<td>Germany</td>
		</tr>
		<tr>
			<td>Laughing Bacchus Winecellars</td>
			<td>Yoshi Tannamuri</td>
			<td>Canada</td>
		</tr>
		<tr>
			<td>Magazzini Alimentari Riuniti</td>
			<td>Giovanni Rovelli</td>
			<td>Italy</td>
		</tr>
		<tr>
			<td>North/South</td>
			<td>Simon Crowther</td>
			<td>UK</td>
		</tr>
		<tr>
			<td>Paris spécialités</td>
			<td>Marie Bertrand</td>
			<td>France</td>
		</tr>
	</table>
</body>
</html>


