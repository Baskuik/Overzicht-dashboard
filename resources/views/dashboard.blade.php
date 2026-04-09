<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - EcoCheck</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-gray-100">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="border-b border-slate-700 bg-slate-800/50 backdrop-blur sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <h1
                            class="text-xl font-bold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
                            EcoCheck Dashboard
                        </h1>
                    </div>
                    <div class="flex items-center gap-4">
                        @auth
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 flex items-center justify-center">
                                    <span
                                        class="text-xs font-bold text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                </div>
                                <span class="text-sm text-gray-300">{{ Auth::user()->name }}</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-gray-400 hover:text-gray-200 hover:bg-slate-700/50 rounded-lg transition">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 text-sm font-medium text-blue-400 hover:text-blue-300">Login</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Upload Section -->
            <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-8 mb-12">
                <h2 class="text-2xl font-bold mb-2 text-white">Upload Excel File</h2>
                <p class="text-gray-400 mb-6">Import your environmental check records</p>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-500/10 border border-red-500/30 rounded-lg">
                        <ul class="list-disc list-inside text-sm text-red-400">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-500/10 border border-green-500/30 rounded-lg">
                        <p class="text-sm text-green-400">✓ {{ session('success') }}</p>
                    </div>
                @endif

                <form action="/upload" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-300 mb-4">
                            Select Excel File (.xlsx, .xls)
                        </label>
                        <div class="flex items-center justify-center w-full">
                            <label for="file"
                                class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-slate-600 rounded-xl cursor-pointer bg-slate-700/20 hover:bg-slate-700/40 transition">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-12 h-12 mb-3 text-blue-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-300"><span class="font-semibold">Click to
                                            upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500">Excel files (.xlsx, .xls) up to 10MB</p>
                                </div>
                                <input id="file" type="file" class="hidden" name="file" accept=".xlsx,.xls"
                                    required />
                            </label>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-4 py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-cyan-700 transition transform hover:scale-105 duration-200">
                        Upload File
                    </button>
                </form>
            </div>

            <!-- Stats Overview -->
            @include('dashboard.stats', ['stats' => $stats])

            <!-- Charts Section -->
            @include('dashboard.charts', ['chartData' => $chartData, 'kostenPerMaand' => $kostenPerMaand])

            <!-- Records Table -->
            @include('dashboard.records-table')
        </main>
    </div>
</body>

</html>
