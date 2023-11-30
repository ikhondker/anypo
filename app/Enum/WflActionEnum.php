<?php
/**
 * ==================================================================================
 * @version v1.0.0
 * ==================================================================================
 * @file        WflActionEnum.php
 * @brief       This file contains the implementation of the WflActionEnum Enum.
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

enum WflActionEnum: string{
    case CREATED    = 'created';
    case SUBMITTED  = 'submitted';
    case PENDING    = 'pending';
    case FORWARD    = 'forward';
    case QUESTION   = 'question';
    case ANSWER     = 'answer';
    case APPROVED   = 'approved';
    case DELEGATED  = 'delegated';
    case REJECTED   = 'rejected';
    case CANCELED   = 'canceled';
}

