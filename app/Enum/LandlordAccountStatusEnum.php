<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        AccountStatusEnum.php
 * @brief       This file contains the implementation of the AccountStatusEnum Enum.
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

enum LandlordAccountStatusEnum:string{
    case ACTIVE	            ='1003';
    case ONHOLD	            ='1015';
    //case DUE	            ='1017';
    //case PASTDUE	        ='1018';
    case CANCELED	        ='1020';
    case ARCHIVED	        ='1024';
}
