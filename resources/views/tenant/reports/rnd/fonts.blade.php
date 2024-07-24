<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
	

	
<style>
	/* @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap');
	@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap');
	@import url('https://fonts.googleapis.com/css2?family=Lato:wght@200&display=swap'); 
	*/
	#my-header-table {
		border-collapse: collapse;
		border: 0px solid white;
		width: 100%;
		font-size: 12px;
		padding-bottom: 8px;
	}
	#my-header-table h1,h2,h3 {

		margin-top: 0px;
		margin-bottom: 1px;
		color: #1F9BCF;
	}
	/* #my-header-table td {
		text-align: center;
	} */
	#my-header-table td {
		border: 1px solid #FFFFFF;
	}
	
	body {
		font-family: "Lato", sans-serif;
	}

	div {
		font-family: 'Oswald', sans-serif;
	}
 
	.m{
	font-family: 'Montserrat', sans-serif;
	}

	.l{
	font-family: 'Lato', sans-serif;
	}

	.p{
	font-family: 'Poppins', sans-serif;
	}

	.r{
	font-family: 'Roboto', sans-serif;
	}
	/* body {
		font-family: 'Oswald', sans-serif
	} */


	/** Define the margins of your page **/
	@page{
		margin-top: 50px; /* create space for header */
		margin-bottom: 50px; /* create space for footer */
	}
	
</style>
</head>
<body>
	
	<table id="my-header-table">
		<tr>
			<td width="60%" style="text-align:left; vertical-align: bottom;">
				<h1>{{ $title }}</h1>
			</td>
			<td style="text-align:right">
				<img src="{{ storage_path('app/logo/logo.png') }}" style="width: 75px"><br>
			</td>
		</tr>
		<tr>
			<td width="70%" style="text-align:left;">
				Flat#C3, Plot# 222, Road# 8,Block-C</br>
				Bashundhara R/A , Dhaka -1229</br>
				Phone: 01911310509 email: info@khondker.com, </br>
				Website: https://www.anypo.net <br>
				<p class="m">
					The quick brown fox jumps over the lazy dog -Montserrat
				</p>
				<p class="p">
					The quick brown fox jumps over the lazy dog -Poppins
				</p>
				<p class="l">
					The quick brown fox jumps over the lazy dog - Lato
				</p>
			
				<p class="r">
					The quick brown fox jumps over the lazy dog - Roboto
				</p>
			</td>
			<td style="text-align:right; vertical-align: bottom;">
				<h2>PURCHASE REQUISITION</h2>
				REQUISITION NO: <strong>[ 1234 ]</strong><br>
				DATE: 4-AUG-2023
				
			</td>
		</tr>
	</table>


</body>
</html>


