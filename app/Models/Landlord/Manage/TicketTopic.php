<?php

namespace App\Models\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* IQBAL 12-FEB-23 */
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Landlord\Ticket;
use App\Models\Landlord\Lookup\Topic;

class TicketTopic extends Model
{
    use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'ticket_id', 'topic_id', 'text_color', 'bg_color', 'icon', 'enable', 'updated_by', 'updated_at',
	];

	protected $casts = [
		'updated_at'	=> 'datetime',
		'created_at'	=> 'datetime',
	];

    /* ---------------- belongsTo ---------------------- */
	public function ticket() {
		return $this->belongsTo(Ticket::class, 'ticket_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}

    public function topic() {
		return $this->belongsTo(Topic::class, 'topic_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}


}
