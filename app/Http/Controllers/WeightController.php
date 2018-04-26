<?php

namespace App\Http\Controllers;

use App\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeightController extends Controller
{
    public function index()
    {
        $weights = Weight::all()
            ->sortByDesc('created_at')
            ->where('user_id', auth()->id());

        return view('weight.index', compact('weights'));
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

    public function graphData()
    {
        $data = Weight::select(DB::raw('DATE_FORMAT(created_at, "%d.%m.%Y") day, weight'))
            ->orderBy('created_at')
            ->where('user_id', auth()->id())
            ->get()
            ->pluck('weight', 'day');

        return $data;
    }
}
