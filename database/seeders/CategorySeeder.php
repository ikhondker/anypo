<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\Tenant\Lookup\Category;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		$categories = [
			['name'	=> 'Miscellaneous', ],
			['name'	=> 'Office Rent', ],
			['name'	=> 'Electric Bill', ],
			['name'	=> 'Water Bill', ],
			['name'	=> 'Internet Bill', ],
			['name'	=> 'Fuel-Diesel/Petrol/Octen/CNG/LPG etc.', ],
			['name'	=> 'Telephone/Cell Phone Bill etc.', ],
			['name'	=> 'Stationery', ],
			['name'	=> 'Computer Accessories', ],
			['name'	=> 'Others Accessories', ],
			['name'	=> 'Professional fee-Tax/Audit & Company Affairs', ],
			['name'	=> 'Government Fees etc.', ],
			['name'	=> 'Membership Fee', ],
			['name'	=> 'Advertisement/Business Promotion', ],
			['name'	=> 'Repairing and Maintenance', ],
			['name'	=> 'Renovation', ],
			['name'	=> 'Refreshment/Entertainment', ],
			['name'	=> 'Advance Salary/Loan', ],
			['name'	=> 'Assets', ],
			['name'	=> 'Office Furniture', ],
			['name'	=> 'Electrical Goods etc.,', ],
			['name'	=> 'Laptop/Note Book etc.', ],
			['name'	=> 'Desktop/Monitor/Router etc.', ],
		];
		//
		Category::insert($categories);
	}
}
