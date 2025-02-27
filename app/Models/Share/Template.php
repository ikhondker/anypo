<?php

namespace App\Models\Share;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

class Template extends Model
{
		use HasFactory, AddCreatedUpdatedBy;
		// protected $dates = [
		//	'my_date',
		// ];

		protected $casts = [
				'my_date_time'	=> 'datetime',
				'my_date'		=> 'date',
				'updated_at'	=> 'datetime',
				'created_at'	=> 'datetime',
		];

		protected $fillable = [
			'code', 'name', 'summary', 'user_id', 'address1', 'address2', 'city', 'state', 'zip', 'country', 'email', 'cell', 'qty', 'amount', 'notes', 'enable', 'my_date', 'my_date_time', 'my_enum', 'my_url', 'logo', 'avatar', 'attachment', 'fbpage', 'updated_by', 'updated_at',
		];

		/* ----------------- Functions ---------------------- */

		/* ----------------- Scopes ------------------------- */

		/* ----------------- HasMany ------------------------ */

		/* ----------------- belongsTo ---------------------- */
		public function user(){
			return $this->belongsTo(User::class,'user_id');
		}



}
