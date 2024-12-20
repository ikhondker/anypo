<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			EntityEnum.php
* @brief		This file contains the implementation of the EntityEnum
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
namespace App\Enum\Tenant;

enum EntityEnum: string{
	case CORE		= 'CORE';
	case PROJECT	= 'PROJECT';
	case ITEM		= 'ITEM';
	case SUPPLIER	= 'SUPPLIER';
	case BUDGET		= 'BUDGET';
	case DEPTBUDGET	= 'DEPTBUDGET';
	case PR			= 'PR';
	case PO			= 'PO';
	case RECEIPT	= 'RECEIPT';
	case INVOICE	= 'INVOICE';
	case PAYMENT	= 'PAYMENT';
	case AEH		= 'AEH';
	case TEMPLATE	= 'TEMPLATE';
	case TICKET		= 'TICKET';		// Support Ticket raise from Tenant
	case CONTACT	= 'CONTACT';	// Home Controlled
	case TAX		= 'TAX';		// Not used

}


