<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        CheckAccess.php
 * @brief       This file contains the implementation of the CheckAccess Helper.
 * @author      Iqbal H. Khondker
 * @created     27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author    		        Comments
 * ----------------------------------------------------------------------------------
 * 27-Apr-2023	v1.0.0	Iqbal H Khondker		Created.
 * DD-Mon-YYYY	v1.0.0	Iqbal H Khondker		Modification brief.
 * ==================================================================================
*/

namespace App\Helpers;

use App\Models\Landlord\Invoice;


class Bo
{
	public static function getInvoiceNo()
	{
		
		// generate unique invoice_no
		do {
			$invoice_no = random_int(1000000, 9999999);
		} while (Invoice::where("invoice_no", "=", $invoice_no)->first());
		return $invoice_no;
	}

}
