<?php

namespace App\Http\Controllers;

use App\User;
use App\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class WeightController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    /**
     * Destroys a weight entry
     *
     * @param User $user
     * @param Weight $weight
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy(User $user, Weight $weight)
    {
        $this->authorize('update', $weight);

        $weight->delete();

        return response(['status' => 'Reply deleted']);
    }

    /**
     * Returns the graph data for the weight chart
     *
     * @param Weight $model Weight model
     *
     * @return Response
     */
    public function graphData(Weight $model): Response
    {
        return response($model->getGraphData(), 200);
    }
}
