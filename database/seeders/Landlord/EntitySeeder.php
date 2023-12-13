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
              'entity'      => 'TEMPLATE',
              'name'        => 'Templates',
              'route'       => 'templates',
              'subdir'      => 'landlord/template',
            ],
            [
              'entity'      => 'TICKET',
              'name'        => 'Tickets',
              'route'       => 'tickets',
              'subdir'      => 'landlord/ticket',
            ],
            [
              'entity'      => 'COMMENT',
              'name'        => 'Comment',
              'route'       => 'comments',
              'subdir'      => 'landlord/comment',
            ],
            [
              'entity'      => 'PRODUCT',
              'name'        => 'Products',
              'route'       => 'products',
              'subdir'      => 'landlord/products',
            ],
            [
              'entity'      => 'CHECKOUT',
              'name'        => 'Checkout',
              'route'       => 'checkouts',
              'subdir'      => 'landlord/checkout',
            ],
            [
              'entity'      => 'ACCOUNT',
              'name'        => 'Accounts',
              'route'       => 'accounts',
              'subdir'      => 'landlord/account',
            ],
            [
              'entity'      => 'SERVICE',
              'name'        => 'Services',
              'route'       => 'services',
              'subdir'      => 'landlord/service',
            ],
            [
              'entity'      => 'INVOICE',
              'name'        => 'Invoices',
              'route'       => 'invoices',
              'subdir'      => 'landlord/invoice',
            ],
            [
              'entity'      => 'PAYMENT',
              'name'        => 'Payments',
              'route'       => 'payments',
              'subdir'      => 'landlord/payments',
            ],
            [
              'entity'      => 'CONTACT',
              'name'        => 'Contacts',
              'route'       => 'contacts',
              'subdir'      => 'landlord/contacts',
            ],
          ];
        
          Entity::insert($entities);
    }
}
