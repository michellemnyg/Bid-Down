<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home()
    {
        return view('index', [
            'latestProjects' => Project::query()->where('status', 'open')->with('lowestBid')->latest()->take(3)->get(),
        ]);
    }

    public function dashboardClient()
    {
        $client = Auth::user();

        $allProjects = Project::query()
            ->withCount('bids')
            ->with('lowestBid', 'winnerBid')
            ->where('client_id', $client->id)
            ->latest()
            ->get();

        $activeProjects = $allProjects->where('status', 'open');
        $historyProjects = $allProjects->whereIn('status', ['closed', 'completed']);
        
        $totalProjects = $allProjects->count();
        $completedProjectsCount = $allProjects->where('status', 'completed')->count();
        $totalSpend = $historyProjects->sum(fn ($p) => $p->winnerBid ? $p->winnerBid->amount : 0);

        return view('dashboardclient', [
            'client' => $client,
            'activeProjects' => $activeProjects,
            'historyProjects' => $historyProjects,
            'totalProjects' => $totalProjects,
            'completedProjectsCount' => $completedProjectsCount,
            'totalSpend' => $totalSpend,
        ]);
    }

    public function dashboardFreelancer()
    {
        $freelancer = Auth::user();

        $myBids = $freelancer->bids()->with('project.client', 'project.lowestBid')->latest()->get();
        
        $activeBids = $myBids->filter(fn ($b) => $b->project && $b->project->status === 'open');
        $contractedBids = $myBids->filter(fn ($b) => $b->project && in_array($b->project->status, ['closed', 'completed']) && $b->project->winner_bid_id === $b->id);
        
        $totalEarnings = $contractedBids->filter(fn ($b) => $b->project->status === 'completed')->sum('amount');
        $successRate = $myBids->count() > 0 ? round(($contractedBids->count() / $myBids->count()) * 100) : 0;
        $completedProjectsCount = $contractedBids->filter(fn ($b) => $b->project->status === 'completed')->count();

        return view('dashboardfreelancer', [
            'freelancer' => $freelancer,
            'activeBids' => $activeBids,
            'contractedProjects' => $contractedBids->pluck('project'),
            'totalEarnings' => $totalEarnings,
            'successRate' => $successRate,
            'completedProjectsCount' => $completedProjectsCount,
        ]);
    }

    public function explore(\Illuminate\Http\Request $request)
    {
        $query = Project::query()->with('client', 'lowestBid')->where('status', 'open');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        return view('explore', [
            'projects' => $query->latest()->get(),
        ]);
    }

    public function makeProject()
    {
        return view('make-project');
    }

    public function editProject(Project $project)
    {
        if ($project->client_id !== Auth::id()) abort(403);

        return view('edit-project', [
            'project' => $project->loadCount('bids'),
        ]);
    }

    public function projectDetailClient(?Project $project = null)
    {
        if (!$project) abort(404);

        return view('projectdetailclient', [
            'project' => $project->load('client', 'bids.freelancer'),
            'projectStatus' => $project->status,
        ]);
    }

    public function projectDetailFreelancer(?Project $project = null)
    {
        if (!$project) abort(404);

        return view('projectdetailfreelancer', [
            'project' => $project->load('client', 'bids.freelancer'),
            'lowestBid' => $project->bids()->orderBy('amount')->first(),
            'projectStatus' => $project->status,
        ]);
    }

    public function profileClient($id = null)
    {
        if ($id) {
            $client = User::where('id', $id)->where('role', 'client')->firstOrFail();
        } else {
            if (Auth::user()->role !== 'client') abort(403);
            $client = Auth::user();
        }

        return view('profileclient', [
            'client' => $client,
        ]);
    }

    public function profileFreelancer($id = null)
    {
        if ($id) {
            $freelancer = User::where('id', $id)->where('role', 'freelancer')->with('portfolios', 'bids.project')->firstOrFail();
        } else {
            if (Auth::user()->role !== 'freelancer') abort(403);
            $freelancer = Auth::user()->load('portfolios', 'bids.project');
        }

        return view('profilefreelancer', [
            'freelancer' => $freelancer,
        ]);
    }

    public function editProfileFreelancer()
    {
        return view('editprofilefreelancer', [
            'freelancer' => Auth::user()->load('portfolios'),
        ]);
    }

    public function editProfileClient()
    {
        return view('editprofileclient', [
            'client' => Auth::user(),
        ]);
    }
}
