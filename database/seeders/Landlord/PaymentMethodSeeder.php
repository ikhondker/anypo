<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Lookup\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       //PaymentMethod::truncate();
        
       $payment_methods =  [
        [
          'id' => 1001,
          'name' => 'Cash',
        ],
        [
          'id' => 1002,
          'name' => 'Credit and Debit card',
        ],
        [
          'id' => 1003,
          'name' => 'Mobile Payments',
        ],
        [
          'id' => 1004,
        'name' => 'Checks',
        ],
        [
          'id' => 1005,
          'name' => 'Bank Transfer',
        ],
        [
          'id' => 1006,
          'name' => 'Cryptocurrency',
        ],
      ];
      //
      PaymentMethod::insert($payment_methods);
    }
}
