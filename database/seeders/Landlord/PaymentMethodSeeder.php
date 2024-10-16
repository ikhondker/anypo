<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Lookup\PaymentMethod;
use App\Enum\Landlord\PaymentMethodEnum;

class PaymentMethodSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			 //PaymentMethod::truncate();

			 $payment_methods = [
				[
					'code' => PaymentMethodEnum::CASH->value,
					'name' => 'Cash',
				],
				[
					'code' => PaymentMethodEnum::CARD->value,
					'name' => 'Credit and Debit card',
				],
				[
					'code' => PaymentMethodEnum::MFS->value,
					'name' => 'Mobile Payments',
				],
				[
					'code' => PaymentMethodEnum::CHECK->value,
				'name' => 'Checks',
				],
				[
					'code' => PaymentMethodEnum::BANK->value,
					'name' => 'Bank Transfer',
				],
				[
					'code' => PaymentMethodEnum::CARD->value,
					'name' => 'Cryptocurrency',
				],
			];
			//
			PaymentMethod::insert($payment_methods);
		}
}
