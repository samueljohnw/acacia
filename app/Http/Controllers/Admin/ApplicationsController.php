<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApplicationsController extends Controller
{
    


    public function index()
    {
    	$applications = \App\Application::all();
    	return view('admin.applications.index',compact('applications'));
    }

    public function show($id)
    {
    	$application = \App\Application::find($id)->toArray();
    	return view('admin.applications.show',compact('application'));
    }
}
