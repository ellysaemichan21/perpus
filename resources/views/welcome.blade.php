@php
    use Illuminate\Support\Facades\Storage;
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library — Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Outfit', sans-serif; }
        html { scroll-behavior: smooth; font-size: 18px; } /* Increased base font size for visibility */

        body {
            background-color: #ffffff;
            color: #1e293b;
            line-height: 1.6;
        }

        .hero-section {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-bottom: 1px solid #e2e8f0;
        }

        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .card-shadow:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: translateY(-4px);
        }

        .btn-primary {
            background-color: #4f46e5; /* Indigo - Professional and neutral */
            color: white;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: #4338ca;
            transform: translateY(-2px);
        }

        .text-huge {
            font-size: 3rem;
            line-height: 1.2;
            font-weight: 800;
        }

        .nav-link {
            color: #64748b;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: #4f46e5;
        }

        .input-focus:focus {
            border-color: #4f46e5;
            ring: 2px solid #c7d2fe;
        }
        
        .tab-btn {
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            transition: all 0.2s;
            border: 1px solid #e2e8f0;
        }

        .tab-active {
            background-color: #4f46e5;
            color: white;
            border-color: #4f46e5;
        }
    </style>
</head>

<body>

<!-- ================= NAVBAR ================= -->
<nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <a href="/library" class="flex items-center gap-3">
            <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo" class="w-12 h-12 rounded-lg border-2 border-indigo-600 object-cover shadow-sm">
            <div>
                <span class="text-2xl font-black text-slate-900 tracking-tight">E-Library</span>
                <span class="text-xs text-indigo-600 font-bold block -mt-1 uppercase tracking-widest">Digital Archive</span>
            </div>
        </a>

        <!-- Center Nav -->
        <div class="hidden md:flex gap-10 text-base">
            <a href="#home" class="nav-link text-indigo-600 font-bold">Beranda</a>
            <a href="#books" class="nav-link">Katalog Buku</a>
            <a href="#about" class="nav-link">Tentang Kami</a>
        </div>

        <!-- Right -->
        <div class="flex items-center gap-4">
            @auth
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 bg-slate-100 px-4 py-2 rounded-xl hover:bg-slate-200 transition">
                    <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="hidden lg:block text-left">
                        <p class="text-sm font-bold text-slate-900 leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-slate-500 font-medium">Dashboard Member</p>
                    </div>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-slate-600 font-bold hover:text-indigo-600 transition">Masuk</a>
                <a href="{{ route('register') }}" class="btn-primary px-6 py-3 rounded-2xl font-bold shadow-lg shadow-indigo-200">
                    Daftar Akun
                </a>
            @endauth
        </div>

    </div>
</nav>

<!-- ================= HERO ================= -->
<section id="home" class="hero-section py-20 lg:py-32 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
        
        <div>
            <div class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold mb-6">
                ✨ Perpustakaan Digital Inklusif
            </div>
            <h1 class="text-huge text-slate-900 mb-8">
                Jendela Ilmu Untuk <span class="text-indigo-600">Semua Generasi</span>
            </h1>
            <p class="text-xl text-slate-600 mb-10 leading-relaxed max-w-xl">
                Temukan ribuan koleksi buku favorit Anda dengan tampilan yang bersih, mudah dibaca, dan nyaman untuk segala usia.
            </p>

            <!-- Search Bar -->
            <div class="bg-white rounded-3xl p-2 shadow-2xl flex items-center border border-slate-200 max-w-xl">
                <i class="fas fa-search text-slate-400 ml-5 mr-3 text-lg"></i>
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Cari judul, penulis, atau penerbit..."
                    class="flex-1 bg-transparent text-slate-900 py-4 focus:outline-none placeholder:text-slate-400 text-lg"
                >
                <button onclick="scrollToBooks()" class="btn-primary px-8 py-4 rounded-2xl font-bold text-lg cursor-pointer">
                    Cari
                </button>
            </div>
        </div>

        <div class="hidden lg:block relative">
            <div class="absolute -top-10 -right-10 w-64 h-64 bg-indigo-200/50 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-amber-200/50 rounded-full blur-3xl"></div>
            <img src="{{ asset('storage/background/buku.jpg') }}" alt="Library Illustration" class="relative z-10 w-full h-[500px] object-cover rounded-[40px] shadow-2xl border-8 border-white">
        </div>

    </div>
</section>

<!-- ================= FLASH MESSAGES ================= -->
<div class="max-w-7xl mx-auto px-6 mt-8">
    @if (session('success'))
        <div class="bg-emerald-50 border-2 border-emerald-200 text-emerald-800 p-5 rounded-3xl flex items-center gap-4 animate-bounce">
            <i class="fas fa-check-circle text-2xl"></i>
            <span class="font-bold text-lg">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-rose-50 border-2 border-rose-200 text-rose-800 p-5 rounded-3xl flex items-center gap-4">
            <i class="fas fa-exclamation-circle text-2xl"></i>
            <span class="font-bold text-lg">{{ session('error') }}</span>
        </div>
    @endif
</div>

