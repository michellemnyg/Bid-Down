<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'max_price' => ['required', 'integer', 'min:1'],
            'bid_deadline' => ['required', 'date', 'after:now'],
            'blind_review' => ['nullable', 'boolean'],
            'auto_stop' => ['nullable', 'boolean'],
        ]);

        $client = Auth::user();

        if (! $client || ! $client->isClient()) {
            return redirect()->route('login')->with('error', 'Silakan masuk sebagai klien untuk membuat proyek.');
        }

        Project::query()->create([
            'client_id' => $client->id,
            'title' => $data['title'],
            'category' => $data['category'],
            'description' => $data['description'],
            'max_price' => $data['max_price'],
            'bid_deadline' => $data['bid_deadline'],
            'blind_review' => $request->boolean('blind_review'),
            'auto_stop' => $request->boolean('auto_stop'),
            'status' => 'open',
        ]);

        return redirect()->route('dashboardclient')->with('success', 'Proyek berhasil diterbitkan.');
    }

    public function close(Project $project)
    {
        $project->update(['status' => 'closed']);

        return back()->with('success', 'Bidding proyek ditutup.');
    }
}
