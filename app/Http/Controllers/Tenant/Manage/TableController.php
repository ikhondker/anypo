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
// Seeded


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
		// TODO why? 403 to system
		//$this->authorize('viewAny', Table::class);

		$tables = DB::select('SHOW TABLES');
		// foreach ($tables as $table) {
		//     foreach ($table as $key => $value)
		//         echo $value;
		// }
		//dd($tables);
		return view('tenant.manage.tables.index', compact('tables'))->with('i', 0);
		//$templates = Template::latest()->orderBy('id','desc')->paginate(10);
		//return view('templates.index',compact('templates'))->with('i', (request()->input('page', 1) - 1) * 10);
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


		$columns = DB::select('describe '.$table);
		return view('tenant.manage.tables.show', with(compact('table', 'columns')));
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
		//$this->authorize('structure');

		//dd($tname);
		$columns = DB::SELECT('describe '.$table);
		return view('tenant.manage.tables.structure', with(compact('columns', 'table')));
	}

	public function controllers()
	{
		Log::debug('before inside controllers');
		$this->authorize('controllers', Table::class);
		Log::debug('after inside controllers');

		$filesInFolder = \File::files(base_path().'\app\Http\Controllers');

		return view('tenant.manage.tables.controllers', compact('filesInFolder'))->with('i', 0);

		echo '<table>';

		$thead = '
			<thead>
				<tr>
					<th class="" scope="col">#</th>
					<th class="" scope="col">Controller</th>
					<th class="" scope="col">Object</th>
					<th class="" scope="col">Route</th>
					<th class="" scope="col">URL</th>
					<th class="" scope="col">File</th>
					<th class="" scope="col">Modified</th>
					<th class="" scope="col">Days</th>
				</tr>
			</thead>
		';
		echo $thead;

		$i = 0;
		foreach($filesInFolder as $path) {
			$i++;
			$file = pathinfo($path);
			$f = $file['filename'] ;
			//$t= $file['mTime'];
			$t1 = File::lastModified($path);
			//$t = $t1->toDateTimeString();

			//$t=gmdate("Y-m-d\TH:i:s\Z", $t1)->diffForHumans();
			// ok
			//$t = Carbon::createFromTimestamp($t1)->format('m/d/Y');
			$t = Carbon::parse($t1)->diffForHumans();
			$td = Carbon::parse($t1);

			$result = $td->diffInDays(now(), false);


			$removed = Str::remove('Controller', $f);
			$route = Str::lower(Str::plural(Str::snake($removed, '-')));
			//$rname = $route.".index";
			//echo $f.'-'.$removed .'-'.$route.' ' ;
			//echo "<a href=".route('advances.index').">URL: ". $removed." </a> <br>";
			//$url= "<a href=".route( ".$rname." ).">Jump to URL</a>";
			$url = "<a href=\"http://localhost:8000/".$route."\">Jump to URL</a>";
			$dl = 'file:///D:/laravel/bo02/app/Http/Controllers/';
			$tr = '
				<tr>
					<td>'.$i.'</td>
					<td>'.$f.'</td>
					<td>'.$removed.'</td>
					<td>'.$route.'</td>
					<td>'.$url.'</td>
					<td>File</td>
					<td>'.$t.'</td>
					<td>'.$result.'</td>
				</tr>
				';
			echo $tr;
		}
		echo '</table>';
	}


	public function models()
	{

		$this->authorize('models', Table::class);

		$filesInFolder = \File::files(base_path().'\app\Models');

		return view('tenant.manage.tables.models', compact('filesInFolder'))->with('i', 0);

		foreach($filesInFolder as $path) {
			$file = pathinfo($path);
			echo $file['filename'] .'<br>' ;

			//$fname = $file['filename'];
			//echo "App\Models\". $fname." => App\Policies\".$fname."Policy";
			//echo "'App\Models\\". $fname."' => 'App\Policies\\". $fname . "Policy',</br>";
		}
	}

	public function routes()
	{

		$this->authorize('routes', Table::class);

		// https://laravel.com/api/6.x/Illuminate/Routing/RouteCollection.html
		$routes = Route::getRoutes()->getRoutesByName();
		return view('tenant.manage.tables.all-routes', compact('routes'))->with('i', 0);
	}

	public function routeCode()
	{

		$this->authorize('routeCode', Table::class);

		$filesInFolder = \File::files(base_path().'\app\Models');

		return view('tenant.manage.tables.routes', compact('filesInFolder'))->with('i', 0);

		foreach($filesInFolder as $path) {
			$file = pathinfo($path);
			//echo $file['filename'] .'<br>' ;
			$fname = $file['filename'];
			//echo "App\Models\". $fname." => App\Policies\".$fname."Policy";
			//echo "'App\Models\\". $fname."' => 'App\Policies\\". $fname . "Policy',</br>";
			echo "* ======================== ".$fname." ========================================  /</br>";
			echo "use App\Http\Controllers\\".$fname."Controller; </br>";
			echo "Route::resource('".strtolower(Str::plural($fname))."', ".$fname."Controller::class);</br></br>";
			//echo "Route::resource('".strtolower(Str::plural($fname))."', ".$fname."Controller::class);</br></br>";
			//echo "Route::get('/".strtolower(Str::plural($fname))."/export', ".$fname."Controller::class);</br></br>";
			//echo "Route::get('/".strtolower(Str::plural($fname))."/delete/', ".$fname."Controller::class);</br></br>";
		}
	}

	public function policies()
	{

		$this->authorize('policies', Table::class);

		//$filesInFolder = \File::files(base_path().'\app\Models');
		$filesInFolder = \File::files(base_path().'\app\Models'); // <<============= Models

		return view('tenant.manage.tables.policies', compact('filesInFolder'))->with('i', 0);

		echo "App\Provider\AuthServiceProvider.php</br></br>";

		foreach($filesInFolder as $path) {
			$file = pathinfo($path);
			//echo $file['filename'] .'<br>' ;
			$fname = $file['filename'];
			//echo "App\Models\". $fname." => App\Policies\".$fname."Policy";
			//echo "'App\Models\\". $fname."' => 'App\Policies\\". $fname . "Policy',</br>";
			echo "'App\Models\\". $fname."' => 'App\Policies\\". $fname . "Policy',</br>";
		}
	}

	public function comments()
	{
		$this->authorize('comments', Table::class);

		//$filesInFolder = \File::files(base_path().'\app\Http\Controllers\Landlord');
		//$filesInFolder = \File::files(base_path().'\app\Http\Controllers\Auth');
		$filesInFolder = \File::files(base_path().'\app\Enum');
		$filesInFolder = \File::files(base_path().'\app\Helpers');
		$filesInFolder = \File::files(base_path().'\app\Notifications');



		return view('tenant.manage.tables.comments', compact('filesInFolder'))->with('i', 0);

	}


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
				echo  $file['filename'].'<br>';
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
				echo  $file['filename'].'<br>';
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
				echo  $file['filename'].'<br>';
			}
		}

		// check if requests exists
		echo "============================ Additional Store+Update Requests :  app\Http\Requests =====================".'<br>';
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
					echo  $file['filename'].'<br>';
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
					echo  $file['filename'].'<br>';
				}

			}

		}

		// check if orphan controller exists

		// check if orphan model exists

		// check if orphan  policy exists

		// check if orphan request exists


	}


	public function messages()
	{

		$this->authorize('messages', Table::class);

		$filesInFolder = \File::files(base_path().'\app\Http\Controllers');

		foreach($filesInFolder as $path) {
			$file = pathinfo($path);
			// echo $file['dirname'] .'<br>' ;     // D:\laravel\ho03\app\Http\Controllers
			// echo $file['basename'] .'<br>' ;    // ActivityController.php
			// echo $file['extension'] .'<br>' ;   // php
			// echo $file['filename'] .'<br>' ;    // ActivityController

			$f = $file['dirname']."\\". $file['basename'];
			//Log::debug('file= '. $f);

			echo '-------------------------------------<br>' ;
			echo $f.'<br>' ;
			echo '-------------------------------------<br>' ;
			foreach(file($f) as $line) {
				// authorize, with
				if (Str::contains($line, 'with')) {
					echo $line .'<br>' ;
				}
			}

			if ($file['filename'] == 'DeptController') {
				return;
			}

			//$contents = Storage::get('path-to-your/abc.csv');
			//$content = File::get($filename);
			//$content = File::get( $file['dirname']."\\". $file['basename'] );
			// foreach($content as $line) {
			//     $contains = Str::contains($line, 'with->');
			//     if (Str::contains($line, 'with->')) {
			//         echo $line .'<br>' ;
			//     }
			// }
			// File::lines($file['dirname']."\\". $file['basename'])->each(
			//     function ($line) {
			//       $this->info($line);
			//     }
			// );

			// File::lines('whatever/file.txt')->each(function ($line) {
			//     $this->info($line);
			// }
		}
	}

}
