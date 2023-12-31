<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			LandlordAccountStatusEnum.php
* @brief		This file contains the implementation of the LandlordAccountStatusEnum
* @path			\app\Enum
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
namespace App\Enum;

enum LandlordAccountStatusEnum:string{
	case ACTIVE		='1003';
	case ONHOLD		='1015';
	//case DUE		='1017';
	//case PASTDUE	='1018';
	case CANCELED	='1020';
	case ARCHIVED	='1024';
}
