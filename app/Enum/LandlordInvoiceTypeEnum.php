<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        LandlordInvoiceTypeEnum.php
 * @brief       This file contains the implementation of the LandlordInvoiceTypeEnum Enum.
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
namespace App\Enum;

enum LandlordInvoiceTypeEnum:string{
    case CHECKOUT       ='checkout';
    case SUBSCRIPTION   ='subscription';
    case ADDON          ='addon';
    case ARCHIVE        ='archive';
}
