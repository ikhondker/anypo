@extends('landlord.layouts.site-mail')

@section('title','Your account has been Activated')

@section('content')

	<div class="serif" style="color: #1F2225; font-size: 28px; font-weight: 500; line-height: 50px; margin-bottom: 30px;">
		Hi IQBAL,
	</div>
	<div class="sans-serif" style="color: #969AA1; font-size: 18px; line-height: 28px; margin-bottom: 40px;">
		<h1>{{ $mailData['title'] }}</h1>
		<p>{{ $mailData['body'] }}</p>

		Your Account is now activated at
		</br>
		</br>The email you have used to register is
		</br>
		</br>You may login to your account using the following link:
		</br><a href="{{url('/')}}/login">{{url('/')}}/login</a>

		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

			<p>Thank you IQBAL</p>
		</body>

	</div>

	<table class="mobile-text-center" bgcolor="#3FB58B" cellpadding="0" cellspacing="0" style="border-radius: 3px;" role="presentation">
		<tr>
		<th class="sans-serif">
			<a href="{{url('/')}}/login" style="border: 0 solid #3FB58B; color: #FFFFFF; display: inline-block; font-size: 14px; font-weight: 400; padding: 15px 50px 15px 50px; text-decoration: none;">
			Login
			</a>
		</th>
		</tr>
	</table>

@endsection
