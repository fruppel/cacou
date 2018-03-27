<?php

namespace App\Http\Controllers;

use App\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    public function index()
    {
        return view('weight.index');
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
