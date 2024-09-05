<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Local;
use App\Models\Region;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
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

    public function autocomplete(Request $request): JsonResponse
    {
        $search = $request->get('query');
        $locals = Local::where('name', 'LIKE', "%$search%")->get();

        return response()->json($locals);
    }

    public function searchResults(Request $request): Factory|View|Application
    {
        $query = $request->input('query');
        $locals = Local::where('name', 'LIKE', "%$query%")->get();

        return view('pages.views.results.search-results', compact('locals', 'query'));
    }

    public function filterResults(Request $request): Factory|View|Application
    {
        $regionId = $request->route('regionId');
        $districtId = $request->route('districtId');

        $query = $request->input('query', '');
        $filters = $request->input('filters', []);

        Log::info('Region ID: ' . $regionId);
        Log::info('District ID: ' . $districtId);
        Log::info('Query: ' . $query);
        Log::info('Filters: ', $filters);

        $localsQuery = Local::query()
            ->where('name', 'LIKE', '%' . $query . '%');

        if (!empty($filters)) {
            $localsQuery->whereHas('attributes', function ($query) use ($filters) {
                $query->whereIn('name', $filters);
            }, '=', count($filters));
        }

        if ($districtId) {
            $localsQuery->where('districts_id', $districtId);
        } elseif ($regionId) {
            $localsQuery->where('regions_id', $regionId);
        }

        $locals = $localsQuery->distinct()->get();

        Log::info('Número de locais encontrados: ' . $locals->count());

        if ($districtId) {
            $district = District::with(['locals' => function ($query) use ($locals) {
                $query->whereIn('id', $locals->pluck('id'));
            }])->findOrFail($districtId);

            return view('pages.views.districts.districts', [
                'district' => $district,
                'districtId' => $districtId,
                'locals' => $locals,
                'filters' => $filters
            ]);
        }

        if ($regionId) {
            $region = Region::with(['districts.locals' => function ($query) use ($locals) {
                $query->whereIn('id', $locals->pluck('id'));
            }])->findOrFail($regionId);

            return view('pages.views.regions.regions', [
                'region' => $region,
                'regionId' => $regionId,
                'locals' => $locals,
                'filters' => $filters
            ]);
        }

        return view('pages.views.results.search-results', compact('locals', 'query'));
    }
}
