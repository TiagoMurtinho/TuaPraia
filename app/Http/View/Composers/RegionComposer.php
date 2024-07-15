<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Region;

class RegionComposer
{
    public function compose(View $view): void
    {
        $regions = Region::with('districts')->get();
        $view->with('regions', $regions);
    }
}
