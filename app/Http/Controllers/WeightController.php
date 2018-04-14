<?php

namespace App\Http\Controllers;

use App\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    public function index()
    {
        $weights = Weight::all()
            ->sortBy('created_at')
            ->where('user_id', auth()->id());

        $graphData = $weights->pluck('weight', 'created_at');
        $weights = $weights->sortByDesc('created_at');

        return view('weight.index', compact('weights', 'graphData'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'weight' => ['required', 'numeric'],
            'created_at' => ['required', 'date'],
        ]);

        $createdAt = Carbon::parse($request->get('created_at'))->toDateTimeString();

        Weight::create([
            'user_id' => auth()->id(),
            'weight' => $request->get('weight'),
            'created_at' => $createdAt,
        ]);

        return back();
    }
}
