<?php
namespace App\Http\Controllers;

use App\Diary;

class DiaryController extends Controller
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
        return view('diary.index');
    }

    public function store()
    {
        request()->validate([
            'description' => ['required'],
            'calories' => ['required', 'numeric'],
            'day' => ['required', 'date'],
        ]);

        $diary = Diary::create([
            'user_id' => auth()->id(),
            'description' => request('description'),
            'calories' => request('calories'),
            'day' => request('day'),
        ]);

        if (request()->wantsJson()) {
            return response($diary, 201);
        }

        return redirect('/diary');
    }
}