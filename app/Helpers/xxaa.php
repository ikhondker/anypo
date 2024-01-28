public static function checkAndBookPo($po_id)
	{
		
		$po = Pr::where('id', $po_id)->first();

		// check if dept_budget for this year exists
		// increase booking

		// check if budget for this year exists
		$fy = Carbon::now()->format('Y');
		try {
			$budget = Budget::primary()->where('fy', $fy)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			Log::debug("Inside ModelNotFoundException");
			return 'E001';
		}

		// check if dept_budget for this year exists
		Log::debug("po->dept_id=".$po->dept_id);
		Log::debug("po->dept_budget_id=".$po->dept_budget_id);

		try {
			$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
		} catch (ModelNotFoundException $exception) {
			//Log::debug("Inside ModelNotFoundException");
			return 'E002';
		}

		// check if budget is available then update dept_budget
		if (($dept_budget->amount - $dept_budget->amount_po_booked - $dept_budget->amount_po_issued) > $po->fc_amount) {
			// book po budget
			$dept_budget->amount_po_booked = $dept_budget->amount_po_booked + $po->fc_amount;
			$dept_budget->save();

			$budget->amount_po_booked = $budget->amount_po_booked + $po->fc_amount;
			$budget->save();
		} else {
			return 'E003';
		}

		// update projects budget
		$project = Project::where('id', $po->project_id)->firstOrFail();
		$project->amount_po_booked = $project->amount_po_booked + $po->fc_amount;
		$project->save();

		return 'E000';
	}

	// wfl->reject
	// po->cancel
	public static function reverseBookingPo($po_id)
	{

		$po = Pr::where('id', $pr_id)->first();

		$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
		$dept_budget->amount_po_booked = $dept_budget->amount_po_booked - $po->fc_amount;
		$dept_budget->save();

		$budget = Budget::primary()->where('id', $dept_budget->budget_id)->firstOrFail();
		$budget->amount_po_booked = $budget->amount_po_booked - $po->fc_amount;
		$budget->save();

		$project = Project::where('id', $po->project_id)->firstOrFail();
		$project->amount_po_booked = $project->amount_po_booked - $po->fc_amount;
		$project->save();

		return 'E000';
	}

	public static function confirmBudgetPo($po_id)
	{
		$po = Pr::where('id', $pr_id)->first();

		$dept_budget = DeptBudget::primary()->where('id', $po->dept_budget_id)->firstOrFail();
		$dept_budget->amount_po_issued = $dept_budget->amount_po_issued + $po->fc_amount;
		$dept_budget->amount_po_booked = $dept_budget->amount_po_booked - $po->fc_amount;
		$dept_budget->save();

		$budget = Budget::primary()->where('id', $dept_budget->budget_id)->firstOrFail();
		$budget->amount_po_issued = $budget->amount_po_issued + $po->fc_amount;
		$budget->amount_po_booked = $budget->amount_po_booked - $po->fc_amount;
		$budget->save();

		$project = Project::where('id', $po->project_id)->firstOrFail();
		$project->amount_po_issued = $project->amount_po_issued + $po->fc_amount;
		$project->amount_po_booked = $project->amount_po_booked - $po->fc_amount;
		$project->save();

		return 'E000';
	}