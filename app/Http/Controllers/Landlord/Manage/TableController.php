<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			TableController.php
* @brief		This file contains the implementation of the TableController
* @path			\app\Http\Controllers\Landlord\Manage
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		4-JAN-2024
* @copyright	(c) Iqbal H. Khondker <ihk@khondker.com>
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 4-JAN-2024	v1.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

namespace App\Http\Controllers\Landlord\Manage;

use App\Http\Controllers\Controller;

# 1. Models
use App\Models\Landlord\Manage\Table;
# 2. Enums
# 3. Helpers
use App\Helpers\Docs;
# 4. Notifications
# 5. Jobs
# 6. Mails
# 7. Rules
# 8. Packages
# 9. Exceptions
# 10. Events
# 11. Controller
# 12. Seeded
use File;
use DB;
use Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
# 13. FUTURE 



class TableController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function index()
	{
		$this->authorize('viewAny', Table::class);
		$tables = Docs::tables();
		return view('landlord.manage.tables.index', compact('tables'))->with('i', 0);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		abort(403);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreTableRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreTableRequest $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Table  $table
	 * @return \Illuminate\Http\Response
	 */
	public function show(Table $table)
	{
		//dd($table);
		//$columns = DB::select('describe ' . $table);
		//return view('landlord.manage.tables.show', with(compact('table', 'columns')));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Table  $table
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Table $table)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateTableRequest  $request
	 * @param  \App\Models\Table  $table
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateTableRequest $request, Table $table)
	{
		abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Table  $table
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Table $table)
	{
		abort(403);
	}

	public function structure($table)
	{
		$this->authorize('structure', Table::class);
		$columns = Docs::columns($table);
		return view('landlord.manage.tables.structure', with(compact('columns', 'table')));
	}

	public function controllers($dir = null)
	{
		$this->authorize('controllers', Table::class);

		$BASE_DIR	= "\app\Http\Controllers\Landlord\\";
		$target_dir = $BASE_DIR . $dir;

		//$filesInFolder = Docs::getFiles('\app\Http\Controllers\Landlord');
		//$filesInFolder = Docs::getFiles(config('bo.DOC_DIR_CLASS'));
		$filesInFolder = Docs::getFiles( $target_dir );
		return view('landlord.manage.tables.controllers', compact('filesInFolder'));
		
	}

	public function fncControllers($dir = null)
	{
		// Ref: https://www.php.net/manual/en/class.reflectionclass.php
		$this->authorize('controllers', Table::class);

		$BASE_DIR	= "\App\Http\Controllers\Landlord\\";
		$target_dir = $BASE_DIR . $dir;

		//$filesInFolder = \File::files(base_path().'\app\Http\Controllers\Tenant');
		//$filesInFolder = Docs::getFiles('\app\Http\Controllers\Tenant');
		//$filesInFolder = Docs::getFiles(config('bo.DOC_DIR_CLASS'));
		$filesInFolder = Docs::getFiles( $target_dir );

		//Log::debug('Value of id=' . config('akk.DOC_DIR'));
		return view('landlord.manage.tables.controllers-fnc', compact('filesInFolder','dir','target_dir'));
	}

	public function helpers()
	{
		$this->authorize('controllers', Table::class);

		//$filesInFolder = \File::files(base_path().'\app\Http\Controllers\Tenant');
		$filesInFolder = Docs::getFiles('\app\Helpers');
		//$filesInFolder = Docs::getFiles(config('akk.DOC_DIR_CLASS'));
		
		//Log::debug('Value of id=' . config('akk.DOC_DIR'));
		return view('landlord.manage.tables.helpers', compact('filesInFolder'));
	}

	public function fncHelpers()
	{
		$this->authorize('controllers', Table::class);

		//$filesInFolder = \File::files(base_path().'\app\Http\Controllers\Tenant');
		$filesInFolder = Docs::getFiles('\app\Helpers');
		//$filesInFolder = Docs::getFiles(config('akk.DOC_DIR_CLASS'));
		
		//Log::debug('Value of id=' . config('akk.DOC_DIR'));
		return view('landlord.manage.tables.helpers-fnc', compact('filesInFolder'));
	}


	public function models($dir = null)
	{
		$this->authorize('models', Table::class);
		$BASE_DIR	= "\app\Models\Landlord\\";
		$target_dir = $BASE_DIR . $dir;
		$filesInFolder = Docs::getFiles($target_dir);

		//$filesInFolder = Docs::getFiles('\app\Models\Landlord');
		//$filesInFolder = Docs::getFiles(config('bo.DOC_DIR_MODEL'));
		return view('landlord.manage.tables.models', compact('filesInFolder'));
	}

	public function fncModels($dir = null)
	{
		$this->authorize('models', Table::class);

		$BASE_DIR	= "\App\Models\Landlord\\";
		$target_dir = $BASE_DIR . $dir;
		$filesInFolder = Docs::getFiles($target_dir);

		//$filesInFolder = \File::files(base_path().'\app\Models');
		// $filesInFolder = Docs::getFiles('\app\Models\Tenant');
		//$filesInFolder = Docs::getFiles(config('bo.DOC_DIR_MODEL'));
		return view('landlord.manage.tables.models-fnc', compact('filesInFolder','dir','target_dir'));
	}


	public function routes()
	{
		$this->authorize('routes', Table::class);
		// https://laravel.com/api/6.x/Illuminate/Routing/RouteCollection.html
		$routes = Route::getRoutes()->getRoutesByName();
		return view('landlord.manage.tables.routes-all', compact('routes'));
	}

	public function routeCode($dir = null)
	{
		$this->authorize('routeCode', Table::class);

		$BASE_DIR	= "\app\Models\Landlord\\";
		$target_dir = $BASE_DIR . $dir;
		$filesInFolder = Docs::getFiles($target_dir);

		//$filesInFolder = Docs::getFiles('\app\Models\Landlord');
		//$filesInFolder = Docs::getFiles(config('bo.DOC_DIR_MODEL'));
		return view('landlord.manage.tables.routes-code', compact('filesInFolder'));
	}

	public function policies($dir = null)
	{

		$this->authorize('policies', Table::class);
		$BASE_DIR	= "\app\Models\Landlord\\";
		$target_dir = $BASE_DIR . $dir;

		//$filesInFolder = Docs::getFiles('\app\Models\Landlord');	// <<============= Models
		//$filesInFolder = Docs::getFiles(config('bo.DOC_DIR_MODEL'));
		$filesInFolder = Docs::getFiles($target_dir);
		return view('landlord.manage.tables.policies', compact('filesInFolder'));
	}

	public function fncPolicies($dir = null)
	{
		$this->authorize('models', Table::class);

		$BASE_DIR	= "\App\Policies\Landlord\\";
		$target_dir = $BASE_DIR . $dir;

		//$filesInFolder = Docs::getFiles(config('bo.DOC_DIR_POLICY'));
		$filesInFolder = Docs::getFiles($target_dir);
		return view('landlord.manage.tables.policies-fnc', compact('filesInFolder'));
	}


	public function comments($dir = null)
	{
		$this->authorize('comments', Table::class);

		$BASE_DIR	= "\app\Models\Landlord\\";
		$target_dir = $BASE_DIR . $dir;

		//$filesInFolder = \File::files(base_path() . '\app\Http\Controllers\Landlord\Admin');
		//$filesInFolder = \File::files(base_path() . '\app\Models\Landlord\Lookup');
		//$filesInFolder = \File::files(base_path().'\app\Http\Controllers\Auth');
		//$filesInFolder = \File::files(base_path().'\app\Enum');
		//$filesInFolder = \File::files(base_path().'\app\Helpers');
		//$filesInFolder = \File::files(base_path().'\app\Notifications');
		
		//$filesInFolder = Docs::getFiles('\app\Http\Controllers\Landlord\Manage');
		$filesInFolder = Docs::getFiles($target_dir);
		return view('landlord.manage.tables.comments', compact('filesInFolder','dir'));
	}

	public function messages($dir = null)
	{
		$this->authorize('messages', Table::class);
		$BASE_DIR	= "\App\Http\Controllers\Landlord\\";
		$target_dir = $BASE_DIR . $dir;

		//$filesInFolder = Docs::messages('\app\Http\Controllers');

		$filesInFolder = Docs::getFiles($target_dir);
		return view('landlord.manage.tables.messages', compact('filesInFolder','target_dir'));
	}

	// P2
	public function check()
	{

		$this->authorize('check', Table::class);

		// =CONCATENATE("""",TRIM(A1),""",")
		$objects = array(
			'Account',
			'AccountService',
			'Activity',
			'Attachment',
			'Category',
			'Checkout',
			'Comment',
			'Contact',
			'Country',
			'Dashboard',
			'Dept',
			'Entity',
			'Invoice',
			'InvoiceGroup',
			'Notification',
			'Payment',
			'PaymentMethod',
			'Priority',
			'Process',
			'Rating',
			'Service',
			'Config',
			'Table',
			'Template',
			'Ticket',
			'TicketStatus',
			'User',
		);

		//foreach ($objects as $value) {
		//	echo "$value <br>";
		//}

		// check if controller exists
		echo "============================ Additional Controllers : \app\Http\Controllers =====================" . '<br>';
		//$filesInFolder = \File::files(base_path().'\app\Models');
		$filesInFolder = \File::files(base_path() . '\app\Http\Controllers\Landlord');
		foreach ($filesInFolder as $path) {
			$file = pathinfo($path);
			//echo $file['filename'] .'<br>' ;
			//$search =  $file['filename'];
			$result = array_search(str_replace("Controller", "", $file['filename']), $objects, true);
			if ($result == "") {
				//not found
				echo $file['filename'] . '<br>';
			}
		}

		// check if model exists
		echo "============================ Additional Models : \app\Models =====================" . '<br>';
		$filesInFolder = \File::files(base_path() . '\app\Models\Landlord');
		foreach ($filesInFolder as $path) {
			$file = pathinfo($path);
			//echo $file['filename'] .'<br>' ;
			//$search =  $file['filename'];
			$result = array_search($file['filename'], $objects, true);
			if ($result == "") {
				//not found
				echo $file['filename'] . '<br>';
			}
		}

		// check if policy exists
		echo "============================ Additional Policies : \app\Policies =====================" . '<br>';
		$filesInFolder = \File::files(base_path() . '\app\Policies\Landlord');
		foreach ($filesInFolder as $path) {
			$file = pathinfo($path);
			//echo $file['filename'] .'<br>' ;
			//$search =  $file['filename'];
			//$result = array_search($file['filename'],$objects,true);
			$result = array_search(str_replace("Policy", "", $file['filename']), $objects, true);
			if ($result == "") {
				//not found
				echo $file['filename'] . '<br>';
			}
		}

		// check if requests exists
		echo "============================ Additional Store+Update Requests :  app\Http\Requests =====================" . '<br>';
		$filesInFolder = \File::files(base_path() . '\app\Http\Requests\Landlord');
		foreach ($filesInFolder as $path) {
			$file = pathinfo($path);

			if (substr($file['filename'], 0, 5) == "Store") {
				//echo $file['filename'] .'<br>' ;
				//$search =  $file['filename'];
				//$result = array_search($file['filename'],$objects,true);
				$result = array_search(
					str_replace(
						"Request",
						"",
						str_replace("Store", "", $file['filename'])
					),
					$objects,
					true
				);
				if ($result == "") {
					//not found
					echo $file['filename'] . '<br>';
				}
			} else {
				$result = array_search(
					str_replace(
						"Request",
						"",
						str_replace("Update", "", $file['filename'])
					),
					$objects,
					true
				);
				if ($result == "") {
					//not found
					echo $file['filename'] . '<br>';
				}
			}
		}

		// check if orphan controller exists

		// check if orphan model exists

		// check if orphan  policy exists

		// check if orphan request exists


	}

}
