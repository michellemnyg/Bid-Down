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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$freelancer->id],
            'phone' => ['required', 'string', 'max:20', 'unique:users,phone,'.$freelancer->id],
            'job_title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'skills' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'portfolio_url' => ['nullable', 'url', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar_url'] = '/storage/' . $path;
        }

        $freelancer->update($data);

        // Handle portfolios
        $freelancer->portfolios()->delete();
        if ($request->has('portfolios') && is_array($request->portfolios)) {
            foreach ($request->portfolios as $portfolioData) {
                if (!empty($portfolioData['title']) && !empty($portfolioData['technology']) && !empty($portfolioData['url'])) {
                    $freelancer->portfolios()->create([
                        'title' => $portfolioData['title'],
                        'technology' => $portfolioData['technology'],
                        'url' => $portfolioData['url'],
                    ]);
                }
            }
        }

        return redirect()->route('profilefreelancer')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updateClient(Request $request)
    {
        $client = Auth::user();

        if (! $client || ! $client->isClient()) {
            return redirect()->route('login')->with('error', 'Silakan masuk sebagai klien untuk mengubah profil.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$client->id],
            'phone' => ['required', 'string', 'max:20', 'unique:users,phone,'.$client->id],
            'location' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'portfolio_url' => ['nullable', 'url', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar_url'] = '/storage/' . $path;
        }

        $client->update($data);

        return redirect()->route('profileclient')->with('success', 'Profil berhasil diperbarui.');
    }
}
