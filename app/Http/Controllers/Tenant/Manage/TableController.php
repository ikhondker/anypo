<?php

//=============================================================================
// @version v1.0.1
//=============================================================================
// @file            TableController.php
// @description     This file contains the implementation of the TableController class.
// @author          Iqbal H Khondker <ihk@khondker.com>
// @created         23-APR-2023
// @copyright       (c) Copyright by Iqbal H Khondker
//=============================================================================
// Revision History:
// Date			Version	Author    		Comments
// ---------------------------------------------------------------------------
// 23-APR-2023	v1.0.0	Iqbal H Khondker		Created.
// 23-APR-2023	v1.0.0	Iqbal H Khondker		Added function to return something.
//=============================================================================

/**
 * =============================================================================
 * @version v1.0.0
 * =============================================================================
 * @file        TableController.php
 * @brief       This file contains the implementation of the TableController class.
 * @author      Iqbal H. Khondker <ihk@khondker.com>
 * @created     27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * =============================================================================
 * Revision History:
 * Date			Version	Author    		        Comments
 * ---------------------------------------------------------------------------
 * 27-Apr-2023	v1.0.0	Iqbal H Khondker		Created.
 * 07-May-2023	v1.0.1	Iqbal H Khondker		Modification for po02.
 * =============================================================================
*/

/**
 * Author:    Iqbal H Khondker <ihk@khondker.com>
 * Created:   23-APR-2023
 *
 * (c) Copyright by Blub Corp.
**/
//Using comment headers in your source code files

/**
 * File: myfile.cpp
 * Author: John Doe
 * Description: This file contains the implementation of the MyClass class.
 * Date: 2022-03-15
 *
 * @file            TableController.php
 * @description     This file contains the implementation of the TableController class.
 * @author          Iqbal H Khondker <ihk@khondker.com>
 * @created         23-APR-2023
 * @copyright       Iqbal H Khondker
 *
* @license    http://www.submit2contest.com Proprietary
 * @version    0.1
 * @link       http://www.submit2contest.com
 * @see        http://www.khondker.com
 * @since      File available since Release: 0.1
 */


 namespace App\Http\Controllers\Tenant\Manage;

 use App\Http\Controllers\Controller;

// Models
//use App\Models\Table;
// Enums
// Helpers
use App\Helpers\Docs;
// Seeded

use App\Models\Tenant\Manage\Table;

