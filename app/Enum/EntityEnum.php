<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        EntityEnum.php
 * @brief       This file contains the implementation of the EntityEnum Enum.
 * @author      Iqbal H. Khondker 
 * @created     27-Apr-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author    		        Comments
 * ----------------------------------------------------------------------------------
 * 27-Jul-2023	v1.0.0	Iqbal H Khondker		Created.
 * DD-Mon-YYYY	v1.0.0	Iqbal H Khondker		Modification brief.
 * ==================================================================================
*/
namespace App\Enum;

enum EntityEnum: string{
	case BUDGET     = 'BUDGET';
	case DEPTBUDGET = 'DEPTBUDGET';
	case PR			= 'PR';
	case PO			= 'PO';
	case PROJECT	= 'PROJECT';
	case RECEIPT	= 'RECEIPT';
	case PAYMENT	= 'PAYMENT';
	case TEMPLATE	= 'TEMPLATE';
}


