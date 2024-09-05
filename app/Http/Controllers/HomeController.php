<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        // Obtém todos os locais e filtra por tipo e atributo
        $blueFlag = Local::where('type', 'beach')
            ->whereHas('attributes', function($query) {
                $query->where('attributes.id', 6);
            })->get();

        $zeroPollution = Local::where('type', 'beach')
            ->whereHas('attributes', function($query) {
                $query->where('attributes.id', 10);
            })->get();

        $orQuality = Local::where('type', 'beach')
            ->whereHas('attributes', function($query) {
                $query->where('attributes.id', 11);
            })->get();

        return view('home', [
            'blueFlag' => $blueFlag,
            'zeroPollution' => $zeroPollution,
            'orQuality' => $orQuality,
        ]);
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
