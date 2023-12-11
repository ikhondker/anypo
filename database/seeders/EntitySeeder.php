<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tenant\Manage\Entity;
use Illuminate\Support\Facades\Schema;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Schema::disableForeignKeyConstraints();
        //Entity::truncate();
        //Schema::enableForeignKeyConstraints();

        $entities =  [
            [
                'entity'      => 'TEMPLATE',
                'name'        => 'Templates',
                'route'       => 'templates',
                'subdir'      => 'template',
            ],
            [
                'entity'      => 'BUDGET',
                'name'        => 'Budget',
                'route'       => 'budgets',
                'subdir'      => 'budget',
            ],
            [
                'entity'      => 'DEPTBUDGET',
                'name'        => 'DeptBudget',
                'route'       => 'dept-budgets',
                'subdir'      => 'dept-budget',
            ],
            [
                'entity'      => 'PROJECT',
                'name'        => 'Project',
                'route'       => 'projects',
                'subdir'      => 'project',
            ],

            [
                'entity'      => 'PR',
                'name'        => 'PR',
                'route'       => 'pr',
                'subdir'      => 'pr',
            ],
            [
                'entity'      => 'PO',
                'name'        => 'PO',
                'route'       => 'po',
                'subdir'      => 'po',
            ],
            [
                'entity'      => 'RECEIPT',
                'name'        => 'Receipts',
                'route'       => 'receipts',
                'subdir'      => 'receipts',
            ],
            [
                'entity'      => 'PAYMENT',
                'name'        => 'Payments',
                'route'       => 'payments',
                'subdir'      => 'payments',
            ],
            [
                'entity'      => 'COMMENT',
                'name'        => 'Comment',
                'route'       => 'comments',
                'subdir'      => 'comment',
            ],


          ];

        
          Entity::insert($entities);
    }
}
