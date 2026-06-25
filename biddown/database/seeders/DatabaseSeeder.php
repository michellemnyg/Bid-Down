<?php

namespace Database\Seeders;

use App\Models\Bid;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. KLIEN
        $client1 = User::query()->updateOrCreate(['email' => 'client@biddown.test'], [
            'name' => 'PT Jaya Abadi',
            'password' => Hash::make('password'),
            'role' => 'client',
            'phone' => '0812-1111-2222',
            'location' => 'Jakarta, Indonesia',
            'bio' => 'Perusahaan ritel yang rutin membutuhkan dukungan teknologi untuk kampanye digital dan operasional bisnis.',
        ]);

        $client2 = User::query()->updateOrCreate(['email' => 'sinar@biddown.test'], [
            'name' => 'Sinar Makmur CV',
            'password' => Hash::make('password'),
            'role' => 'client',
            'phone' => '0812-9999-8888',
            'location' => 'Surabaya, Indonesia',
            'bio' => 'Distributor alat tulis yang sedang melakukan transformasi digital.',
        ]);

        // 2. FREELANCER
        $freelancer1 = User::query()->updateOrCreate(['email' => 'freelancer@biddown.test'], [
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

        $freelancer2 = User::query()->updateOrCreate(['email' => 'maya@biddown.test'], [
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

        $freelancer3 = User::query()->updateOrCreate(['email' => 'budi@biddown.test'], [
            'name' => 'Budi Santoso',
            'password' => Hash::make('password'),
            'role' => 'freelancer',
            'phone' => '0819-7777-8888',
            'job_title' => 'Backend Engineer',
            'location' => 'Semarang, Indonesia',
            'skills' => 'Laravel, Node.js, PostgreSQL, Docker',
            'bio' => 'Spesialis sistem backend dan optimasi database.',
        ]);

        // 3. PORTOFOLIO (Andi)
        Portfolio::query()->updateOrCreate(['user_id' => $freelancer1->id, 'title' => 'Sistem POS Restoran Berbasis Web'], [
            'technology' => 'Vue.js & Laravel',
            'url' => 'https://github.com/andisetiawan/pos-restoran',
            'image_url' => 'https://placehold.co/600x400/f1f3f5/8b5e3c?text=POS+Restoran',
            'description' => 'Aplikasi kasir, inventory, dan laporan harian untuk restoran.',
        ]);

        Portfolio::query()->updateOrCreate(['user_id' => $freelancer1->id, 'title' => 'Aplikasi Kasir Toko Baju'], [
            'technology' => 'React Native',
            'image_url' => 'https://placehold.co/600x400/f1f3f5/8b5e3c?text=Kasir+Mobile',
            'description' => 'Aplikasi mobile untuk transaksi toko dan ringkasan penjualan.',
        ]);

        // 4. PROYEK SELESAI (Untuk memunculkan Review di Profil Andi)
        $projectDone1 = Project::query()->updateOrCreate(['title' => 'Desain Ulang Website Perusahaan', 'client_id' => $client1->id], [
            'category' => 'Web Development',
            'description' => 'Mendesain dan mendevelop ulang profil perusahaan.',
            'max_price' => 5000000,
            'status' => 'completed',
        ]);

        $bidDone1 = Bid::query()->updateOrCreate(['project_id' => $projectDone1->id, 'freelancer_id' => $freelancer1->id], [
            'amount' => 4500000,
            'message' => 'Saya siap mengerjakan dalam 2 minggu.',
            'status' => 'won',
        ]);
        
        $projectDone1->update(['winner_bid_id' => $bidDone1->id]);

        Review::query()->updateOrCreate(['project_id' => $projectDone1->id], [
            'reviewer_id' => $client1->id,
            'reviewee_id' => $freelancer1->id,
            'rating' => 5,
            'message' => 'Andi bekerja sangat cepat dan hasilnya melebihi ekspektasi. Dokumentasi lengkap dan komunikasi sangat baik.',
        ]);

        $projectDone2 = Project::query()->updateOrCreate(['title' => 'Integrasi API Payment Gateway', 'client_id' => $client2->id], [
            'category' => 'Backend Development',
            'description' => 'Menyambungkan sistem internal dengan Midtrans.',
            'max_price' => 3000000,
            'status' => 'completed',
        ]);

        $bidDone2 = Bid::query()->updateOrCreate(['project_id' => $projectDone2->id, 'freelancer_id' => $freelancer1->id], [
            'amount' => 2800000,
            'message' => 'Saya sudah berpengalaman dengan dokumentasi API Midtrans.',
            'status' => 'won',
        ]);
        
        $projectDone2->update(['winner_bid_id' => $bidDone2->id]);

        Review::query()->updateOrCreate(['project_id' => $projectDone2->id], [
            'reviewer_id' => $client2->id,
            'reviewee_id' => $freelancer1->id,
            'rating' => 4,
            'message' => 'Pekerjaan sesuai brief, API berjalan baik, dan komunikasi selama proyek sangat jelas.',
        ]);

        // 5. PROYEK OPEN BID
        $projectOpen1 = Project::query()->updateOrCreate(['title' => 'Pembuatan Landing Page Produk Baru', 'client_id' => $client1->id], [
            'category' => 'Web Development',
            'description' => 'Membuat landing page modern dan responsif untuk peluncuran produk baru. Website harus cepat, mobile-friendly, dan memiliki form kontak.',
            'max_price' => 3000000,
            'bid_deadline' => now()->addDays(3),
            'blind_review' => false, // Dibuat false agar freelancer bisa lihat harga saingan di demo!
            'auto_stop' => false,
            'status' => 'open',
        ]);

        Bid::query()->updateOrCreate(['project_id' => $projectOpen1->id, 'freelancer_id' => $freelancer1->id], [
            'amount' => 2100000,
            'message' => 'Saya bisa menyelesaikan landing page ini dalam 5 hari dengan Bootstrap dan optimasi performa.',
            'status' => 'submitted',
        ]);

        Bid::query()->updateOrCreate(['project_id' => $projectOpen1->id, 'freelancer_id' => $freelancer2->id], [
            'amount' => 1900000,
            'message' => 'Saya fokus pada desain konversi dan pengalaman mobile yang rapi.',
            'status' => 'submitted',
        ]);

        Project::query()->updateOrCreate(['title' => 'Redesign Dashboard Admin Internal', 'client_id' => $client1->id], [
            'category' => 'UI/UX Design',
            'description' => 'Merancang ulang dashboard internal agar lebih mudah dipakai oleh tim operasional.',
            'max_price' => 4500000,
            'bid_deadline' => now()->addDays(5),
            'blind_review' => true,
            'auto_stop' => false,
            'status' => 'open',
        ]);

        Project::query()->updateOrCreate(['title' => 'Aplikasi Pencatatan Stok Barang', 'client_id' => $client2->id], [
            'category' => 'Web Development',
            'description' => 'Membangun aplikasi sederhana untuk mencatat keluar masuk barang di gudang. Harus ada fitur export excel.',
            'max_price' => 6000000,
            'bid_deadline' => now()->addDays(7),
            'blind_review' => false,
            'auto_stop' => false,
            'status' => 'open',
        ]);
    }
}
