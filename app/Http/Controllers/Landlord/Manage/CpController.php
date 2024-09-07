<?php
/**
* =====================================================================================
* @version v1.0
* =====================================================================================
* @file			EntityController.php
* @brief		This file contains the implementation of the EntityController
* @path			\App\Http\Controllers\Tenant\Manage
* @author		Iqbal H. Khondker <ihk@khondker.com>
* @created		4-JAN-2024
* @copyright	(c) Iqbal H. Khondker <ihk@khondker.com>
* =====================================================================================
* Revision History:
* Date			Version	Author				Comments
* -------------------------------------------------------------------------------------
* 4-JAN-2024	v1.0	Iqbal H Khondker	Created
* DD-MON-YYYY	v1.1	Iqbal H Khondker	Modification brief
* =====================================================================================
*/
namespace App\Http\Controllers\Landlord\Manage;

use App\Http\Controllers\Controller;

use App\Models\Landlord\Manage\Cp;
use App\Http\Requests\Landlord\Manage\StoreCpRequest;
use App\Http\Requests\Landlord\Manage\UpdateCpRequest;

use Illuminate\Support\Facades\Log;

class CpController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function changeLog()
	{
		//$this->authorize('viewAny',Oem::class);
		return view('landlord.manage.cps.changelog');
	}

/**
	 * Display a listing of the resource.
	 */
	public function codeGen()
	{
		//$this->authorize('viewAny',Oem::class);
		return view('landlord.manage.cps.codegen');
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreCpRequest $request)
	{
		//$accordion_id = 'Faq';
		//$div_id = 'One';

		$section 	= $request->input('section');				// Faq
		$div 		= $request->input('div');					// One
		//Log::debug('Value of accordion_id	=' . $section);
		//Log::debug('Value of div_id			=' . $div);

		$accordion 	= 'accordion'.ucfirst($section);			// accordionFaq
		$card 		= strtolower($section).ucfirst($div);		// faqOne
		$collapse 	= 'collapse'.ucfirst($div);					// collapseOne

		// 	<div class="card border mb-3">
		// 	<div class="card-header cursor-pointer" id="faqOne" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		// 		<h6 class="mb-0">
		// 			Q: 
		// 		</h6>
		// 	</div>
		// 	<div id="collapseOne" class="collapse show" aria-labelledby="faqOne" data-bs-parent="#accordionFaq">
		// 		<div class="card-body py-3">
		// 			ANS:
		// 		</div>
		// 	</div>
			

		$text='
		<div class="card border mb-3">
			<div class="card-header cursor-pointer" id="'.$card.'" data-bs-toggle="collapse" data-bs-target="#'.$collapse.'" aria-expanded="true" aria-controls="'.$collapse.'">
				<h6 class="mb-0">
					Q: '. $div .'
				</h6>
			</div>
			<div id="'.$collapse.'" class="collapse '.($div == 'One' ? 'show' : '').'" aria-labelledby="'.$card.'" data-bs-parent="#'.$accordion.'">
				<div class="card-body py-3">
					Ans: '.$div .'
				</div>
			</div>
		</div>
		';

		// {!! $text !!}

		//return view('landlord.manage.entities.index', compact('entities'));

		return view('landlord.manage.cps.codegen', compact('text'));

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Cp $cp)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Cp $cp)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateCpRequest $request, Cp $cp)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Cp $cp)
	{
		//
	}
}
