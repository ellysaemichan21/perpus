<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member — E-Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Outfit', sans-serif; }
        html { font-size: 18px; }
        body { background-color: #f8fafc; color: #1e293b; }
        
        .sidebar-link {
            transition: all 0.2s;
            border-radius: 1rem;
            color: #64748b;
            font-weight: 600;
        }
        
        .sidebar-link.active {
            background-color: #4f46e5;
            color: white;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.2);
        }
        
        .card {
            background: white;
            border-radius: 2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .stat-card {
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .btn-action {
            background-color: #4f46e5;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 1rem;
            font-weight: 700;
            transition: all 0.2s;
        }

        .btn-action:hover {
            background-color: #4338ca;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }
    </style>
</head>

<body class="min-h-screen">

<div class="flex flex-col lg:flex-row min-h-screen">

    <!-- ================= SIDEBAR ================= -->
    <aside class="w-full lg:w-80 bg-white border-r border-slate-200 p-8 flex flex-col gap-10">
        <!-- Logo -->
        <a href="/library" class="flex items-center gap-3">
            <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo" class="w-10 h-10 rounded-lg border-2 border-indigo-600 object-cover">
            <span class="text-2xl font-black text-slate-900 tracking-tight">E-Library</span>
        </a>

        <!-- User Info -->
        <div class="bg-indigo-50 p-6 rounded-[2rem] border border-indigo-100">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center text-white text-xl font-black shadow-lg">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-black text-slate-900 leading-none">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-indigo-600 font-bold mt-1">Member Aktif</p>
                </div>
            </div>
            <div class="space-y-1">
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">ID Anggota</p>
                <p class="text-sm font-black text-slate-700">{{ auth()->user()->member->nim_nip }}</p>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex flex-col gap-2">
            <a href="{{ route('dashboard') }}" class="sidebar-link active flex items-center gap-4 px-6 py-4">
                <i class="fas fa-th-large text-lg"></i>
                <span>Ringkasan</span>
            </a>
            <a href="/library" class="sidebar-link flex items-center gap-4 px-6 py-4 hover:bg-slate-50">
                <i class="fas fa-book text-lg"></i>
                <span>Katalog Buku</span>
            </a>
        </nav>

        <!-- Logout -->
        <div class="mt-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-4 px-6 py-4 text-rose-500 font-bold hover:bg-rose-50 rounded-2xl transition cursor-pointer">
                    <i class="fas fa-sign-out-alt text-lg"></i>
                    <span>Keluar Aplikasi</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ================= MAIN CONTENT ================= -->
    <main class="flex-1 p-6 lg:p-12 overflow-y-auto">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
            <div>
                <h1 class="text-4xl font-black text-slate-900 mb-2">Selamat Datang Kembali!</h1>
                <p class="text-xl text-slate-500 font-medium">Pantau aktivitas peminjaman buku Anda di sini.</p>
            </div>
            <a href="/#books" class="btn-action shadow-lg shadow-indigo-100">
                <i class="fas fa-plus mr-2"></i> Pinjam Buku Baru
            </a>
        </div>

        <!-- ================= STATS ================= -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            
            <div class="card p-8 stat-card">
                <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-sm">
                    <i class="fas fa-book"></i>
                </div>
                <p class="text-4xl font-black text-slate-900 mb-1">{{ $stats['active'] }}</p>
                <p class="text-slate-400 font-bold text-sm uppercase tracking-widest">Sedang Dipinjam</p>
            </div>

            <div class="card p-8 stat-card">
                <div class="w-14 h-14 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-sm">
                    <i class="fas fa-clock"></i>
                </div>
                <p class="text-4xl font-black text-slate-900 mb-1">{{ $stats['dueSoon'] }}</p>
                <p class="text-slate-400 font-bold text-sm uppercase tracking-widest">Segera Kembali</p>
            </div>

            <div class="card p-8 stat-card">
                <div class="w-14 h-14 bg-rose-100 text-rose-600 rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-sm">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <p class="text-4xl font-black text-slate-900 mb-1">{{ $stats['overdue'] }}</p>
                <p class="text-slate-400 font-bold text-sm uppercase tracking-widest">Terlambat</p>
            </div>

            <div class="card p-8 stat-card">
                <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-sm">
                    <i class="fas fa-check-circle"></i>
                </div>
                <p class="text-4xl font-black text-slate-900 mb-1">{{ $stats['returned'] }}</p>
                <p class="text-slate-400 font-bold text-sm uppercase tracking-widest">Total Selesai</p>
            </div>

        </div>

        <!-- ================= CONTENT PANELS ================= -->
        <div class="grid lg:grid-cols-3 gap-10">
            
            <!-- Active Loans Column -->
            <div class="lg:col-span-2 space-y-8">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-black text-slate-900">Peminjaman Aktif</h2>
                    <span class="px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold">
                        {{ $activeLoans->count() }} Buku
                    </span>
                </div>

                @forelse($activeLoans as $loan)
                    @php
                        $today = now()->startOfDay();
                        $dueDate = $loan->tanggal_kembali->startOfDay();
                        $daysLeft = $today->diffInDays($dueDate, false);
                        
                        if ($daysLeft < 0) {
                            $statusTheme = ['bg' => 'bg-rose-50', 'text' => 'text-rose-600', 'border' => 'border-rose-100', 'label' => 'Terlambat ' . abs($daysLeft) . ' Hari'];
                        } elseif ($daysLeft <= 2) {
                            $statusTheme = ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'border' => 'border-amber-100', 'label' => $daysLeft == 0 ? 'Kembali Hari Ini' : $daysLeft . ' Hari Lagi'];
                        } else {
                            $statusTheme = ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-100', 'label' => $daysLeft . ' Hari Lagi'];
                        }
                    @endphp

                    <div class="card p-8 flex flex-col md:flex-row gap-8 items-start md:items-center">
                        @foreach($loan->loanDetails as $detail)
                            <img src="{{ $detail->book->cover ? asset('storage/' . $detail->book->cover) : asset('storage/default-book.png') }}" 
                                 class="w-32 h-44 object-cover rounded-2xl shadow-xl border-4 border-white">
                            
                            <div class="flex-1">
                                <h4 class="text-2xl font-black text-slate-900 mb-1">{{ $detail->book->judul }}</h4>
                                <p class="text-lg text-slate-500 font-bold mb-4 italic">{{ $detail->book->penulis }}</p>
                                
                                <div class="grid grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pinjam</p>
                                        <p class="text-sm font-bold text-slate-700">{{ $loan->tanggal_pinjam->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Batas Kembali</p>
                                        <p class="text-sm font-bold text-slate-700">{{ $loan->tanggal_kembali->format('d M Y') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between gap-4">
                                    <div class="px-5 py-2 {{ $statusTheme['bg'] }} {{ $statusTheme['text'] }} rounded-full text-sm font-black border {{ $statusTheme['border'] }}">
                                        {{ $statusTheme['label'] }}
                                    </div>
                                    
                                    <form action="{{ route('batal.pinjam', $loan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan peminjaman ini?')">
                                        @csrf
                                        <button type="submit" class="text-rose-500 font-bold text-sm hover:underline cursor-pointer">
                                            Batal Pinjam
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <div class="card p-12 text-center border-dashed border-2">
                        <i class="fas fa-ghost text-5xl text-slate-100 mb-4"></i>
                        <p class="text-slate-400 font-bold">Tidak ada peminjaman aktif</p>
                    </div>
                @endforelse
            </div>

            <!-- History Column -->
            <div class="space-y-8">
                <h2 class="text-2xl font-black text-slate-900">Riwayat Terakhir</h2>
                
                <div class="space-y-4">
                    @forelse($historyLoans->take(5) as $loan)
                        <div class="card p-6 flex items-center gap-4">
                            @foreach($loan->loanDetails as $detail)
                                <img src="{{ $detail->book->cover ? asset('storage/' . $detail->book->cover) : asset('storage/default-book.png') }}" 
                                     class="w-12 h-16 object-cover rounded-lg shadow-sm">
                                <div class="flex-1 min-w-0">
                                    <p class="font-black text-slate-900 truncate text-sm">{{ $detail->book->judul }}</p>
                                    <p class="text-xs text-slate-400 font-bold">Selesai: {{ $loan->returnBook ? $loan->returnBook->tanggal_dikembalikan : $loan->updated_at->format('d/m/y') }}</p>
                                </div>
                            @endforeach
                            
                            @if($loan->returnBook && $loan->returnBook->denda > 0)
                                <div class="text-right">
                                    <p class="text-[10px] font-black text-rose-400 uppercase">Denda</p>
                                    <p class="text-xs font-black text-rose-600">Rp{{ number_format($loan->returnBook->denda, 0, ',', '.') }}</p>
                                </div>
                            @else
                                <i class="fas fa-check-circle text-emerald-500 text-xl"></i>
                            @endif
                        </div>
                    @empty
                        <p class="text-slate-400 text-center font-bold py-10">Belum ada riwayat</p>
                    @endforelse
                </div>
                
                @if($historyLoans->count() > 5)
                    <button class="w-full py-4 text-indigo-600 font-black text-sm hover:underline transition">Lihat Semua Riwayat</button>
                @endif
            </div>

        </div>

    </main>

</div>

</body>
</html>
