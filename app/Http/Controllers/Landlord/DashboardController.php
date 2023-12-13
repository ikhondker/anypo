<?php
/**
* =====================================================================================
* @version v1.0.0
* =====================================================================================
* @file			DashboardController.php
* @brief		This file contains the implementation of the DashboardController
* @path			\app\Http\Controllers\Landlord
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		10-DEC-2023
* @copyright	(c) Iqbal H. Khondker 
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 10-DEC-2023	v1.0.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.0.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;


// Models
use App\Models\User;
use App\Models\Landlord\Dashboard;
use App\Models\Landlord\Ticket;
use App\Models\Landlord\Account;


use App\Models\Landlord\Admin\Invoice;
use App\Models\Landlord\Admin\Payment;
use App\Models\Landlord\Admin\Service;

use App\Models\Landlord\Manage\Setup;

// Enums
use App\Enum\UserRoleEnum;

// Helpers

// Seeded
use Illuminate\Support\Facades\Log;
use Request;

class DashboardController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		switch (auth()->user()->role->value) {
			case UserRoleEnum::USER->value:
				return self::userDashboard();
				break;
			case UserRoleEnum::ADMIN->value:
				return self::adminDashboard();
				break;
			case UserRoleEnum::SUPPORT->value:
				return self::supportDashboard();
				break;
			case UserRoleEnum::SUPERVISOR->value:
				return self::supervisorDashboard();
				break;
			case UserRoleEnum::DEVELOPER->value:
				return self::supportDashboard();
				break;
			case UserRoleEnum::SYSTEM->value:
				return self::systemDashboard();
				break;
			default:
				return self::userDashboard();
				Log::debug("Other roles!");
		}
	}

	private function userDashboard()
	{

		$setup = Setup::first();

		// show only open notifications
		$notifications = auth()->user()->unreadNotifications;
		$count_notif   = auth()->user()->unreadNotifications()->count();

		$ticketsOpen = Ticket::byuser()->orderBy('id', 'DESC');
		$ticketsLast5 = Ticket::byuser()->orderBy('id', 'DESC')->limit(5);

	
		$count_tickets_open  = Ticket::byUserOpen()->count();
		$count_tickets_total  = Ticket::byUser()->count();

		$count_accounts = Account::byUser()->count();
		$count_service  = Service::byUser()->count();
		$count_invoices = Invoice::byaccount()->count();
		$count_payments = Payment::byaccount()->count();
		$count_users    = User::byuser()->count();

				return view('landlord.dashboards.index', with(compact('notifications','setup','count_notif',
					'count_tickets_open', 'count_tickets_total',
					'count_accounts', 'count_service',
					'count_invoices', 'count_payments','count_users',
					'ticketsOpen','ticketsLast5',
					)));
	}


	private function adminDashboard()
	{

		$setup = Setup::first();

		// unpaid invoice notification
		$account = Account::where('id', auth()->user()->account_id)->first();

		// show only open notifications
		$notifications = auth()->user()->unreadNotifications;
		$count_notif   = auth()->user()->unreadNotifications()->count();

		$ticketsOpen = Ticket::byAccountOpen()->orderBy('id', 'DESC');
		$ticketsLast5 = Ticket::byAccount()->orderBy('id', 'DESC')->limit(5);
				
		$count_tickets_open  = Ticket::byAccountOpen()->count();
		$count_tickets_total  = Ticket::byAccount()->count();

		$count_accounts = Account::byUser()->count();
		$count_service  = Service::byUser()->count();
		$count_invoices = Invoice::byAccount()->count();
		$count_payments = Payment::byAccount()->count();
		$count_users    = User::byAccount()->count();

		return view('landlord.dashboards.admin', with(compact('notifications','setup','count_notif','account',
			'count_tickets_open', 'count_tickets_total',
			'count_accounts', 'count_service',
			'count_invoices', 'count_payments','count_users',
			'ticketsOpen','ticketsLast5',
			)));

	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function supportDashboard()
	{
		$setup = Setup::first();

		// show only open notifications
		$notifications = auth()->user()->unreadNotifications;
		$count_notif   = auth()->user()->unreadNotifications()->count();

		$tickets= Ticket::orderBy('id', 'DESC')
			->where ('agent_id','=', null )
			->limit(5)->get();

	
		$count_agent_open_tickets  = Ticket::byAgentOpen()->count();
		$count_unassigned_tickets  = Ticket::byUnassigned()->count();
		$count_all_open_tickets  = Ticket::byallopen()->count();
		$count_agent_closed_tickets  = Ticket::byAgentClosed()->count();
		//$count_service  = Service::all()->count();
		//$count_users    = User::all()->count();
		return view('landlord.dashboards.backoffice', with(compact('notifications','setup','count_notif',
			'count_agent_open_tickets', 'count_unassigned_tickets',
			'count_all_open_tickets', 'count_agent_closed_tickets', 
			'tickets', 
		)));
			
		// return view('dashboards.index', with(compact('notifications','setup',
		//         'count_tickets', 'count_notif','count_service',
		//         'count_invoices', 'count_payments','count_users',
		//     )));
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function supervisorDashboard()
	{
		$setup = Setup::first();

		// show only open notifications
		$notifications = auth()->user()->unreadNotifications;
		$count_notif   = auth()->user()->unreadNotifications()->count();

		$tickets= Ticket::orderBy('id', 'DESC')
			->where ('agent_id','=', null )
			->limit(5)->get();

		// $orders_weeks   = Dashboard::CountOrdersWeek();
		// Log::debug('orders_weeks: '.$orders_weeks);
		// $sales_today    = Dashboard::SalesToday();
		// Log::debug('sales_today'.$sales_today);
		// $sales_week     = Dashboard::SalesWeek();
		// Log::debug('sales_week'.$sales_week);
		// $sales_month    = Dashboard::SalesMonth();
		// Log::debug('sales_month'.$sales_month);
		// $count_products  = Product::all()->count();
		// $count_orders    = Order::all()->count();
		// $count_users     = User::all()->count();
		// $sum_sales       = Order::all()->sum('amount');
		// $orders         = Order::all()->take(5);
		// $products       = Product::all()->take(5);
		//return view('tenant.dashboard',compact('orders','products','settings','orders_weeks','sales_today','sales_week','sales_month','count_products','count_orders', 'count_users','sum_sales'));

		// redirect to proper dashboard
		
		$count_all_open_tickets  = Ticket::byallopen()->count();
		$count_unassigned_tickets  = Ticket::byunassigned()->count();
		$count_all_onhold_tickets  = Ticket::byallclosed()->count();
		//$count_all_closed_tickets  = Ticket::byallclosed()->count();
		$count_service  = Service::all()->count();
		$count_users    = User::all()->count();
		return view('landlord.dashboards.backoffice', with(compact('notifications','setup','count_notif',
		'count_all_open_tickets', 'count_unassigned_tickets',
		'count_all_onhold_tickets', 'count_service','count_users','tickets'
		)));
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function systemDashboard()
	{
		$setup = Setup::first();

		// show only open notifications
		$notifications = auth()->user()->unreadNotifications;
		$count_notif   = auth()->user()->unreadNotifications()->count();

		$tickets= Ticket::orderBy('id', 'DESC')
			->where ('agent_id','=', null )
			->limit(5)->get();

		// $orders_weeks   = Dashboard::CountOrdersWeek();
		// Log::debug('orders_weeks: '.$orders_weeks);
		// $sales_today    = Dashboard::SalesToday();
		// Log::debug('sales_today'.$sales_today);
		// $sales_week     = Dashboard::SalesWeek();
		// Log::debug('sales_week'.$sales_week);
		// $sales_month    = Dashboard::SalesMonth();
		// Log::debug('sales_month'.$sales_month);
		// $count_products  = Product::all()->count();
		// $count_orders    = Order::all()->count();
		// $count_users     = User::all()->count();
		// $sum_sales       = Order::all()->sum('amount');
		// $orders         = Order::all()->take(5);
		// $products       = Product::all()->take(5);
		//return view('tenant.dashboard',compact('orders','products','settings','orders_weeks','sales_today','sales_week','sales_month','count_products','count_orders', 'count_users','sum_sales'));

		
		$count_tickets  = Ticket::all()->count();
		$count_service  = Service::all()->count();
		$count_invoices = Invoice::all()->count();
		$count_payments = Payment::all()->count();
		$count_users    = User::all()->count();
		return view('landlord.dashboards.system', with(compact('notifications','setup','count_notif',
			'count_tickets','count_service',
			'count_invoices', 'count_payments','count_users','tickets'
		)));
			
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		abort(403);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		abort(403);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Dashboard  $dashboard
	 * @return \Illuminate\Http\Response
	 */
	public function show(Dashboard $dashboard)
	{
		abort(403);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Dashboard  $dashboard
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Dashboard $dashboard)
	{
		abort(403);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Dashboard  $dashboard
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Dashboard $dashboard)
	{
		 abort(403);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Dashboard  $dashboard
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Dashboard $dashboard)
	{
		abort(403);
	}
}
