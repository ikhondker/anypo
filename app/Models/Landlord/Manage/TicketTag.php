<?php

namespace App\Models\Landlord\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

use App\Models\Landlord\Ticket;
use App\Models\Landlord\Lookup\Tag;

class TicketTag extends Model
{
	use HasFactory, AddCreatedUpdatedBy;

	protected $fillable = [
		'ticket_id', 'tag_id', 'text_color', 'bg_color', 'icon', 'enable', 'updated_by', 'updated_at',
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

	public function tag() {
		return $this->belongsTo(Tag::class, 'tag_id')->withDefault([
			'name' => '[ Empty ]',
		]);
	}



}
