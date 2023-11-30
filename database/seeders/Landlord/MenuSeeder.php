<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Landlord\Admin\Menu;

class MenuSeeder extends Seeder
{
    // F - Front end
    // B - Back end
    // X - Not Developed
    // S - system only

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::truncate();

        $menus =  [
            [ 'raw_route_name' => 'accounts.index',     'route_name' => 'accounts.index',       'access' => 'F'],
            [ 'raw_route_name' => 'accounts.show',      'route_name' => 'accounts.index',       'access' => 'F'],
            [ 'raw_route_name' => 'accounts.update',    'route_name' => 'accounts.index',       'access' => 'F'],
            [ 'raw_route_name' => 'accounts.edit',      'route_name' => 'accounts.index',       'access' => 'F'],
            [ 'raw_route_name' => 'accounts.create',    'route_name' => 'accounts.index',       'access' => 'X'],
            [ 'raw_route_name' => 'accounts.all',       'route_name' => 'accounts.index',       'access' => 'B'],

            [ 'raw_route_name' => 'activities.index',   'route_name' => 'activities.index',     'access' => 'F'],
            [ 'raw_route_name' => 'activities.show',    'route_name' => 'activities.index',     'access' => 'F'],
            [ 'raw_route_name' => 'activities.update',  'route_name' => 'activities.index',     'access' => 'X'],
            [ 'raw_route_name' => 'activities.edit',    'route_name' => 'activities.index',     'access' => 'X'],
            [ 'raw_route_name' => 'activities.create',  'route_name' => 'activities.index',     'access' => 'X'],
            [ 'raw_route_name' => 'activities.all',     'route_name' => 'activities.index',     'access' => 'B'],

            [ 'raw_route_name' => 'attachments.index',  'route_name' => 'attachments.index',    'access' => 'B'], 
            [ 'raw_route_name' => 'attachments.show',   'route_name' => 'attachments.index',    'access' => 'B'],
            [ 'raw_route_name' => 'attachments.update', 'route_name' => 'attachments.index',    'access' => 'B'],
            [ 'raw_route_name' => 'attachments.edit',   'route_name' => 'attachments.index',    'access' => 'B'],
            [ 'raw_route_name' => 'attachments.create', 'route_name' => 'attachments.index',    'access' => 'B'],
            
            [ 'raw_route_name' => 'contacts.all',       'route_name' => 'contacts.index',       'access' => 'B'],

            [ 'raw_route_name' => 'categories.index',     'route_name' => 'categories.index',       'access' => 'B'],
            [ 'raw_route_name' => 'categories.show',      'route_name' => 'categories.index',       'access' => 'B'],
            [ 'raw_route_name' => 'categories.update',    'route_name' => 'categories.index',       'access' => 'B'],
            [ 'raw_route_name' => 'categories.edit',      'route_name' => 'categories.index',       'access' => 'B'],
            [ 'raw_route_name' => 'categories.create',    'route_name' => 'categories.index',       'access' => 'B'],

            [ 'raw_route_name' => 'dashboards.index',   'route_name' => 'dashboards.index',     'access' => 'F'],
            [ 'raw_route_name' => 'dashboards.show',    'route_name' => 'dashboards.index',     'access' => 'F'],
            [ 'raw_route_name' => 'dashboards.update',  'route_name' => 'dashboards.index',     'access' => 'X'],
            [ 'raw_route_name' => 'dashboards.edit',    'route_name' => 'dashboards.index',     'access' => 'X'],
            [ 'raw_route_name' => 'dashboards.create',  'route_name' => 'dashboards.index',     'access' => 'X'],

            [ 'raw_route_name' => 'domains.index',      'route_name' => 'domains.index',        'access' => 'B'],
            [ 'raw_route_name' => 'domains.show',       'route_name' => 'domains.index',        'access' => 'B'],
            [ 'raw_route_name' => 'domains.update',     'route_name' => 'domains.index',        'access' => 'B'],
            [ 'raw_route_name' => 'domains.edit',       'route_name' => 'domains.index',        'access' => 'B'],
            [ 'raw_route_name' => 'domains.create',     'route_name' => 'domains.index',        'access' => 'B'],

            [ 'raw_route_name' => 'entities.index',     'route_name' => 'entities.index',       'access' => 'B'],
            [ 'raw_route_name' => 'entities.show',      'route_name' => 'entities.index',       'access' => 'B'],
            [ 'raw_route_name' => 'entities.update',    'route_name' => 'entities.index',       'access' => 'B'],
            [ 'raw_route_name' => 'entities.edit',      'route_name' => 'entities.index',       'access' => 'B'],
            [ 'raw_route_name' => 'entities.create',    'route_name' => 'entities.index',       'access' => 'B'],

            [ 'raw_route_name' => 'invoices.index',     'route_name' => 'invoices.index',       'access' => 'F'],
            [ 'raw_route_name' => 'invoices.show',      'route_name' => 'invoices.index',       'access' => 'F'],
            [ 'raw_route_name' => 'invoices.update',    'route_name' => 'invoices.index',       'access' => 'B'],
            [ 'raw_route_name' => 'invoices.edit',      'route_name' => 'invoices.index',       'access' => 'B'],
            [ 'raw_route_name' => 'invoices.create',    'route_name' => 'invoices.index',       'access' => 'B'],
            [ 'raw_route_name' => 'invoices.all',       'route_name' => 'invoices.index',       'access' => 'B'],

            [ 'raw_route_name' => 'menus.index',        'route_name' => 'menus.index',          'access' => 'B'],
            [ 'raw_route_name' => 'menus.show',         'route_name' => 'menus.index',          'access' => 'B'],
            [ 'raw_route_name' => 'menus.update',       'route_name' => 'menus.index',          'access' => 'B'],
            [ 'raw_route_name' => 'menus.edit',         'route_name' => 'menus.index',          'access' => 'B'],
            [ 'raw_route_name' => 'menus.create',       'route_name' => 'menus.index',          'access' => 'B'],

            [ 'raw_route_name' => 'notifications.index','route_name' => 'notifications.index',  'access' => 'X'],
            [ 'raw_route_name' => 'notifications.show', 'route_name' => 'notifications.index',  'access' => 'X'],
            [ 'raw_route_name' => 'notifications.update','route_name' => 'notifications.index', 'access' => 'X'],
            [ 'raw_route_name' => 'notifications.edit', 'route_name' => 'notifications.index',  'access' => 'X'],
            [ 'raw_route_name' => 'notifications.create','route_name' => 'notifications.index', 'access' => 'X'],

            [ 'raw_route_name' => 'payments.index',     'route_name' => 'payments.index',       'access' => 'F'],
            [ 'raw_route_name' => 'payments.show',      'route_name' => 'payments.index',       'access' => 'F'],
            [ 'raw_route_name' => 'payments.update',    'route_name' => 'payments.index',       'access' => 'B'],
            [ 'raw_route_name' => 'payments.edit',      'route_name' => 'payments.index',       'access' => 'B'],
            [ 'raw_route_name' => 'payments.create',    'route_name' => 'payments.index',       'access' => 'B'],
            [ 'raw_route_name' => 'payments.all',       'route_name' => 'payments.index',       'access' => 'B'],

            [ 'raw_route_name' => 'processes.index',    'route_name' => 'processes.index',      'access' => 'B'],
            [ 'raw_route_name' => 'processes.show',     'route_name' => 'processes.index',      'access' => 'B'],
            [ 'raw_route_name' => 'processes.update',   'route_name' => 'processes.index',      'access' => 'B'],
            [ 'raw_route_name' => 'processes.edit',     'route_name' => 'processes.index',      'access' => 'B'],
            [ 'raw_route_name' => 'processes.create',   'route_name' => 'processes.index',      'access' => 'B'],
            
            [ 'raw_route_name' => 'products.index',     'route_name' => 'products.index',       'access' => 'B'],
            [ 'raw_route_name' => 'products.show',      'route_name' => 'products.index',       'access' => 'B'],
            [ 'raw_route_name' => 'products.update',    'route_name' => 'products.index',       'access' => 'B'],
            [ 'raw_route_name' => 'products.edit',      'route_name' => 'products.index',       'access' => 'B'],
            [ 'raw_route_name' => 'products.create',    'route_name' => 'products.index',       'access' => 'B'],

            [ 'raw_route_name' => 'services.index',     'route_name' => 'services.index',       'access' => 'F'],
            [ 'raw_route_name' => 'services.show',      'route_name' => 'services.index',       'access' => 'F'],
            [ 'raw_route_name' => 'services.update',    'route_name' => 'services.index',       'access' => 'F'],
            [ 'raw_route_name' => 'services.edit',      'route_name' => 'services.index',       'access' => 'B'],
            [ 'raw_route_name' => 'services.create',    'route_name' => 'services.index',       'access' => 'B'],
            [ 'raw_route_name' => 'services.all',       'route_name' => 'services.index',       'access' => 'B'],

            [ 'raw_route_name' => 'setups.index',       'route_name' => 'setups.index',         'access' => 'S'],
            [ 'raw_route_name' => 'setups.show',        'route_name' => 'setups.index',         'access' => 'S'],
            [ 'raw_route_name' => 'setups.update',      'route_name' => 'setups.index',         'access' => 'S'],
            [ 'raw_route_name' => 'setups.edit',        'route_name' => 'setups.index',         'access' => 'S'],
            [ 'raw_route_name' => 'setups.create',      'route_name' => 'setups.index',         'access' => 'X'],

            [ 'raw_route_name' => 'checkouts.index',    'route_name' => 'checkouts.index',      'access' => 'B'],
            [ 'raw_route_name' => 'checkouts.show',     'route_name' => 'checkouts.index',      'access' => 'B'],
            [ 'raw_route_name' => 'checkouts.update',   'route_name' => 'checkouts.index',      'access' => 'B'],
            [ 'raw_route_name' => 'checkouts.edit',     'route_name' => 'checkouts.index',      'access' => 'B'],
            [ 'raw_route_name' => 'checkouts.create',   'route_name' => 'checkouts.index',      'access' => 'X'],
            [ 'raw_route_name' => 'checkouts.all',      'route_name' => 'checkouts.index',      'access' => 'B'],

            [ 'raw_route_name' => 'statuses.index',     'route_name' => 'statuses.index',       'access' => 'B'],
            [ 'raw_route_name' => 'statuses.show',      'route_name' => 'statuses.index',       'access' => 'B'],
            [ 'raw_route_name' => 'statuses.update',    'route_name' => 'statuses.index',       'access' => 'B'],
            [ 'raw_route_name' => 'statuses.edit',      'route_name' => 'statuses.index',       'access' => 'S'],
            [ 'raw_route_name' => 'statuses.create',    'route_name' => 'statuses.index',       'access' => 'S'],

            [ 'raw_route_name' => 'tables.models',      'route_name' => 'tables.index',         'access' => 'S'],
            [ 'raw_route_name' => 'tables.policies',    'route_name' => 'tables.index',         'access' => 'S'],
            [ 'raw_route_name' => 'tables.route-code',  'route_name' => 'tables.index',         'access' => 'S'],
            [ 'raw_route_name' => 'tables.routes',      'route_name' => 'tables.index',         'access' => 'S'],
            [ 'raw_route_name' => 'tables.structure',   'route_name' => 'tables.index',         'access' => 'S'],
            [ 'raw_route_name' => 'tables.index',       'route_name' => 'tables.index',         'access' => 'S'],
            [ 'raw_route_name' => 'tables.show',        'route_name' => 'tables.index',         'access' => 'S'],

            [ 'raw_route_name' => 'templates.index',    'route_name' => 'templates.index',      'access' => 'S'],
            [ 'raw_route_name' => 'templates.show',     'route_name' => 'templates.index',      'access' => 'S'],
            [ 'raw_route_name' => 'templates.update',   'route_name' => 'templates.index',      'access' => 'S'],
            [ 'raw_route_name' => 'templates.edit',     'route_name' => 'templates.index',      'access' => 'S'],
            [ 'raw_route_name' => 'templates.create',   'route_name' => 'templates.index',      'access' => 'S'],
            
            [ 'raw_route_name' => 'tenants.index',      'route_name' => 'tenants.index',        'access' => 'B'],
            [ 'raw_route_name' => 'tenants.show',       'route_name' => 'tenants.index',        'access' => 'B'],
            [ 'raw_route_name' => 'tenants.update',     'route_name' => 'tenants.index',        'access' => 'B'],
            [ 'raw_route_name' => 'tenants.edit',       'route_name' => 'tenants.index',        'access' => 'B'],
            [ 'raw_route_name' => 'tenants.create',     'route_name' => 'tenants.index',        'access' => 'B'],

            [ 'raw_route_name' => 'tickets.index',      'route_name' => 'tickets.index',        'access' => 'F'],
            [ 'raw_route_name' => 'tickets.show',       'route_name' => 'tickets.index',        'access' => 'F'],
            [ 'raw_route_name' => 'tickets.update',     'route_name' => 'tickets.index',        'access' => 'F'],
            [ 'raw_route_name' => 'tickets.edit',       'route_name' => 'tickets.index',        'access' => 'B'],
            [ 'raw_route_name' => 'tickets.create',     'route_name' => 'tickets.index',        'access' => 'B'],
            [ 'raw_route_name' => 'tickets.all',        'route_name' => 'tickets.index',        'access' => 'B'],

            [ 'raw_route_name' => 'users.show',         'route_name' => 'users.show',           'access' => 'F'],
            [ 'raw_route_name' => 'users.password',     'route_name' => 'users.password',       'access' => 'F'],
            [ 'raw_route_name' => 'users.index',        'route_name' => 'users.index',          'access' => 'F'],
            [ 'raw_route_name' => 'users.update',       'route_name' => 'users.index',          'access' => 'F'],
            [ 'raw_route_name' => 'users.edit',         'route_name' => 'users.show',           'access' => 'F'],
            [ 'raw_route_name' => 'users.create',       'route_name' => 'users.index',          'access' => 'F'],
            [ 'raw_route_name' => 'users.all',          'route_name' => 'users.index',          'access' => 'B'],

        ];
        Menu::insert($menus);
    }
}
