<?php

namespace Database\Seeders;

use App\Models\Bid;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $client = User::query()->updateOrCreate([
            'email' => 'client@biddown.test',
        ], [
            'name' => 'PT Jaya Abadi',
            'password' => Hash::make('password'),
            'role' => 'client',
            'phone' => '0812-1111-2222',
            'location' => 'Jakarta, Indonesia',
            'bio' => 'Perusahaan ritel yang rutin membutuhkan dukungan teknologi untuk kampanye digital dan operasional bisnis.',
        ]);

        $freelancer = User::query()->updateOrCreate([
            'email' => 'freelancer@biddown.test',
        ], [
            'name' => 'Andi Setiawan',
            'password' => Hash::make('password'),
            'role' => 'freelancer',
            'phone' => '0813-3333-4444',
            'job_title' => 'Web & App Developer',
            'location' => 'Yogyakarta, Indonesia',
            'skills' => 'React, Laravel, Vue.js, REST API, UI/UX Implementation',
            'portfolio_url' => 'https://github.com/andisetiawan',
            'bio' => 'Developer full-stack dengan fokus pada web bisnis, dashboard, dan integrasi API.',
        ]);

        $secondFreelancer = User::query()->updateOrCreate([
            'email' => 'maya@biddown.test',
        ], [
            'name' => 'Maya Putri',
            'password' => Hash::make('password'),
            'role' => 'freelancer',
            'phone' => '0815-5555-6666',
            'job_title' => 'UI/UX Designer',
            'location' => 'Bandung, Indonesia',
            'skills' => 'Figma, Design System, Landing Page, UX Research',
            'portfolio_url' => 'https://dribbble.com/mayaputri',
            'bio' => 'Desainer produk digital yang terbiasa membuat landing page dan dashboard yang mudah dipakai.',
        ]);

        Portfolio::query()->updateOrCreate([
            'user_id' => $freelancer->id,
            'title' => 'Sistem POS Restoran Berbasis Web',
        ], [
            'technology' => 'Vue.js & Laravel',
            'url' => 'https://github.com/andisetiawan/pos-restoran',
            'image_url' => 'https://placehold.co/600x400/f1f3f5/8b5e3c?text=POS+Restoran',
            'description' => 'Aplikasi kasir, inventory, dan laporan harian untuk restoran.',
        ]);

        Portfolio::query()->updateOrCreate([
            'user_id' => $freelancer->id,
            'title' => 'Aplikasi Kasir Toko Baju',
        ], [
            'technology' => 'React Native',
            'image_url' => 'https://placehold.co/600x400/f1f3f5/8b5e3c?text=Kasir+Mobile',
            'description' => 'Aplikasi mobile untuk transaksi toko dan ringkasan penjualan.',
        ]);

        $project = Project::query()->updateOrCreate([
            'title' => 'Pembuatan Landing Page Produk Baru',
            'client_id' => $client->id,
        ], [
            'category' => 'Web Development',
            'description' => 'Membuat landing page modern dan responsif untuk peluncuran produk baru. Website harus cepat, mobile-friendly, dan memiliki form kontak.',
            'max_price' => 3000000,
            'bid_deadline' => now()->addDays(3),
            'blind_review' => true,
            'auto_stop' => false,
            'status' => 'open',
        ]);

        Project::query()->updateOrCreate([
            'title' => 'Redesign Dashboard Admin Internal',
            'client_id' => $client->id,
        ], [
            'category' => 'UI/UX Design',
            'description' => 'Merancang ulang dashboard internal agar lebih mudah dipakai oleh tim operasional.',
            'max_price' => 4500000,
            'bid_deadline' => now()->addDays(5),
            'blind_review' => true,
            'auto_stop' => false,
            'status' => 'open',
        ]);

        Bid::query()->updateOrCreate([
            'project_id' => $project->id,
            'freelancer_id' => $freelancer->id,
        ], [
            'amount' => 2100000,
            'message' => 'Saya bisa menyelesaikan landing page ini dalam 5 hari dengan Bootstrap dan optimasi performa.',
            'status' => 'submitted',
        ]);

        Bid::query()->updateOrCreate([
            'project_id' => $project->id,
            'freelancer_id' => $secondFreelancer->id,
        ], [
            'amount' => 2350000,
            'message' => 'Saya fokus pada desain konversi dan pengalaman mobile yang rapi.',
            'status' => 'submitted',
        ]);
    }
}
