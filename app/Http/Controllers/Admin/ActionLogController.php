<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActionLog;

class ActionLogController extends Controller
{
    public function index()
    {
        $logs = ActionLog::latest()->paginate(20);
        return view('admin.logs.index', compact('logs'));
    }
}
