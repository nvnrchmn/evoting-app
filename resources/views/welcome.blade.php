<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di E-Voting App</title>
    <link href="https://fonts.bunny.net/css?family=inter:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 font-inter">

    <div class="min-h-screen flex flex-col justify-center items-center px-6">
        <div class="max-w-xl text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto h-24 mb-6">

            <h1 class="text-3xl font-bold text-blue-700 mb-4">Selamat Datang di <span class="text-gray-900">E-Voting
                    App</span></h1>
            <p class="text-gray-600 text-base leading-relaxed mb-6">
                Sistem Pemilihan Digital yang Aman, Mudah, dan Efisien.<br>
                Silakan login untuk mulai memilih atau mengelola pemilihan.
            </p>

            <div class="flex justify-center gap-4">
                <a href="{{ route('login') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                    Masuk
                </a>
                <a href="{{ route('register') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded border">
                    Daftar
                </a>
            </div>

            <p class="text-xs text-gray-400 mt-8">&copy; {{ date('Y') }} E-Voting App. All rights reserved.</p>
        </div>
    </div>

</body>

</html>
<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    inter: ['Inter', 'sans-serif'],
                },
            },
        },
    }
</script>