@php
	$cname=$row['fname'];
	$object=strtolower($cname);
	$objects=strtolower(Str::plural($object));
@endphp
	
{{-- <p class="card-text">
	/* ======================== Resource:route {{ $row['fname'] }} ======================================== */</br>
	use App\Http\Controllers\Landlord\{{ $row['fname'] }}Controller;</br>
	Route::resource('{{ strtolower(Str::plural($row['fname']))}}', {{ $row['fname'] }}Controller::class)->middleware(['auth', 'verified']);</br>
	Route::get('/{{ strtolower($row['fname'])}}/export',[{{ $row['fname'] }}Controller::class,'export'])->name('{{ strtolower(Str::plural($row['fname'])) }}.export');</br>
	Route::get('/{{ strtolower(Str::plural($row['fname']))}}/delete/{ {{ strtolower($row['fname']) }} }',[{{ $row['fname'] }}Controller::class,'destroy'])->name('{{ strtolower(Str::plural($row['fname'])) }}.destroy');</br>
</p> --}}

<p class="card-text">
	/* ======================== Resource:route : {{ $cname }} ======================================== */</br>
	use App\Http\Controllers\Landlord\{{ $cname }}Controller;</br>
	Route::resource('{{ $objects }}', {{ $cname }}Controller::class)->middleware(['auth', 'verified']);</br>
	Route::get('/{{ $object }}/export',[{{ $cname }}Controller::class,'export'])->name('{{ $objects }}.export');</br>
	Route::get('/{{ $objects }}/delete/&#123;{{ $object }}&#125;',[{{ $cname }}Controller::class,'destroy'])->name('{{ $objects }}.destroy');</br>
</p>

<p class="card-text">
	/* ======================== Individual Route : {{ $cname }} ======================================== */</br>

	Route::controller({{ $cname }}Controller::class)->group(function()</br>
	Route::get('{{ $objects }}', 'index')->name('{{ $objects }}.index');</br>
	Route::post('{{ $objects }}', 'store')->name('{{ $objects }}.store');</br>
	Route::get('{{ $objects }}/create', 'create')->name('{{ $objects }}.create');</br>
	Route::get('{{ $objects }}/&#123;{{ $object }}&#125;', 'show')->name('{{ $objects }}.show');</br>
	Route::put('{{ $objects }}/&#123;{{ $object }}&#125;', 'update')->name('{{ $objects }}.update');</br>
	Route::delete('{{ $objects }}/&#123;{{ $object }}&#125;', 'destroy')->name('{{ $objects }}.destroy');</br>
	Route::get('{{ $objects }}/&#123;{{ $object }}&#125;/edit', 'edit')->name('{{ $objects }}.edit');</br>
	});</br>

</p>