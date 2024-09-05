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

class Docs
{
	public static function tables()
	{
		return DB::select('SHOW TABLES');
	}

	public static function columns($table)
	{
		return DB::SELECT('describe ' . $table);
	}

	public static function getAllFiles($folder)
	{
		$files = Storage::allFiles($directory);
	}

	//https://stackoverflow.com/questions/7121479/listing-all-the-folders-subfolders-and-files-in-a-directory-using-php
	public static function listFolderFiles($dir){
		$ffs = scandir($dir);
	
		unset($ffs[array_search('.', $ffs, true)]);
		unset($ffs[array_search('..', $ffs, true)]);
	
		// prevent empty ordered elements
		if (count($ffs) < 1){
			return;
		}

		//	 v1
		echo '<ol>';
		foreach($ffs as $ff){
			echo '<li>'.$ff;
			if(is_dir($dir.'/'.$ff)) self::listFolderFiles($dir.'/'.$ff);
			echo '</li>';
		}
		echo '</ol>';
		
		//echo '=========================================';
		//	
		
	}

	public static function getFiles($folder)
	{
		//$filesInFolder = \File::files(base_path() . '\app\Models\Landlord');
		$filesInFolder = \File::files(base_path() . $folder);

		$data = array();
		$i=0;

		foreach($filesInFolder as $path) {
			$file 	= pathinfo($path);
			$f		= $file['filename'] ;
			$b		= $file['basename'] ;

			$fname = $file['filename'];
			$bname = $file['basename'];
			$dname = substr($file['dirname'],strlen(base_path()));


			$last_modified=File::lastModified($path);
			// ok
			//$t = Carbon::createFromTimestamp($t1)->format('m/d/Y');
			$last_modified_human	= \Carbon\Carbon::parse($last_modified)->diffForHumans();
			$last_modified_date		= \Carbon\Carbon::parse($last_modified);
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
	}

	public static function messages($folder)
	{
		
		//$filesInFolder = \File::files(base_path() . '\app\Http\Controllers');
		$filesInFolder = \File::files(base_path() . $folder);

		foreach ($filesInFolder as $path) {
			$file = pathinfo($path);
			// echo $file['dirname'] .'<br>' ;	// D:\laravel\ho03\app\Http\Controllers
			// echo $file['basename'] .'<br>' ;	// ActivityController.php
			// echo $file['extension'] .'<br>' ;// php
			// echo $file['filename'] .'<br>' ;	// ActivityController

			$f = $file['dirname'] . "\\" . $file['basename'];

			echo '-------------------------------------<br>';
			echo $f . '<br>';
			echo '-------------------------------------<br>';
			foreach (file($f) as $line) {
				// authorize, with
				if (Str::contains($line, 'with(')) {
					echo $line . '<br>';
				}
			}
		}
	}

}	
