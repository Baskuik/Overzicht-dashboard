<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-600 text-sm font-semibold mb-2">{{ __('Total Actions') }}</h3>
        <p class="text-3xl font-bold text-gray-800">{{ $stats['total_actions'] }}</p>
        <p class="text-xs text-green-600 mt-1">↑ Updated now</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-600 text-sm font-semibold mb-2">{{ __('Total Cost') }}</h3>
        <p class="text-3xl font-bold text-gray-800">€ {{ number_format($stats['total_cost'], 2) }}</p>
        <p class="text-xs text-gray-500 mt-1">→ Stable</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-600 text-sm font-semibold mb-2">{{ __('Avg Duration') }}</h3>
        <p class="text-3xl font-bold text-gray-800">{{ floor($stats['avg_duration'] / 60) }}h
            {{ $stats['avg_duration'] % 60 }}m</p>
        <p class="text-xs text-gray-500 mt-1">→ Per action</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-600 text-sm font-semibold mb-2">{{ __('Employees') }}</h3>
        <p class="text-3xl font-bold text-gray-800">{{ $stats['total_employees'] }}</p>
        <p class="text-xs text-gray-500 mt-1">→ Involved</p>
    </div>
</div>
