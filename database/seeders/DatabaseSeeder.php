<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ================= ADMIN USER =================
        $admin = User::create([
            'name'     => 'Admin Perpustakaan',
            'email'    => 'admin@perpustakaan.com',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        // ================= MEMBER USER =================
        $memberUser = User::create([
            'name'     => 'Putri Anggota',
            'email'    => 'putri@perpustakaan.com',
            'password' => bcrypt('password'),
            'role'     => 'member',
        ]);

        // ================= MEMBER PROFILE =================
        Member::create([
            'user_id'       => $memberUser->id,
            'nama'          => 'Putri Anggota',
            'nim_nip'       => '2024001',
            'jenis_kelamin' => 'P',
            'alamat'        => 'Jl. Perpustakaan No. 1',
            'no_hp'         => '081234567890',
        ]);

        // ================= CATEGORIES =================
        $fiksi     = Category::create(['nama_kategori' => 'Fiksi']);
        $sains     = Category::create(['nama_kategori' => 'Sains']);
        $teknologi = Category::create(['nama_kategori' => 'Teknologi']);
        $sejarah   = Category::create(['nama_kategori' => 'Sejarah']);
        $agama     = Category::create(['nama_kategori' => 'Agama']);

        // ================= BOOKS (using existing covers) =================
        $covers = [
            'cover-buku/01KR3CB65DPJBRX3ESHZTDJ4P0.jpeg',
            'cover-buku/01KR3CNDZQFK0Y6V0WWB3NDTKN.jpeg',
            'cover-buku/01KR5H0M500DHD3E5YRR8VV963.png',
            'cover-buku/01KR5H7XEATTM94RHGWAC12619.jpg',
            'cover-buku/01KR5HMXTRQ700EDGACTC81Q21.jpeg',
            'cover-buku/01KR5HS4QYDYX8V18374S5MHDB.jpeg',
            'cover-buku/01KR5HXYJ6YCPD4XRE1BB13P3B.jpeg',
        ];

        Book::create([
            'category_id'  => $fiksi->id,
            'kode_buku'    => 'FIK-001',
            'judul'        => 'Laskar Pelangi',
            'penulis'      => 'Andrea Hirata',
            'penerbit'     => 'Bentang Pustaka',
            'tahun_terbit' => 2005,
            'stok'         => 5,
            'cover'        => $covers[0],
        ]);

        Book::create([
            'category_id'  => $fiksi->id,
            'kode_buku'    => 'FIK-002',
            'judul'        => 'Bumi Manusia',
            'penulis'      => 'Pramoedya Ananta Toer',
            'penerbit'     => 'Hasta Mitra',
            'tahun_terbit' => 1980,
            'stok'         => 3,
            'cover'        => $covers[1],
        ]);

        Book::create([
            'category_id'  => $sains->id,
            'kode_buku'    => 'SAI-001',
            'judul'        => 'A Brief History of Time',
            'penulis'      => 'Stephen Hawking',
            'penerbit'     => 'Bantam Books',
            'tahun_terbit' => 1988,
            'stok'         => 4,
            'cover'        => $covers[2],
        ]);

        Book::create([
            'category_id'  => $teknologi->id,
            'kode_buku'    => 'TEK-001',
            'judul'        => 'Clean Code',
            'penulis'      => 'Robert C. Martin',
            'penerbit'     => 'Prentice Hall',
            'tahun_terbit' => 2008,
            'stok'         => 6,
            'cover'        => $covers[3],
        ]);

        Book::create([
            'category_id'  => $teknologi->id,
            'kode_buku'    => 'TEK-002',
            'judul'        => 'Laravel Up & Running',
            'penulis'      => 'Matt Stauffer',
            'penerbit'     => 'O\'Reilly Media',
            'tahun_terbit' => 2019,
            'stok'         => 3,
            'cover'        => $covers[4],
        ]);

        Book::create([
            'category_id'  => $sejarah->id,
            'kode_buku'    => 'SEJ-001',
            'judul'        => 'Sejarah Indonesia Modern',
            'penulis'      => 'M.C. Ricklefs',
            'penerbit'     => 'Gadjah Mada University Press',
            'tahun_terbit' => 2008,
            'stok'         => 2,
            'cover'        => $covers[5],
        ]);

        Book::create([
            'category_id'  => $agama->id,
            'kode_buku'    => 'AGM-001',
            'judul'        => 'Tafsir Al-Misbah',
            'penulis'      => 'M. Quraish Shihab',
            'penerbit'     => 'Lentera Hati',
            'tahun_terbit' => 2002,
            'stok'         => 4,
            'cover'        => $covers[6],
        ]);
    }
}
