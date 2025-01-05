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

//          NAME => Model
enum EntityEnum: string{
	case CORE			= 'Core';
	case PROJECT		= 'Project';
	case ITEM			= 'Item';
	case SUPPLIER		= 'Ssupplier';
	// case PROJECTPO		= 'PROJECTPO';
	// case PROJECTPOLINE	= 'PROJECTPOLINE';
	// case SUPPLIERPO		= 'SUPPLIERPO';
	// case SUPPLIERPOLINE	= 'SUPPLIERPOLINE';
	case BUDGET			= 'Budget';
	case DEPTBUDGET		= 'DeptBudget';
	case PR				= 'Pr';
	case PRL			= 'Prl';
	case PO				= 'Po';
	case POL			= 'Pol';
	case RECEIPT		= 'Receipt';
	case INVOICE		= 'Invoice';
	case INVOICELINE	= 'InvoiceLine';
	case PAYMENT		= 'Payment';
	case AEH			= 'Aeh';
	case AEL			= 'Ael';
	case TEMPLATE		= 'Template';
	case TICKET			= 'Ticket';		// Support Ticket raise from Tenant
	case CONTACT		= 'Contact';	// Home Controlled
	case TAX			= 'Tax';		// Not used

}


