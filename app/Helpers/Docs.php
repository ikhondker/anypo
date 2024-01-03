<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Workflow.php
* @brief		This file contains the implementation of the Workflow
* @path			\app\Helpers
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		10-DEC-2023
* @copyright	(c) Iqbal H. Khondker 
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 10-DEC-2023	v1.0.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.0.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

namespace App\Helpers;
use DB;
use File;
use Str;
//use App\Notifications\TicketCreated;
//use App\Notifications\TicketUpdated;

class Docs
{
	public static function tables()
	{
		return DB::select('SHOW TABLES');
	}
	public static function columns($table)
	{
		return DB::SELECT('describe ' . $table);;
	}
	public static function getFiles($folder)
	{
		//$filesInFolder = \File::files(base_path() . '\app\Models\Landlord');
		$filesInFolder = \File::files(base_path() . $folder);


		$data = array();
		
		// $array = array(
		// 	0 => array(
		// 		'name' => 'John Doe',
		// 		'email' => 'john@example.com'
		// 	),
		// 	1 => array(
		// 		'name' => 'Jane Doe',
		// 		'email' => 'jane@example.com'
		// 	),
		// );
		
		// foreach ( $array  as $groupid => $fields) {
		// 	echo "hi element ". $groupid . "\n";
		// 	echo ". name is ". $fields['name'] . "\n";
		// 	echo ". email is ". $fields['email'] . "\n";
		// }

		// exit;
		// $array[0] = array();
		// $array[0]['name'] = 'John Doe';
		// $array[0]['email'] = 'john@example.com';

		// $array[1] = array();
		// $array[1]['name'] = 'Jane Doe';
		// $array[1]['email'] = 'jane@example.com';

		$i=0;

		foreach($filesInFolder as $path) {
			$file = pathinfo($path);
			$f= $file['filename'] ;
			$b= $file['basename'] ;
			//$t= $file['mTime'];

			//$file = pathinfo($path);
			//echo $file['filename'] .'<br>' ;
			$fname = $file['filename'];
			$bname = $file['basename'];
			$dname = substr($file['dirname'],strlen(base_path()));


			$last_modified=File::lastModified($path);
			//$t = $t1->toDateTimeString();
			//$t=gmdate("Y-m-d\TH:i:s\Z", $t1)->diffForHumans();
			// ok
			//$t = Carbon::createFromTimestamp($t1)->format('m/d/Y');
			$last_modified_human= \Carbon\Carbon::parse($last_modified)->diffForHumans();
			$last_modified_date= \Carbon\Carbon::parse($last_modified);
			$days = $last_modified_date->diffInDays(now(), false);

			$removed = Str::remove('Controller', $f);
			$route = Str::lower(Str::plural(Str::snake($removed, '-')));

			$data[$i] = array();
			$data[$i]['f'] = $f;
			$data[$i]['fname'] = $fname;
			$data[$i]['bname'] = $bname;
			$data[$i]['dname'] = $dname;
			$data[$i]['last_modified_human'] =$last_modified_human;
			$data[$i]['last_modified_date'] =$last_modified_date;
			$data[$i]['days'] = $days;
			$data[$i]['removed'] = $removed;
			$data[$i]['route'] = $route;

			$i=$i+1;
		}
		return $data;
		//return $filesInFolder;
	}
}	
