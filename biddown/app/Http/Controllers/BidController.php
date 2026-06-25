<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $data = $request->validate([
            'amount' => ['required', 'integer', 'min:1', 'max:' . $project->max_price],
            'message' => ['nullable', 'string', 'max:1000'],
        ]);

        $freelancer = Auth::user();

        if (! $freelancer || ! $freelancer->isFreelancer()) {
            return redirect()->route('login')->with('error', 'Silakan masuk sebagai freelancer untuk mengirim bid.');
        }

        if (! $project->isOpen()) {
            return back()->with('error', 'Bidding proyek ini sudah ditutup.');
        }

        $lowestBid = $project->bids()->min('amount');
        if ($lowestBid !== null && $data['amount'] >= $lowestBid) {
            return back()->with('error', 'Bid harus lebih rendah dari bid terendah saat ini.');
        }

        Bid::query()->updateOrCreate([
            'project_id' => $project->id,
            'freelancer_id' => $freelancer->id,
        ], [
            'amount' => $data['amount'],
            'message' => $data['message'] ?? null,
            'status' => 'submitted',
        ]);

        return redirect()->route('dashboardfreelancer')->with('success', 'Bid berhasil dikirim.');
    }
}
