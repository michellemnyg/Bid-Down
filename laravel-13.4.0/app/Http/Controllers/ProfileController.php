<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function updateFreelancer(Request $request)
    {
        $freelancer = Auth::user();

        if (! $freelancer || ! $freelancer->isFreelancer()) {
            return redirect()->route('login')->with('error', 'Silakan masuk sebagai freelancer untuk mengubah profil.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'skills' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'portfolio_url' => ['nullable', 'url', 'max:255'],
        ]);

        $freelancer->update($data);

        return redirect()->route('profilefreelancer')->with('success', 'Profil berhasil diperbarui.');
    }
}
