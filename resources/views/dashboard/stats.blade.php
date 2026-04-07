<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
    <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-6 hover:border-blue-500/50 transition group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm font-medium mb-1">Total Actions</p>
                <p class="text-4xl font-bold text-white">{{ $stats['total_actions'] }}</p>
            </div>
            <div
                class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center group-hover:bg-blue-500/30 transition">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                    </path>
                </svg>
            </div>
        </div>
        <p class="text-xs text-green-400 mt-3">↑ Real-time data</p>
    </div>

    <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-6 hover:border-cyan-500/50 transition group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm font-medium mb-1">Total Cost</p>
                <p class="text-4xl font-bold text-white">€ {{ number_format($stats['total_cost'], 0) }}</p>
            </div>
            <div
                class="w-12 h-12 bg-cyan-500/20 rounded-lg flex items-center justify-center group-hover:bg-cyan-500/30 transition">
                <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-400 mt-3">→ Total expenses</p>
    </div>

    <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-6 hover:border-emerald-500/50 transition group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm font-medium mb-1">Avg Duration</p>
                <p class="text-4xl font-bold text-white">{{ floor($stats['avg_duration'] / 60) }}h
                    {{ $stats['avg_duration'] % 60 }}m</p>
            </div>
            <div
                class="w-12 h-12 bg-emerald-500/20 rounded-lg flex items-center justify-center group-hover:bg-emerald-500/30 transition">
                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-400 mt-3">→ Per action</p>
    </div>

    <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-6 hover:border-purple-500/50 transition group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm font-medium mb-1">Employees</p>
                <p class="text-4xl font-bold text-white">{{ $stats['total_employees'] }}</p>
            </div>
            <div
                class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center group-hover:bg-purple-500/30 transition">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20h12a6 6 0 006-6V9a6 6 0 00-6-6H6a6 6 0 00-6 6v5a6 6 0 006 6z">
                    </path>
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-400 mt-3">→ Involved</p>
    </div>
</div>
