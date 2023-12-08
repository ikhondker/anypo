<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			Comment.php
* @brief		This file contains the implementation of the Comment
* @path			\app\Models\Landlord
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
namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 12-FEB-23 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;


class Comment extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

    protected $fillable = [
        'comment_date', 'content', 'ticket_id', 'owner_id','is_internal','by_backoffice', 'attachment_id', 'ip', 'updated_by', 'updated_at',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'comment_date'      => 'datetime',
        'updated_at'        => 'datetime',
        'created_at'        => 'datetime',
    ];

    /* ---------------- HasMany ---------------------- */


    /* ---------------- belongsTo ---------------------- */
    public function tickets()
    {
        return $this->belongsTo(TicketStatus::class, 'ticket_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /* ---------------- created and updated by ---------------------- */
    public function user_created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function user_updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
