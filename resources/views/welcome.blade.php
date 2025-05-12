<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gema API</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        @keyframes fly {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(-3deg);
            }

            100% {
                transform: translateY(0) rotate(0deg);
            }
        }

        .animate-fly {
            animation: fly 2s ease-in-out infinite;
        }

        .rocket:hover {
            transform: translateY(-20px) rotate(-12deg);
        }

        .rocket {
            transition: all 0.4s ease-in-out;
            display: inline-block;
        }
    </style>
</head>

<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] font-[Instrument Sans] flex items-center justify-center min-h-screen p-6">

    <div
        class="text-center max-w-xl w-full space-y-6 bg-white/60 dark:bg-[#1a1a1a]/60 backdrop-blur-lg rounded-2xl shadow-xl p-10 transition-all">
        <h1 class="text-4xl font-semibold">
            <span class="rocket animate-fly text-5xl mr-2">🚀</span>
            Selamat datang di <span class="text-[#f53003] dark:text-[#FF4433]">Gema API</span>
        </h1>

        <p class="text-lg text-[#706f6c] dark:text-[#A1A09A]">
            Platform API untuk integrasi perangkat smartwatch & monitoring.
        </p>

        <div class="mt-6">
            <span
                class="inline-block px-4 py-2 text-sm rounded bg-gray-100 dark:bg-[#1a1a1a] text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-[#2c2c2c] transition">
                Laravel v {{ Illuminate\Foundation\Application::VERSION }}
            </span>
        </div>

        <footer class="text-xs text-[#a0a09a] dark:text-[#676766] mt-10">
            &copy; {{ now()->year }} Gema API ❤️
        </footer>
    </div>

</body>

</html>
