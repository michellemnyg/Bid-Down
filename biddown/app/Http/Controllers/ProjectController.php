<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Bid;
use App\Models\Review;
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

    public function update(Request $request, Project $project)
    {
        if ($project->client_id !== Auth::id()) {
            return redirect()->route('dashboardclient')->with('error', 'Akses ditolak.');
        }

        $hasBids = $project->bids()->exists();

        if ($hasBids) {
            $data = $request->validate([
                'bid_deadline' => ['required', 'date', 'after:now'],
            ]);
            $project->update([
                'bid_deadline' => $data['bid_deadline'],
            ]);
            return redirect()->route('projectdetailclient', $project->id)->with('success', 'Batas waktu bidding berhasil diperpanjang.');
        }

        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'bid_deadline' => ['required', 'date', 'after:now'],
            'blind_review' => ['nullable', 'boolean'],
            'auto_stop' => ['nullable', 'boolean'],
            'max_price' => ['required', 'integer', 'min:1'],
        ];

        $data = $request->validate($rules);

        $updateData = [
            'title' => $data['title'],
            'category' => $data['category'],
            'description' => $data['description'],
            'bid_deadline' => $data['bid_deadline'],
            'blind_review' => $request->boolean('blind_review'),
            'auto_stop' => $request->boolean('auto_stop'),
            'max_price' => $data['max_price'],
        ];

        $project->update($updateData);

        return redirect()->route('projectdetailclient', $project->id)->with('success', 'Proyek berhasil diperbarui.');
    }

    public function close(Project $project)
    {
        $project->update(['status' => 'closed']);

        return back()->with('success', 'Bidding proyek ditutup.');
    }

    public function chooseWinner(Project $project, Bid $bid)
    {
        if ($project->client_id !== Auth::id()) {
            return back()->with('error', 'Anda bukan pemilik proyek ini.');
        }

        if ($bid->project_id !== $project->id) {
            return back()->with('error', 'Bid tidak valid untuk proyek ini.');
        }

        $project->update([
            'winner_bid_id' => $bid->id,
            'status' => 'closed',
        ]);

        return back()->with('success', 'Pemenang berhasil dipilih. Proyek sekarang dikunci.');
    }

    public function markCompleted(Request $request, Project $project)
    {
        if ($project->client_id !== Auth::id()) {
            return back()->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        $project->update(['status' => 'completed']);

        if ($project->winnerBid) {
            Review::create([
                'project_id' => $project->id,
                'reviewer_id' => Auth::id(),
                'reviewee_id' => $project->winnerBid->freelancer_id,
                'rating' => $request->rating,
                'message' => $request->review,
            ]);
        }

        return back()->with('success', 'Proyek diselesaikan dan ulasan berhasil dikirim.');
    }

    public function leaveReview(Request $request, Project $project)
    {
        if ($project->status !== 'completed') {
            return back()->with('error', 'Proyek belum selesai.');
        }

        if (!$project->winnerBid || $project->winnerBid->freelancer_id !== Auth::id()) {
            return back()->with('error', 'Akses ditolak.');
        }

        // Cek apakah freelancer sudah pernah mereview
        $exists = Review::where('project_id', $project->id)
            ->where('reviewer_id', Auth::id())
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah memberikan ulasan.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        Review::create([
            'project_id' => $project->id,
            'reviewer_id' => Auth::id(),
            'reviewee_id' => $project->client_id,
            'rating' => $request->rating,
            'message' => $request->review,
        ]);

        return back()->with('success', 'Ulasan berhasil dikirim.');
    }
}
