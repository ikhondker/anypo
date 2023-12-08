<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

# Models
# Enums
# Helpers
use App\Helpers\EventLog;
# Notifications
# Mails
# Packages
# Seeded
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

# Exceptions
# Events

class FileAccessController extends Controller
{
    // Used to display logo from private folder. Filename is needed as it can be jpg or png or gif
    public function logo($filename)
    {

        //Log::debug('fileName='.$filename);

        //shown as: http://geda.localhost:8000/setups/image/logo.png
        $path = storage_path('app/logo/'. $filename);
        //Log::debug('path= '. $path);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;

    }

    // Used to display avatar from private folder
    public function avatarxx($filename)
    {
        //Log::debug('avatar fileName='.$filename);

        //shown as: http://geda.localhost:8000/setups/image/logo.png
        $path = storage_path('app/avatar/'. $filename);
        //Log::debug('path= '. $path);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
