<?php

namespace App\Models\Landlord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// IQBAL 15-OCT-22
use App\Traits\AddCreatedUpdatedBy;
use App\Models\User;

class Dashboard extends Model
{
    use HasFactory, AddCreatedUpdatedBy;
}
