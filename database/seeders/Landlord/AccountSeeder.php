<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Landlord\Account;


class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::factory()->count(2)->create();

        // Link User with Accounts
        User::where('id', 1007)->update(['account_id' => '1001']);
        User::where('id', 1008)->update(['account_id' => '1001']);
        User::where('id', 1009)->update(['account_id' => '1001']);

        User::where('id', 1010)->update(['account_id' => '1002']);
        User::where('id', 1011)->update(['account_id' => '1002']);
        User::where('id', 1012)->update(['account_id' => '1002']);

        Account::where('id', 1001)->update(['logo' => 'account1.png']);
        Account::where('id', 1002)->update(['logo' => 'account2.png']);

    }
}
