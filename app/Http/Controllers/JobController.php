<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Tag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $featuredJobs = Job::where('featured', true)
            ->with(['employer', 'tags'])
            ->latest()
            ->paginate(9);

        $jobs = Job::where('featured', false)
            ->with(['employer', 'tags'])
            ->latest()
            ->paginate(3);

        return view('jobs.index', [
            'jobs' => $jobs,
            'featuredJobs' => $featuredJobs,
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'url' => ['required', 'active_url'],
            'tags' => ['nullable'],
        ]);

        $attributes['featured'] = $request->has('featured');

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        if($attributes['tags'] ?? false) {
            foreach(explode(',', $attributes['tags']) as $tag) {
                $job->tag($tag);
            }
        }
        return redirect('/');
    }

    public function edit(Job $job)
    {
        if ($job->employer_id !== auth()->user()->employer->id) {
            abort(403);
        }

        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        if ($job->employer_id !== auth()->user()->employer->id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'salary' => 'required',
            'location' => 'required',
            'schedule' => 'required',
            'url' => 'required|url',
        ]);

        $job->update([
            'title' => $request->title,
            'salary' => $request->salary,
            'location' => $request->location,
            'schedule' => $request->schedule,
            'url' => $request->url,
        ]);

        return redirect('/')
            ->with('success', 'Oferta została zaktualizowana!');
    }

    public function destroy(Job $job)
    {
        if ($job->employer_id !== auth()->user()->employer->id) {
            abort(403);
        }

        $job->delete();

        return redirect('/')
            ->with('success', 'Oferta została usunięta!');
    }
}
