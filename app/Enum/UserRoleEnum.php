<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        UserRoleEnum.php
 * @brief       This file contains the implementation of the UserRoleEnum Enum.
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

enum UserRoleEnum: string{
	case GUEST      = 'guest';  // // was used in EventLog. TODO
	case USER       = 'user';   // both landlord and tenant
	case BUYER      = 'buyer';
	case MANAGER    = 'manager';
	case HOD        = 'hod';
	case CXO        = 'cxo';
	case ADMIN      = 'admin';      // customer admin, both landlord and tenant
	case SUPPORT    = 'support';
	case SUPERVISOR = 'supervisor';
	case DEVELOPER  = 'developer';
	case ACCOUNTS   = 'accounts';   // landlord only
	case SYSTEM     = 'system';
}