<p class="card-text">
	/* ======================== {{ $row['fname'] }} ======================================== */</br>
	use App\Http\Controllers\Landlord\{{ $row['fname'] }}Controller;</br>
	Route::resource('{{ strtolower(Str::plural($row['fname']))}}', {{ $row['fname'] }}Controller::class)->middleware(['auth', 'verified']);</br>
	Route::get('/{{ strtolower($row['fname'])}}/export',[{{ $row['fname'] }}Controller::class,'export'])->name('{{ strtolower(Str::plural($row['fname'])) }}.export');</br>
	Route::get('/{{ strtolower(Str::plural($row['fname']))}}/delete/{ {{ strtolower($row['fname']) }} }',[{{ $row['fname'] }}Controller::class,'destroy'])->name('{{ strtolower(Str::plural($row['fname'])) }}.destroy');</br>
</p>