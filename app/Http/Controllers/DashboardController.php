<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            [
                'name' => 'Projects',
                'count' => Auth::user()->projects()->count(),
                'colorClass' => 'bg-info',
                'iconClass' => 'fas fa-folder-open',
            ],
            [
                'name' => 'Published',
                'count' => Auth::user()->projects()->where('status', 'public')->count(),
                'colorClass' => 'bg-success',
                'iconClass' => 'fas fa-globe'
            ],
            [
                'name' => 'Tags',
                'count' => Auth::user()->tags()->count(),
                'colorClass' => 'bg-warning',
                'iconClass' => 'fas fa-code'
            ],
            [
                'name' => 'Categories',
                'count' => Auth::user()->categories()->count(),
                'colorClass' => 'bg-danger',
                'iconClass' => 'fas fa-list'
            ]
        ];
        
        return view('auth.dashboard', compact('stats'));
    }
}
