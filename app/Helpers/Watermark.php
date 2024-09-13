<?php

/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Watermark.php
* @brief		This file contains the implementation of the EventLog
* @path			\app\Helpers
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		10-DEC-2023
* @copyright	(c) Iqbal H. Khondker
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 12-SEP-2024	v1.0.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.0.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

namespace App\Helpers;

use Illuminate\Support\Facades\Request;
use PDF;
use Illuminate\Support\Facades\Log;

//use App\Enum\UserRoleEnum;

// 	Sample Logo
//	EventLog::event('user',$user->id,'update','name', $request->name);
//	EventLog::event('user',$user->id,'create');
// 	LogEvent('template',$template->id,'create','column',$template->id);

use Str;

class Watermark
{

	//public static function set($pdf,$text, $orientation = 'L')
	public static function set($pdf, $text, $orientation = 'L')
	{
		// (Optional) Setup the paper size and orientation
		//$pdf->setPaper('A4', 'landscape');
		//$orientation= ($o == 'P' ? 'portrait' : 'landscape');
		//Log::debug('orientation Value of id=' . $orientation);

		//$pdf->setPaper('A4', 'portrait');
		//$pdf->setPaper('A4', $orientation);
		$pdf->setPaper('A4', ($orientation == 'P' ? 'portrait' : 'landscape'));
		$pdf->output();

		// Get height and width of page
		// https://www.codexworld.com/create-pdf-with-watermark-in-php-using-dompdf/
		// https://www.codesenior.com/en/tutorial/Dompdf--Create-Watermark-and-Page-Numbers#google_vignette
		$canvas = $pdf->getDomPDF()->getCanvas();
		$height = $canvas->get_height();
		$width = $canvas->get_width();

		// Specify watermark text
		//$text = Str::upper($pr->auth_status);
		$text = Str::upper($text);

		// Get height and width of text
		//$font		= $pdf->getFontMetrics()->get_font("Times", "bold");
		$font		= $pdf->getFontMetrics()->get_font("helvetica", "bold");
		$txtHeight	= $pdf->getFontMetrics()->getFontHeight($font, 75);
		$textWidth	= $pdf->getFontMetrics()->getTextWidth($text, $font, 75);

		// Specify horizontal and vertical position
		$x = (($width - $textWidth) / 1.6);
		$y = (($height - $txtHeight) / 2);

		$color = array(255,0,0);
		$canvas->set_opacity(.2,"Multiply");
		//$canvas->set_opacity(.2);

		$canvas->page_text($x, $y, $text, $font, 55, $color, 2, 2, -30);
	}

}
