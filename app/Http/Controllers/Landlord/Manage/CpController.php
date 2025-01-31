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

use App\Jobs\Landlord\SyncLandlord;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Number;

class CpController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return view('landlord.manage.cps.index');
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
		//$test = 1000025.05;

		//$f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );
		//$word = $f->format($test);
		//dd($word);

		//$f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
		//echo $f->format(1432);
		//dd($f->format(1432));

		$section 	= $request->input('section');				// Faq
		$div 		= $request->input('div');					// One
		Log::debug('section/accordion_id	=' . $section);
		//Log::debug('Value of div_id			=' . $div);

		//$accordion 	= 'accordion'.ucfirst($section);			// accordionFaq
		//$card 		= strtolower($section).ucfirst($div);		// faqOne
		//$collapse 	= 'collapse'.ucfirst($div);					// collapseOne

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


		$text='';
		for ($x = 1; $x <= 5; $x++) {
			//Log::debug('x = '.Number::spell($x));

			$div		= Number::spell($x);
			$accordion 	= 'accordion'.ucfirst($section);			// accordionFaq
			$card 		= strtolower($section).ucfirst($div);		// faqOne
			$collapse 	= 'collapse'.ucfirst($div);					// collapseOne

			Log::debug('div loop = '.Number::spell($x));
			Log::debug('accordion = '.$accordion);
			Log::debug('card = '.$card);
			Log::debug('collapse = '.$collapse);

			$single='
			<div class="card border mb-3">
				<div class="card-header cursor-pointer" id="'.$card.'" data-bs-toggle="collapse" data-bs-target="#'.$collapse.'" aria-expanded="true" aria-controls="'.$collapse.'">
					<h6 class="mb-0">
						Q: Section '.$section.' : Question Number: '. $div .'
					</h6>
				</div>
				<div id="'.$collapse.'" class="collapse '.($div == 'One' ? 'show' : '').'" aria-labelledby="'.$card.'" data-bs-parent="#'.$accordion.'">
					<div class="card-body py-3">
						A: Section '.$section.' : Answer of Question Number: '.$div .'
					</div>
				</div>
			</div>
			';
			$text = $text . '' . $single;
		}

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
	 * Show the form for creating a new resource.
	 */
	public function ui()
	{
		return view('landlord.manage.ui');
	}
	/**
	 * Show the form for creating a new resource.
	 */
	public function sync()
	{
		SyncLandlord::dispatch();
		return redirect()->route('cps.index')->with('success', 'Sync Job submitted');
	}

	/**
	 * Display a listing of the resource.
	 */
	public function resetAccEndDate()
	{

	}
}
