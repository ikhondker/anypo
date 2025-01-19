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

// user->isAdmin() cover admin and back office for both Landlord and Tenant

enum UserRoleEnum: string{
	case GUEST		= 'guest';		// was used in EventLog.
	case USER		= 'user';		// Landlord + Tenant
 	case BUYER		= 'buyer';

	//case MANAGER	= 'manager';	// for Future in Tenant when unit within Dept is enabled
	case HOD		= 'hod';
	case CXO		= 'cxo';
	case ADMIN		= 'admin';		// Landlord + Tenant, customer admin
	case SYSTEM	    = 'system';	    // Landlord + Tenant, Back-office admin

	// Bellow back office roles. They have by default customer admin access
	case SUPPORT	= 'support';	// Landlord + Tenant
	case SUPERVISOR	= 'supervisor';	// Landlord +
 	case DEVELOPER	= 'developer';	// Landlord
	case ACCOUNTS	= 'accounts';	// Landlord
	case SYS		= 'sys';		// Landlord + Tenant, ack-office
}
