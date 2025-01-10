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
			['name'	=> 'Miscellaneous', 'bg_color' => 'primary',],
			['name'	=> 'Office Rent',  'bg_color' => 'secondary',],
			['name'	=> 'Electric Bill',  'bg_color' => 'success',],
			['name'	=> 'Water Bill',  'bg_color' => 'danger',],
			['name'	=> 'Internet Bill',  'bg_color' => 'warning',],
			['name'	=> 'Fuel-Diesel/Petrol/Octen/CNG/LPG etc.',  'bg_color' => 'info',],

			['name'	=> 'Telephone/Cell Phone Bill etc.',  'bg_color' => 'primary',],
			['name'	=> 'Stationery',  'bg_color' => 'secondary',],
			['name'	=> 'Computer Accessories',  'bg_color' => 'success',],
			['name'	=> 'Others Accessories',  'bg_color' => 'danger',],
			['name'	=> 'Professional fee-Tax/Audit & Company Affairs',  'bg_color' => 'warning',],
			['name'	=> 'Government Fees etc.',  'bg_color' => 'info',],

			['name'	=> 'Membership Fee',  'bg_color' => 'primary',],
			['name'	=> 'Advertisement/Business Promotion',  'bg_color' => 'secondary',],
			['name'	=> 'Repairing and Maintenance',  'bg_color' => 'success',],
			['name'	=> 'Renovation',  'bg_color' => 'danger',],
			['name'	=> 'Refreshment/Entertainment',  'bg_color' => 'warning',],
			['name'	=> 'Advance Salary/Loan',  'bg_color' => 'info',],

			['name'	=> 'Assets',  'bg_color' => 'primary',],
			['name'	=> 'Office Furniture',  'bg_color' => 'secondary',],
			['name'	=> 'Electrical Goods etc.,',  'bg_color' => 'success',],
			['name'	=> 'Laptop/Note Book etc.',  'bg_color' => 'danger',],
			['name'	=> 'Desktop/Monitor/Router etc.',  'bg_color' => 'warning',],
		];
		//
		Category::insert($categories);
	}
}
