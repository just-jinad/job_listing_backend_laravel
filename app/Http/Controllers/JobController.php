<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'tags' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'benefits' => 'nullable|string',
            'job_requirements' => 'nullable|string',
        ]);

        $job = Job::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'tags' => $request->input('tags'),
            'salary' => $request->input('salary'),
            'benefits' => $request->input('benefits'),
            'job_requirements' => $request->input('job_requirements'),
            'user_id' => Auth::id(),
        ]);

        return response()->json($job, 201);
    }

    public function index()
    {
        $jobs = Job::all();
        // $jobs = Job::where('user_id', Auth::id())->get();
        return response()->json($jobs, 200);
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);
        return response()->json($job, 200);
    }
}
