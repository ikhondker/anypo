<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        LandlordServiceStatusEnum.php
 * @brief       This file contains the implementation of the LandlordServiceStatusEnum.
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

enum LandlordServiceStatusEnum:string{
    case DRAFT      = '1002';
    case ACTIVE     = '1003';
    case PROCESSING = '1009';
    case CANCELED   = '1020';
    case FAILED     = '1021';  
    case ERROR	    = '1022';
}
