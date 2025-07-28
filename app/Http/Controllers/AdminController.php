<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (Gate::allows('admin-access')) {
            return view('admin.dashboard');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function manageUsers()
    {
        if (Gate::allows('users.manage')) {
            return view('admin.manage_users');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function manageJobs()
    {
        if (Gate::allows('jobs.manage')) {
            return view('admin.manage_jobs');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function manageTasks()
    {
        if (Gate::allows('tasks.manage')) {
            return view('admin.manage_tasks');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function manageInventory()
    {
        if (Gate::allows('inventory.manage')) {
            return view('admin.manage_inventory');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}