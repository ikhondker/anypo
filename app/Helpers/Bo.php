<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Bo.php
* @brief		This file contains the implementation of the Bo
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

use App\Models\Landlord\Admin\Invoice;

class Bo
{
	public static function getInvoiceNo()
	{
		// Generate unique invoice_no
		do {
			$invoice_no = random_int(1000000, 9999999);
		} while (Invoice::where("invoice_no", "=", $invoice_no)->first());
		return $invoice_no;
	}

}
