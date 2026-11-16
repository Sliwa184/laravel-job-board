<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function store(Request $request)
    {
        dd('STORE EMPLOYER DZIAŁA');

        // reszta kodu
    }
    public function employerApplications()
    {
        $applications = auth()->user()
            ->employer
            ->applications()
            ->with(['job','candidate'])
            ->latest()
            ->get();

        return view('applications.employer', compact('applications'));
    }
}
