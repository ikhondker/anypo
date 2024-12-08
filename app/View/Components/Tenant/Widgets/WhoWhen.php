<?php

namespace App\View\Components\Tenant\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Tenant\Lookup\BankAccount;
use App\Models\Tenant\Lookup\Category;
use App\Models\Tenant\Lookup\Dept;
use App\Models\Tenant\Lookup\Designation;
use App\Models\Tenant\Lookup\Group;
use App\Models\Tenant\Lookup\Item;
use App\Models\Tenant\Lookup\ItemCategory;
use App\Models\Tenant\Lookup\Oem;
use App\Models\Tenant\Lookup\Project;
use App\Models\Tenant\Lookup\Supplier;
use App\Models\Tenant\Lookup\Uom;
use App\Models\Tenant\Lookup\Warehouse;
use App\Models\Tenant\Lookup\Currency;

use App\Models\Tenant\Pr;
use App\Models\Tenant\Po;
use App\Models\Tenant\Receipt;
use App\Models\Tenant\Invoice;
use App\Models\Tenant\Payment;

use App\Models\Tenant\Budget;
use App\Models\Tenant\DeptBudget;

use App\Models\User;
use App\Models\Tenant\Admin\Setup;
use App\Models\Tenant\Workflow\Hierarchy;

# 2. Enums
use App\Enum\Tenant\EntityEnum;
use Illuminate\Support\Facades\Log;

use Str;

class WhoWhen extends Component
{
	/**
	 * Create a new component instance.
	*/
	public $route;
	public $article;

	public function __construct(public string $model, public string $articleId)
	{

		$this->route = Str::lower(Str::plural(Str::snake($model, '-')));
		switch ($model) {

			case 'BankAccount':
				$this->article = BankAccount::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'Category':
				$this->article = Category::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'Dept':
				$this->article = Dept::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'Designation':
				$this->article = Designation::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'Group':
				$this->article = Group::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'Item':
				$this->article = Item::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'ItemCategory':
				$this->article = ItemCategory::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'Oem':
				$this->article = Oem::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'Project':
				$this->article = Project::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'Supplier':
				$this->article = Supplier::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'Uom':
				$this->article = Uom::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'Warehouse':
				$this->article = Warehouse::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
			break;
			case 'Currency':
				$this->article		= Currency::where('currency', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				$this->article->id  = $this->article->currency;
			break;

			case 'Pr':
				$this->article = Pr::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'Po':
				$this->article = Po::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
				case 'Receipt':
				$this->article = Receipt::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'Invoice':
				$this->article = Invoice::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
			   	break;
			case 'Payment':
				$this->article = Payment::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'Budget':
				$this->article = Budget::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'DeptBudget':
				$this->article = DeptBudget::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'Setup':
				//Log::debug('I AM HERE');
				$this->article = Setup::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				//Log::debug('Article id = '.$this->article->name);
				break;
			case 'User':
				$this->article = User::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			case 'Hierarchy':
				$this->article = Hierarchy::where('id', $articleId)->with('user_created_by')->with('user_updated_by')->get()->firstOrFail();
				break;
			default:
			null;
		}

	}
	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.tenant.widgets.who-when');
	}
}
