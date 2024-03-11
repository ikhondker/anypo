<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Manage\Entity;

class EntitySeeder extends Seeder
{
		/**
			* Run the database seeds.
			*/
		public function run(): void
		{
				//Entity::truncate();

				$entities =  [
						[
							'entity'	=> 'TEMPLATE',
							'name'		=> 'Templates',
							'model'		=> 'template',
							'route'		=> 'templates',
							'directory'	=> 'template',
						],
						[
							'entity'	=> 'TICKET',
							'name'		=> 'Tickets',
							'model'		=> 'Ticket',
							'route'		=> 'tickets',
							'directory'	=> 'ticket',
						],
						[
							'entity'	=> 'COMMENT',
							'name'		=> 'Comment',
							'model'		=> 'Comment',
							'route'		=> 'comments',
							'directory'	=> 'comment',
						],
						[
							'entity'	=> 'PRODUCT',
							'name'		=> 'Products',
							'model'		=> 'Product',
							'route'		=> 'products',
							'directory'	=> 'products',
						],
						[
							'entity'	=> 'CHECKOUT',
							'name'		=> 'Checkout',
							'model'		=> 'Checkout',
							'route'		=> 'checkouts',
							'directory'	=> 'checkout',
						],
						[
							'entity'	=> 'ACCOUNT',
							'name'		=> 'Accounts',
							'model'		=> 'Account',
							'route'		=> 'accounts',
							'directory'	=> 'account',
						],
						[
							'entity'	=> 'SERVICE',
							'name'		=> 'Services',
							'model'		=> 'Service',
							'route'		=> 'services',
							'directory'	=> 'service',
						],
						[
							'entity'	=> 'INVOICE',
							'name'		=> 'Invoices',
							'model'		=> 'Invoice',
							'route'		=> 'invoices',
							'directory'	=> 'invoice',
						],
						[
							'entity'	=> 'PAYMENT',
							'name'		=> 'Payments',
							'model'		=> 'Payment',
							'route'		=> 'payments',
							'directory'	=> 'payments',
						],
						[
							'entity'	=> 'CONTACT',
							'name'		=> 'Contacts',
							'model'		=> 'Contact',
							'route'		=> 'contacts',
							'directory'	=> 'contacts',
						],
					];
				
					Entity::insert($entities);
		}
}
