<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function create(Job $job)
    {
        // tylko candidate może aplikować
        if (auth()->user()->role !== 'candidate') {
            abort(403);
        }

        return view('applications.create', compact('job'));
    }

    public function store(Request $request, Job $job)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'cv' => 'required|mimes:pdf|max:2048',
        ]);

        $candidate = auth()->user()->candidate;

        if (!$candidate) {
            abort(403);
        }

        if (Application::where('candidate_id', $candidate->id)
            ->where('job_id', $job->id)
            ->exists()) {

            return back()->with('error', 'Już aplikowałeś na tę ofertę.');
        }

        $cvPath = $request->file('cv')->store('cvs', 'public');

        $fullName = $request->first_name . ' ' . $request->last_name;

        Application::create([
            'job_id' => $job->id,
            'candidate_id' => $candidate->id,
            'message' => $fullName,
            'cv' => $cvPath,
            'status' => 'pending',
        ]);

        return redirect('/');
    }
    public function myApplications()
    {
        $candidate = auth()->user()->candidate;

        if (!$candidate) {
            abort(403);
        }

        $applications = $candidate->applications()
            ->with('job')
            ->latest()
            ->get();

        return view('applications.my', compact('applications'));
    }

    public function employerApplications()
    {
        if (auth()->user()->role !== 'employer') {
            abort(403);
        }

        $applications = auth()->user()
            ->employer
            ->applications()
            ->with(['job', 'candidate'])
            ->latest()
            ->get();

        return view('applications.employer', compact('applications'));
    }

    public function updateStatus(Application $application, $status)
    {
        if (auth()->user()->role !== 'employer') {
            abort(403);
        }

        $application->update([
            'status' => $status
        ]);

        return back()->with('success', 'Status aplikacji został zmieniony.');
    }
}
