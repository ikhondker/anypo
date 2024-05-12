<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//use Illuminate\Database\Eloquent\ItemNotFoundException;
use Illuminate\Support\ItemNotFoundException;

use App\Models\Landlord\Manage\ErrorLog;

class Handler extends ExceptionHandler
{
	/**
	 * The list of the inputs that are never flashed to the session on validation exceptions.
	 *
	 * @var array<int, string>
	 */
	protected $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];

	/**
	 * Register the exception handling callbacks for the application.
	 */
	public function register(): void
	{
		$this->reportable(function (Throwable $e) {

			// NOTE: only log UNHANDLED exceptions in custeom error_log table
			$tenant_id 	= ( tenant('id') =='' ? 'landlord' : tenant('id'));
			$url 		= url()->current();
			$user_id 	= ( auth()->check() ? auth()->user()->id : '0000');
			$role		= ( auth()->check() ? auth()->user()->role->value : 'guest');
			//$eClass		= get_class($e);
			$eClass		= substr( get_class($e), strrpos( get_class($e),'\\') +1);
			$msg		= $e->getMessage();

			// landlord Errors
			if (tenant('id') == '') {
					$errorLog			= new ErrorLog();
					$errorLog->tenant  	= $tenant_id;
					$errorLog->url		= $url;
					$errorLog->user_id 	= $user_id;
					$errorLog->role		= $role;
					$errorLog->e_class	= $eClass;
					$errorLog->message 	= $msg;
					$errorLog->save();

			} else {
				// Tenant Errors now create the log under in landlord
				$landlordTicket = tenancy()->central(function ($tenant) use ($tenant_id, $url, $user_id, $role, $eClass, $msg) {
					$errorLog			= new \App\Models\Landlord\Manage\ErrorLog();
					$errorLog->tenant  	= $tenant_id;
					$errorLog->url		= $url;
					$errorLog->user_id 	= $user_id;
					$errorLog->role		= $role;
					$errorLog->e_class	= $eClass;
					$errorLog->message 	= $msg;
					$errorLog->save();
				});
			}

			// Log::channel('tenant')->info( '---------------------'.tenant('id').'-----------------------');
			// Log::channel('tenant')->info( 'URL = '.url()->current());
			// Log::channel('tenant')->info( 'Logged-in User = '. (auth()->check() ? auth()->user()->id : '0000'));
			// Log::channel('tenant')->info( 'Message ='.$e->getMessage());
			// //if($e instanceof ModelNotFoundException) {
			// if($e instanceof ItemNotFoundException) {
			// 	Log::channel('tenant')->info( 'ItemNotFoundException ModelNotFoundException');
			// } else {
			// 	Log::channel('tenant')->info( 'NOT ItemNotFoundException ModelNotFoundException');
			// }

		});
	}
}
