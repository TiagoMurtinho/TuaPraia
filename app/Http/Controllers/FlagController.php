<?php

namespace App\Http\Controllers;

use App\Events\FlagClicked;
use App\Models\Flag;
use Illuminate\Http\Request;

class FlagController extends Controller
{
    public function click(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'color' => 'required|in:red,green,yellow',
        ]);

        $flag = Flag::where('color', $request->input('color'))->first();

        if (!$flag) {
            return response()->json(['error' => 'Bandeira não encontrada.'], 404);
        }

        $flag->increment('clicks');

        if ($flag->clicks >= 5) {
            $flag->update(['clicks' => 0]);
            broadcast(new FlagClicked($flag->color));
        }

        return response()->json(['clicks' => $flag->clicks]);
    }
}
