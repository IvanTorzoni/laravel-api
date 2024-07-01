<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::with(['type' , 'technologies'])->get();
        $data = [
            'result' => $projects
        ];
        return response()->json($data);
    }
    public function show(string $project) {
        $project = Project::with(['type' , 'technologies'])->where('slug', $project)->first();
        $data = [
            'result' => $project
        ];
        return response()->json($data);
    }
}
