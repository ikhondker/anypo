<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;

# Models
# Enums
# Helpers
use App\Helpers\Export;
use App\Helpers\EventLog;
# Notifications
# Mails
# Packages
# Seeded
use Illuminate\Support\Facades\Log;
use DB;

# Exceptions
# Events


class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::query();
        if (request('term')) {
            $countries->where('name', 'Like', '%'.request('term').'%');
        }
        $countries = $countries->orderBy('enable', 'DESC')->orderBy('country', 'ASC')->paginate(25);

        return view('tenant.countries.index', compact('countries'))->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Country::class);

        return view('tenant.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryRequest $request)
    {
        $this->authorize('create', Country::class);
        $country = Country::create($request->all());
        // Write to Log
        EventLog::event('country', $country->country, 'create');

        return redirect()->route('countries.index')->with('success', 'Country created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        $this->authorize('update', $country);

        return view('tenant.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $this->authorize('update', $country);

        //$request->validate();
        $request->validate([
        ]);
        $country->update($request->all());

        // Write to Log
        EventLog::event('country', $country->name, 'update', 'name', $request->name);

        return redirect()->route('countries.index')->with('success', 'Country information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {

        //$this->authorize('delete', $color);
        $country->fill(['enable' => ! $country->enable]);
        $country->update();

        // Write to Log
        EventLog::event('country', $country->country, 'update', 'enable', $country->enable);

        return redirect()->route('countries.index')->with('success', 'Country status Updated successfully.');
    }

    public function export()
    {
        $data = DB::select("SELECT country, name, IF(enable, 'Yes', 'No') AS enable 
        FROM countries");
        $dataArray = json_decode(json_encode($data), true);
        // used Export Helper

        return Export::csv('countries', $dataArray);
    }
}
