<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        PaymentStatusEnum.php
 * @brief       This file contains the implementation of the PaymentStatusEnum Enum.
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

enum LandlordPaymentStatusEnum:string{
    case DRAFT      = '1002';
    case PAID       = '1014';
    case CANCELED   = '1020';
    case FAILED     = '1021';  
    case ERROR	    = '1022';
}
