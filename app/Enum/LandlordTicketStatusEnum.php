<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        LandlordTicketStatusEnum.php
 * @brief       This file contains the implementation of the LandlordTicketStatusEnum.
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

enum LandlordTicketStatusEnum:string{
    case NEW	            ='1001';  
    case ASSIGNED	        ='1004';
    case PENDING	        ='1005';
    case INPROGRESS         ='1006';
    case DEVELOPMENT        ='1007';
    case BUGFIXING          ='1008';
    case CUSTWORKING        ='1010'; 
    //case RESOLVED	        ='1011'; Not used
    case CLOSED	            ='1012';
    case ONHOLD	            ='1015';
}
