<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - EcoCheck Dashboard</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-gray-100 min-h-screen">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <!-- Back to Home -->
            <div class="mb-8">
                <a href="/" class="text-gray-400 hover:text-gray-200 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    Back to Home
                </a>
            </div>

            <!-- Card -->
            <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-8 shadow-2xl">
                <!-- Logo & Title -->
                <div class="flex items-center gap-3 mb-2">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h1
                        class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
                        EcoCheck
                    </h1>
                </div>
                <p class="text-gray-400 mb-8">Sign in to your account</p>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-lg">
                        @foreach ($errors->all() as $error)
                            <p class="text-sm text-red-400">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                            Email Address
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="you@example.com" required>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                            Password
                        </label>
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="Enter your password" required>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember"
                                class="w-4 h-4 bg-slate-700 border border-slate-600 rounded focus:ring-2 focus:ring-blue-500">
                            <label for="remember" class="ml-3 text-sm text-gray-400">
                                Remember me
                            </label>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-cyan-700 transition transform hover:scale-105 duration-200">
                        Sign In
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-slate-700 space-y-4">
                    <p class="text-center text-sm text-gray-400">
                        Don't have an account?
                        <a href="{{ route('register') }}"
                            class="text-blue-400 hover:text-blue-300 font-semibold transition">
                            Sign up
                        </a>
                    </p>

                    <div class="bg-slate-700/30 border border-slate-600 rounded-lg p-4 text-center">
                        <p class="text-xs text-gray-400 mb-2">Demo Account:</p>
                        <p class="text-sm font-mono text-cyan-400">admin1@gmail.com</p>
                        <p class="text-sm font-mono text-cyan-400">ditiseentest1234</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
