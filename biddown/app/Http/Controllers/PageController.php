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
            'latestProjects' => Project::query()->with('lowestBid')->latest()->take(3)->get(),
        ]);
    }

    public function dashboardClient()
    {
        $client = Auth::user()?->isClient()
            ? Auth::user()
            : User::query()->where('role', 'client')->first();

        return view('dashboardclient', [
            'projects' => Project::query()
                ->withCount('bids')
                ->with('lowestBid')
                ->when($client, fn ($query) => $query->where('client_id', $client->id))
                ->latest()
                ->get(),
            'client' => $client,
        ]);
    }

    public function dashboardFreelancer()
    {
        return view('dashboardfreelancer', [
            'projects' => Project::query()->with('client', 'lowestBid')->latest()->take(8)->get(),
            'myBids' => Auth::user()?->bids()->with('project')->latest()->get() ?? collect(),
        ]);
    }

    public function explore()
    {
        return view('explore', [
            'projects' => Project::query()->with('client', 'lowestBid')->where('status', 'open')->latest()->get(),
        ]);
    }

    public function makeProject()
    {
        return view('make-project');
    }

    public function editProject()
    {
        return view('edit-project');
    }

    public function projectDetailClient(?Project $project = null)
    {
        $project ??= Project::query()->with('client', 'bids.freelancer')->firstOrFail();

        return view('projectdetailclient', [
            'project' => $project->load('client', 'bids.freelancer'),
        ]);
    }

    public function projectDetailFreelancer(?Project $project = null)
    {
        $project ??= Project::query()->with('client', 'bids.freelancer')->firstOrFail();

        return view('projectdetailfreelancer', [
            'project' => $project->load('client', 'bids.freelancer'),
            'lowestBid' => $project->bids()->orderBy('amount')->first(),
        ]);
    }

    public function profileClient()
    {
        return view('profileclient', [
            'client' => User::query()->where('role', 'client')->first(),
        ]);
    }

    public function profileFreelancer()
    {
        $freelancer = Auth::user()?->isFreelancer()
            ? Auth::user()
            : User::query()->where('role', 'freelancer')->with('portfolios')->first();

        return view('profilefreelancer', [
            'freelancer' => $freelancer?->load('portfolios', 'bids.project'),
        ]);
    }

    public function editProfileFreelancer()
    {
        $freelancer = Auth::user()?->isFreelancer()
            ? Auth::user()
            : User::query()->where('role', 'freelancer')->first();

        return view('editprofilefreelancer', [
            'freelancer' => $freelancer?->load('portfolios'),
        ]);
    }

    public function editProfileClient()
    {
        $client = Auth::user()?->isClient()
            ? Auth::user()
            : User::query()->where('role', 'client')->first();

        return view('editprofileclient', [
            'client' => $client,
        ]);
    }
}
