<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::getForList();
        return view('admin.applications.index', compact('applications'));
    }

    public function show(Application $application)
    {
        if ($application->status == Application::STATUS_NEW) {
            $application->update(['status' => Application::STATUS_RECEIVED]);
        }
        return view('admin.applications.show', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        if ($request->status > $application->status) {
            $application->update(['status' => $request->status]);
        }
        return redirect()->back()->with(['success' => 'Muvaffaqiyatli saqlandi']);
    }
}
