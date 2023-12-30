<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			UserRoleEnum.php
* @brief		This file contains the implementation of the UserRoleEnum
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

enum UserRoleEnum: string{
	case GUEST		= 'guest';		// was used in EventLog. TODO
	case USER		= 'user';		// both landlord and tenant
	case BUYER		= 'buyer';
	case MANAGER	= 'manager';
	case HOD		= 'hod';
	case CXO		= 'cxo';
	case ADMIN		= 'admin';		// customer admin, both landlord and tenant
	case SUPPORT	= 'support';	// backoffice
	case SUPERVISOR	= 'supervisor';	// backoffice
	case DEVELOPER	= 'developer';	// backoffice
	case ACCOUNTS	= 'accounts';	// backoffice
	case SYSTEM		= 'system';		//backoffice
}