<!-- ================= BOOK SECTION ================= -->
<section id="books" class="py-24 px-6 bg-white">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div>
                <h2 class="text-4xl font-black text-slate-900 mb-4">Katalog Koleksi</h2>
                <p class="text-xl text-slate-500">Pilih kategori yang Anda minati di bawah ini</p>
            </div>
            
            <!-- Category Filter -->
            <div class="flex flex-wrap gap-3">
                <button class="tab-btn tab-active text-lg cursor-pointer" data-category="all">Semua</button>
                @foreach ($categories as $category)
                    <button class="tab-btn bg-slate-50 text-slate-600 hover:border-indigo-400 text-lg cursor-pointer" data-category="{{ $category->id }}">
                        {{ $category->nama_kategori }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Book Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10" id="bookGrid">

            @forelse ($books as $book)
                <div
                    class="book-card card-shadow bg-white rounded-[32px] overflow-hidden border border-slate-100"
                    data-category="{{ $book->category_id }}"
                    data-title="{{ strtolower($book->judul) }}"
                    data-author="{{ strtolower($book->penulis) }}"
                    data-publisher="{{ strtolower($book->penerbit) }}"
                >
                    <!-- Cover -->
                    <div class="relative h-[340px]">
                        <img
                            src="{{ $book->cover ? asset('storage/' . $book->cover) : asset('storage/default-book.png') }}"
                            alt="{{ $book->judul }}"
                            class="w-full h-full object-cover"
                        >
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-indigo-600 shadow-sm border border-indigo-100">
                            {{ $book->kode_buku }}
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="p-8">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>
                            <span class="text-sm font-bold text-indigo-500 uppercase tracking-widest">
                                {{ $book->category->nama_kategori ?? 'Lainnya' }}
                            </span>
                        </div>
                        <h3 class="text-2xl font-extrabold text-slate-900 mb-2 leading-tight">{{ $book->judul }}</h3>
                        <p class="text-lg text-slate-500 font-medium mb-6 italic">{{ $book->penulis }}</p>

                        <div class="pt-6 border-t border-slate-100 flex items-center justify-between gap-4">
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase">Status Stok</p>
                                <p class="text-lg font-black {{ $book->stok > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ $book->stok > 0 ? $book->stok . ' Tersedia' : 'Habis' }}
                                </p>
                            </div>

                            @if($book->stok > 0)
                                <form action="{{ route('pinjam.buku', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-primary w-14 h-14 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200 cursor-pointer text-xl">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-slate-50 rounded-[40px]">
                    <i class="fas fa-book-open text-6xl text-slate-200 mb-6"></i>
                    <h3 class="text-2xl font-bold text-slate-400">Belum ada koleksi buku</h3>
                </div>
            @endforelse

        </div>

    </div>
</section>

<!-- ================= ABOUT ================= -->
<section id="about" class="py-24 px-6 bg-slate-50">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-4xl font-black text-slate-900 mb-8">Informasi Perpustakaan</h2>
        <p class="text-2xl text-slate-600 leading-relaxed font-medium">
            Kami berkomitmen menyediakan akses literasi yang nyaman bagi seluruh lapisan masyarakat. Dengan sistem digital yang sederhana, siapa pun dapat dengan mudah meminjam dan mengelola koleksi buku kami.
        </p>
        
        <div class="grid md:grid-cols-3 gap-8 mt-16">
            <div class="p-8 bg-white rounded-3xl shadow-sm">
                <i class="fas fa-universal-access text-4xl text-indigo-600 mb-4"></i>
                <h4 class="font-bold text-lg mb-2">Akses Mudah</h4>
                <p class="text-slate-500 text-sm">Tampilan ramah untuk lansia & anak-anak.</p>
            </div>
            <div class="p-8 bg-white rounded-3xl shadow-sm">
                <i class="fas fa-shield-alt text-4xl text-indigo-600 mb-4"></i>
                <h4 class="font-bold text-lg mb-2">Aman & Terpercaya</h4>
                <p class="text-slate-500 text-sm">Data anggota terjaga dengan aman.</p>
            </div>
            <div class="p-8 bg-white rounded-3xl shadow-sm">
                <i class="fas fa-bolt text-4xl text-indigo-600 mb-4"></i>
                <h4 class="font-bold text-lg mb-2">Proses Cepat</h4>
                <p class="text-slate-500 text-sm">Peminjaman hanya butuh beberapa klik.</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-white border-t border-slate-200 py-12 px-6">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-10">
        <div>
            <span class="text-2xl font-black text-slate-900">E-Library</span>
            <p class="text-slate-500 mt-2">© 2026 Hak Cipta Dilindungi Undang-Undang.</p>
        </div>
        
        <div class="flex gap-10">
            <a href="#" class="text-slate-400 hover:text-indigo-600 transition text-2xl"><i class="fab fa-facebook"></i></a>
            <a href="#" class="text-slate-400 hover:text-indigo-600 transition text-2xl"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-slate-400 hover:text-indigo-600 transition text-2xl"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>
</footer>

<script>
// ================= SEARCH =================
const searchInput = document.getElementById('searchInput');
const bookCards = document.querySelectorAll('.book-card');

searchInput.addEventListener('input', function() {
    const q = this.value.toLowerCase();
    bookCards.forEach(card => {
        const text = card.dataset.title + card.dataset.author + card.dataset.publisher;
        card.style.display = text.includes(q) ? 'block' : 'none';
    });
});

// ================= FILTER =================
const tabBtns = document.querySelectorAll('.tab-btn');
tabBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        tabBtns.forEach(b => b.classList.remove('tab-active'));
        this.classList.add('tab-active');
        
        const cat = this.dataset.category;
        bookCards.forEach(card => {
            if(cat === 'all' || card.dataset.category === cat) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});

function scrollToBooks() {
    document.getElementById('books').scrollIntoView({ behavior: 'smooth' });
}
</script>

</body>
</html>