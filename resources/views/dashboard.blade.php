<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Environmental Check Records</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <h1 class="text-xl font-semibold text-gray-900">Environmental Check Dashboard</h1>
                    <div class="flex items-center gap-4">
                        @auth
                            <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-800">Login</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Upload Section -->
            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Upload Excel File</h2>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded">
                        <ul class="list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                            Select Excel File (.xlsx, .xls)
                        </label>
                        <div class="flex items-center justify-center w-full">
                            <label for="file"
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-2 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                                            upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500">Excel files (.xlsx, .xls) up to 10MB</p>
                                </div>
                                <input id="file" type="file" class="hidden" name="file" accept=".xlsx,.xls"
                                    required />
                            </label>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700">
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
