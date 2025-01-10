<?php

namespace App\View\Components\Tenant;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;

use App\Models\User;

use App\Models\Tenant\Export;

use App\Models\Tenant\Lookup\Currency;
use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Warehouse;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\BankAccount;

class ExportParam extends Component
{

	public $export;
	public $currencies;
	public $depts;
	public $suppliers;
	public $projects;
	public $warehouses;
	public $bankAccounts;
	public $users;

	/**
	 * Create a new component instance.
	 */
	public function __construct(public string $entity)
	{
		$this->export			= Export::where('entity', $entity)->firstOrFail();
		$this->currencies 		= Currency::Primary()->get();
		$this->depts 			= Dept::Primary()->get();
		$this->suppliers 		= Supplier::Primary()->get();
		$this->projects 		= Project::Primary()->get();
		$this->warehouses 	 	= Warehouse::Primary()->get();
		$this->bankAccounts 	= BankAccount::Primary()->get();
		$this->users			= User::Tenant()->get();
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.export-param');
	}
}
