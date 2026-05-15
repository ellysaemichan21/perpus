<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru — E-Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Outfit', sans-serif; }
        html { font-size: 18px; }
        body { background-color: #ffffff; color: #1e293b; }
        .input-box {
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            padding: 1rem 1.5rem;
            border-radius: 1.5rem;
            width: 100%;
            transition: all 0.2s;
            font-weight: 500;
        }
        .input-box:focus {
            border-color: #4f46e5;
            background-color: #ffffff;
            outline: none;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }
        .btn-auth {
            background-color: #4f46e5;
            color: white;
            width: 100%;
            padding: 1.25rem;
            border-radius: 1.5rem;
            font-weight: 800;
            font-size: 1.1rem;
            transition: all 0.2s;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.2);
        }
        .btn-auth:hover {
            background-color: #4338ca;
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(79, 70, 229, 0.2);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 bg-slate-50">

    <div class="max-w-xl w-full">
        <!-- Back Link -->
        <a href="/library" class="inline-flex items-center gap-2 text-slate-400 font-bold hover:text-indigo-600 transition mb-10 group">
            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition"></i>
            Kembali ke Beranda
        </a>

        <!-- Main Card -->
        <div class="bg-white rounded-[3rem] p-10 md:p-16 shadow-2xl shadow-indigo-100 border border-slate-100 relative overflow-hidden">
            <!-- Decorative circle -->
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-50 rounded-full"></div>
            
            <div class="relative z-10">
                <!-- Logo & Title -->
                <div class="text-center mb-12">
                    <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo" class="w-20 h-20 rounded-2xl border-4 border-indigo-600 mx-auto mb-6 shadow-xl object-cover">
                    <h1 class="text-4xl font-black text-slate-900 mb-2">Buat Akun</h1>
                    <p class="text-lg text-slate-400 font-bold uppercase tracking-widest">Bergabunglah Bersama Kami</p>
                </div>

                <!-- Errors -->
                @if ($errors->any())
                    <div class="bg-rose-50 border-2 border-rose-100 text-rose-600 p-6 rounded-3xl mb-8 font-bold text-sm">
                        @foreach ($errors->all() as $error)
                            <p><i class="fas fa-exclamation-circle mr-2"></i> {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama Anda" class="input-box">
                    </div>

                    <div>
                        <label class="block text-sm font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com" class="input-box">
                    </div>

                    <div>
                        <label class="block text-sm font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">Kata Sandi</label>
                        <input type="password" name="password" required placeholder="Minimal 6 karakter" class="input-box">
                    </div>

                    <div>
                        <label class="block text-sm font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" required placeholder="Ulangi kata sandi" class="input-box">
                    </div>

                    <button type="submit" class="btn-auth mt-4">
                        Daftar Akun Baru <i class="fas fa-user-plus ml-2"></i>
                    </button>
                </form>

                <div class="mt-12 text-center pt-8 border-t border-slate-50">
                    <p class="text-slate-400 font-bold">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Masuk Ke Akun</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
