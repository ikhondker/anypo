<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Export.php
* @brief		This file contains the implementation of the Export
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

class Export
{
	public static function csv($filename, $data)
	{

		function cleanData(&$str)
		{
			if ($str == 't') {
				$str = 'TRUE';
			}
			if ($str == 'f') {
				$str = 'FALSE';
			}
			if (preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str) || preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $str)) {
				$str = " $str";
			}
			if (strstr($str, '"')) {
				$str = '"' . str_replace('"', '""', $str) . '"';
			}
		}

		// filename for download
		$filename = 'export-'.$filename. "-" . date('Ymd') . ".csv";

		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: text/csv");

		$out = fopen("php://output", 'w');

		$flag = false;
		foreach ($data as $row) {
			if (!$flag) {
				// display field/column names as first row
				fputcsv($out, array_keys($row), ',', '"');
				$flag = true;
			}
			array_walk($row, __NAMESPACE__ . '\cleanData');
			fputcsv($out, array_values($row), ',', '"');
		}

		fclose($out);

		return null;
	}

}
