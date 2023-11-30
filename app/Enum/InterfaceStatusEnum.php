<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        InterfaceStatusEnum.php
 * @brief       This file contains the implementation of the InterfaceStatusEnum Enum.
 * @author      Iqbal H. Khondker 
 * @created     12-Jun-2023
 * @copyright   (c) Copyright by Iqbal H. Khondker
 * ==================================================================================
 * Revision History:
 * Date			Version	Author    		        Comments
 * ----------------------------------------------------------------------------------
 * 12-Jun-2023	v1.0.0	Iqbal H Khondker		Created.
 * DD-Mon-YYYY	v1.0.0	Iqbal H Khondker		Modification brief.
 * ==================================================================================
*/
namespace App\Enum;

enum InterfaceStatusEnum: string{
    case DRAFT      = 'draft';
    case ERROR      = 'error';
    case VALIDATED  = 'validated';
    case UPLOADED   = 'uploaded';
}