//use File;
//use DB;
//use Str;
//use Carbon\Carbon;
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
		return view('tenant.manage.tables.index', compact('tables'))->with('i', 0);
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
		//$columns = DB::select('describe '.$table);
		//return view('tenant.manage.tables.show', with(compact('table', 'columns')));
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
		return view('tenant.manage.tables.structure', with(compact('columns', 'table')));
	}

	public function controllers()
	{
		$this->authorize('controllers', Table::class);
		//$filesInFolder = \File::files(base_path().'\app\Http\Controllers\Tenant');
		//$filesInFolder = Docs::getFiles('\app\Http\Controllers\Tenant');
		$filesInFolder = Docs::getFiles(config('akk.DOC_DIR_CLASS'));
		return view('tenant.manage.tables.controllers', compact('filesInFolder'));
	}
	
	public function fncControllers()
	{
		// Ref: https://www.php.net/manual/en/class.reflectionclass.php
		$this->authorize('controllers', Table::class);
		//$filesInFolder = \File::files(base_path().'\app\Http\Controllers\Tenant');
		//$filesInFolder = Docs::getFiles('\app\Http\Controllers\Tenant');
		$filesInFolder = Docs::getFiles(config('akk.DOC_DIR_CLASS'));
		
		//Log::debug('Value of id=' . config('akk.DOC_DIR'));
		return view('tenant.manage.tables.controllers-fnc', compact('filesInFolder'));
	}

	public function helpers()
	{
		$this->authorize('controllers', Table::class);
		//$filesInFolder = \File::files(base_path().'\app\Http\Controllers\Tenant');
		$filesInFolder = Docs::getFiles('\app\Helpers');
		//$filesInFolder = Docs::getFiles(config('akk.DOC_DIR_CLASS'));
		
		//Log::debug('Value of id=' . config('akk.DOC_DIR'));
		return view('tenant.manage.tables.helpers', compact('filesInFolder'));
	}

	public function fncHelpers()
	{
		$this->authorize('controllers', Table::class);
		//$filesInFolder = \File::files(base_path().'\app\Http\Controllers\Tenant');
		$filesInFolder = Docs::getFiles('\app\Helpers');
		//$filesInFolder = Docs::getFiles(config('akk.DOC_DIR_CLASS'));
		
		//Log::debug('Value of id=' . config('akk.DOC_DIR'));
		return view('tenant.manage.tables.helpers-fnc', compact('filesInFolder'));
	}


	public function models()
	{
		$this->authorize('models', Table::class);
		//$filesInFolder = \File::files(base_path().'\app\Models');
		// $filesInFolder = Docs::getFiles('\app\Models\Tenant');
		$filesInFolder = Docs::getFiles(config('akk.DOC_DIR_MODEL'));
		return view('tenant.manage.tables.models', compact('filesInFolder'));
	}

	public function fncModels()
	{
		$this->authorize('models', Table::class);
		//$filesInFolder = \File::files(base_path().'\app\Models');
		// $filesInFolder = Docs::getFiles('\app\Models\Tenant');
		$filesInFolder = Docs::getFiles(config('akk.DOC_DIR_MODEL'));
		return view('tenant.manage.tables.models-fnc', compact('filesInFolder'));
	}

	public function routes()
	{
		$this->authorize('routes', Table::class);
		// https://laravel.com/api/6.x/Illuminate/Routing/RouteCollection.html
		$routes = Route::getRoutes()->getRoutesByName();
		return view('tenant.manage.tables.routes-all', compact('routes'));
	}

	public function routeCode()
	{
		$this->authorize('routeCode', Table::class);
		//$filesInFolder = Docs::getFiles('\app\Models\Tenant');
		$filesInFolder = Docs::getFiles(config('akk.DOC_DIR_MODEL'));
		return view('tenant.manage.tables.routes', compact('filesInFolder'));
	}

	public function policies()
	{
		$this->authorize('policies', Table::class);
		//$filesInFolder = Docs::getFiles('\app\Models\Tenant');	// <<============= Models
		$filesInFolder = Docs::getFiles(config('akk.DOC_DIR_MODEL'));
		return view('tenant.manage.tables.policies', compact('filesInFolder'));
	}

	public function fncPolicies()
	{
		$this->authorize('models', Table::class);
		$filesInFolder = Docs::getFiles(config('akk.DOC_DIR_POLICY'));
		return view('tenant.manage.tables.policies-fnc', compact('filesInFolder'));
	}

	public function comments()
	{
		$this->authorize('comments', Table::class);

		//$filesInFolder = \File::files(base_path().'\app\Http\Controllers\Landlord');
		//$filesInFolder = \File::files(base_path().'\app\Http\Controllers\Auth');
		//$filesInFolder = \File::files(base_path().'\app\Enum');
		//$filesInFolder = \File::files(base_path().'\app\Helpers');
		//$filesInFolder = \File::files(base_path().'\app\Notifications');

		//$filesInFolder = Docs::getFiles('\app\Http\Controllers\Tenant\Admin');
		$filesInFolder = Docs::getFiles(config('akk.DOC_DIR_CLASS'));

		return view('tenant.manage.tables.comments', compact('filesInFolder'));

	}

	public function messages()
	{
		$this->authorize('messages', Table::class);
		//$filesInFolder = \File::files(base_path().'\app\Http\Controllers');
		//$filesInFolder = Docs::messages('\app\Http\Controllers');
		$filesInFolder = Docs::messages(config('akk.DOC_DIR_CLASS'));
		//$filesInFolder = Docs::getFiles(config('akk.DOC_DIR_CLASS'));
	}


	// TODO
	public function check()
	{
		$this->authorize('check', Table::class);
		// =CONCATENATE("""",TRIM(A1),""",")
		$objects = array(
			'User',
			'Home',
			'Table',
			'FileAccess',
			'Dashboard',
			'Menu',
			'Notification',
			'Template',
			'Activity',
			'Currency',
			'Rate',
			'Country',
			'Setup',
			'Entity',
			'Attachment',
			'Hierarchy',
			'Hierarchyl',
			'Dept',
			'Designation',
			'Warehouse',
			'Category',
			'Group',
			'Uom',
			'Oem',
			'Supplier',
			'Project',
			'Budget',
			'Item',
			'UploadItem',
			'Wf',
			'Wfl',
			'Report',
			'DeptBudget',
			'PayMethod',
			'Pr',
			'Prl',
			'Po',
			'Pol',
			'Receipt',
			'Payment',
			'Test',
			);

		//foreach ($objects as $value) {
		//    echo "$value <br>";
		//}

		// check if controller exists
		echo "============================ Additional Controllers : \app\Http\Controllers =====================".'<br>';
		//$filesInFolder = \File::files(base_path().'\app\Models');
		$filesInFolder = \File::files(base_path().'\app\Http\Controllers');
		foreach($filesInFolder as $path) {
			$file = pathinfo($path);
			//echo $file['filename'] .'<br>' ;
			//$search =  $file['filename'];
			$result = array_search(str_replace("Controller", "", $file['filename']), $objects, true);
			if ($result == "") {
				//not found
				echo $file['filename'].'<br>';
			}
		}

		// check if model exists
		echo "============================ Additional Models : \app\Models =====================".'<br>';
		$filesInFolder = \File::files(base_path().'\app\Models');
		foreach($filesInFolder as $path) {
			$file = pathinfo($path);
			//echo $file['filename'] .'<br>' ;
			//$search =  $file['filename'];
			$result = array_search($file['filename'], $objects, true);
			if ($result == "") {
				//not found
				echo $file['filename'].'<br>';
			}
		}

		// check if policy exists
		echo "============================ Additional Policies : \app\Policies =====================".'<br>';
		$filesInFolder = \File::files(base_path().'\app\Policies');
		foreach($filesInFolder as $path) {
			$file = pathinfo($path);
			//echo $file['filename'] .'<br>' ;
			//$search =  $file['filename'];
			//$result = array_search($file['filename'],$objects,true);
			$result = array_search(str_replace("Policy", "", $file['filename']), $objects, true);
			if ($result == "") {
				//not found
				echo $file['filename'].'<br>';
			}
		}

		// check if requests exists
		echo "============================ Additional Store+Update Requests : app\Http\Requests =====================".'<br>';
		$filesInFolder = \File::files(base_path().'\app\Http\Requests');
		foreach($filesInFolder as $path) {
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
					echo $file['filename'].'<br>';
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
					echo $file['filename'].'<br>';
				}

			}

		}

		// check if orphan controller exists

		// check if orphan model exists

		// check if orphan  policy exists

		// check if orphan request exists


	}


}
