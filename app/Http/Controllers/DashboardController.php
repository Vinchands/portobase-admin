<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        
        $stats = [
            [
                'name' => 'Projects',
                'count' => Project::where('user_id', $id)->count(),
                'colorClass' => 'bg-info',
                'iconClass' => 'fas fa-folder-open',
            ],
            [
                'name' => 'Published',
                'count' => Project::where('user_id', $id)->where('status', 'public')->count(),
                'colorClass' => 'bg-success',
                'iconClass' => 'fas fa-eye'
            ],
            [
                'name' => 'Drafts',
                'count' => Project::where('user_id', $id)->where('status', 'draft')->count(),
                'colorClass' => 'bg-warning',
                'iconClass' => 'fas fa-file'
            ],
            [
                'name' => 'Categories',
                'count' => Category::where('user_id', $id)->count(),
                'colorClass' => 'bg-danger',
                'iconClass' => 'fas fa-list'
            ]
        ];
        
        return view('auth.dashboard', compact('stats'));
    }
}
