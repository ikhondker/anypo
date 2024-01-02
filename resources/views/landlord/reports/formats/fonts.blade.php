<!DOCTYPE html>
<html>
<head>
	<title>Laravel Dompdf Add Custom Font Family Example - ItSolutionStuff.com</title>
	<style>
		@font-face {
			font-family: 'Croissant One';
			font-weight: normal;
			font-style: normal;
			font-variant: normal;
			src: url("fonts/Croissant_One/CroissantOne-Regular.ttf") format('truetype');
		}
		@font-face {
			font-family: 'Atma';
			font-weight: normal;
			font-style: normal;
			font-variant: normal;
			src: url("fonts/atma/Atma-Regular.ttf") format('truetype');
		}
		@font-face {
			font-family: 'Lato';
			font-weight: normal;
			font-style: normal;
			font-variant: normal;
			src: url("fonts/lato/Lato-Regular.ttf") format('truetype');
		}
		@font-face {
			font-family: 'Montserrat';
			font-weight: normal;
			font-style: normal;
			font-variant: normal;
			src: url("fonts/montserrat/Montserrat-Regular.ttf") format('truetype');
		}

		@font-face {
			font-family: 'Poppins';
			font-weight: normal;
			font-style: normal;
			font-variant: normal;
			src: url("fonts/poppins/Poppins-Regular.ttf") format('truetype');
	}

		@font-face {
			font-family: 'Roboto';
			font-weight: normal;
			font-style: normal;
			font-variant: normal;
			src: url("fonts/roboto/Roboto-Regular.ttf") format('truetype');
		}
		@font-face {
			font-family: 'Open Sans';
			font-weight: normal;
			font-style: normal;
			font-variant: normal;
			src: url("fonts/opensans/OpenSans-Regular.ttf") format('truetype');
		}

		.Lato {
			font-family: 'Lato';
		}

		.Montserrat {
			font-family: 'Montserrat';
		}

		.Poppins {
			font-family: 'Poppins';
		}

		.Roboto {
			font-family: 'Roboto';
		}

		.OpenSans {
			font-family: 'Open Sans';
		}
	
		body {
			/* font-family: 'Croissant One', sans-serif; */
			/* font-family: 'Atma', sans-serif; */
			font-family: 'Lato', sans-serif;
			/* font-family: 'Open Sans', sans-serif; */
			/* font-size: 14px; */
		}
	</style>
</head>
<body>
	None: I want to express my sincere gratitude for the opportunities and experiences I've had during my time at [IT Company Name]. 
	<p> 
		Default: I want to express my sincere gratitude for the opportunities and experiences I've had during my time at [IT Company Name].
	</p>
	<p class="Lato"> 
		Lato1: I want to express my sincere gratitude for the opportunities and experiences I've had during my time at [IT Company Name].
	</p>
	<p class="Montserrat"> 
		Montserrat: I want to express my sincere gratitude for the opportunities and experiences I've had during my time at [IT Company Name].
	</p>
	<p class="Poppins"> 
		Poppins: I want to express my sincere gratitude for the opportunities and experiences I've had during my time at [IT Company Name].
	</p>
	<p class="Roboto"> 
		Roboto2: I want to express my sincere gratitude for the opportunities and experiences I've had during my time at [IT Company Name].
	</p>
	<p class="OpenSans"> 
		Open Sans3: I want to express my sincere gratitude for the opportunities and experiences I've had during my time at [IT Company Name].
	</p>

	<p>যেহেতু মানব অধিকারের প্রতি অবজ্ঞা এবং ঘৃণার ফলে মানুবের বিবেক লাঞ্ছিত বোধ করে এমন সব বর্বরোচিত</p>

	<h1>Open Sans</h1>
	<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
	<p>123456790</p>
	<p>ABCDEFGHIJKLMNOPQRSTUVWXYZ</p>
	<p>abcdefghijklmnopqrstuvwxyz</p>
	<p class="OpenSans">abcdefghijklmnopqrstuvwxyz</p>
	<br><br>
	{{-- <p class="Lato">abcdefghijklmnopqrstuvwxyz</p>
	<p class="Montserrat">abcdefghijklmnopqrstuvwxyz</p>
	<p class="Poppins">abcdefghijklmnopqrstuvwxyz</p>
	<p class="Roboto">abcdefghijklmnopqrstuvwxyz</p>
	<p class="opensans">abcdefghijklmnopqrstuvwxyz</p> --}}

	<table>
		<tr >
		  <th>Company</th>
		  <th>Contact</th>
		  <th>Country</th>
		</tr>
		<tr>
		  <td>Alfreds Futterkiste</td>
		  <td>Maria Anders</td>
		  <td>Germany</td>
		</tr>
		<tr>
		  <td>Centro comercial Moctezuma</td>
		  <td>Francisco Chang</td>
		  <td>Mexico</td>
		</tr>
	  </table>
</body>
</html>