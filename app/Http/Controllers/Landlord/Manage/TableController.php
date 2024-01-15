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

// Models
//use App\Models\Table;
// Enums
// Helpers
// Helpers
use App\Helpers\Docs;
// Seeded

use App\Models\Landlord\Manage\Table;

use File;
use DB;
use Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

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

	public function controllers()
	{
		$this->authorize('controllers', Table::class);
		$filesInFolder = Docs::getFiles('\app\Http\Controllers\Landlord');
		return view('landlord.manage.tables.controllers', compact('filesInFolder'))->with('i', 0);
		
	}


	public function models()
	{
		$this->authorize('models', Table::class);
		$filesInFolder = Docs::getFiles('\app\Models\Landlord');
		return view('landlord.manage.tables.models', compact('filesInFolder'))->with('i', 0);
	}

	public function routes()
	{
		$this->authorize('routes', Table::class);
		// https://laravel.com/api/6.x/Illuminate/Routing/RouteCollection.html
		$routes = Route::getRoutes()->getRoutesByName();
		return view('landlord.manage.tables.all-routes', compact('routes'))->with('i', 0);
	}

	public function routeCode()
	{
		$this->authorize('routeCode', Table::class);
		$filesInFolder = Docs::getFiles('\app\Models\Landlord');
		return view('landlord.manage.tables.routes', compact('filesInFolder'))->with('i', 0);
	}

	public function policies()
	{

		$this->authorize('policies', Table::class);
		$filesInFolder = Docs::getFiles('\app\Models\Landlord');	// <<============= Models
		return view('landlord.manage.tables.policies', compact('filesInFolder'))->with('i', 0);
	}

	public function comments()
	{
		$this->authorize('comments', Table::class);

		//$filesInFolder = \File::files(base_path() . '\app\Http\Controllers\Landlord\Admin');
		//$filesInFolder = \File::files(base_path() . '\app\Models\Landlord\Lookup');
		//$filesInFolder = \File::files(base_path().'\app\Http\Controllers\Auth');
		//$filesInFolder = \File::files(base_path().'\app\Enum');
		//$filesInFolder = \File::files(base_path().'\app\Helpers');
		//$filesInFolder = \File::files(base_path().'\app\Notifications');
		
		$filesInFolder = Docs::getFiles('\app\Http\Controllers\Landlord\Manage');
		return view('landlord.manage.tables.comments', compact('filesInFolder'))->with('i', 0);
	}

	public function messages()
	{
		$this->authorize('messages', Table::class);
		$filesInFolder = Docs::messages('\app\Http\Controllers');
	}

	// TODO
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
			'Setup',
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
