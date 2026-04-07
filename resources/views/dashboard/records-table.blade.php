<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Records</h2>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-gray-700">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-4 py-3 text-left font-semibold text-gray-900">Date</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-900">Action</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-900">Employee</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-900">Duration (h)</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-900">Cost (€)</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-900">Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse(\App\Models\Record::latest('date')->paginate(25) as $record)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                        <td class="px-4 py-3">{{ $record->date?->format('d-m-Y') }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-medium">
                                {{ $record->action }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $record->employee_name }}</td>
                        <td class="px-4 py-3">{{ number_format($record->duration, 2) }}</td>
                        <td class="px-4 py-3 font-semibold">€ {{ number_format($record->cost, 2) }}</td>
                        <td class="px-4 py-3 text-gray-600">
                            {{ Str::limit($record->description, 50) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            No records found. Upload an Excel file to get started.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ \App\Models\Record::latest('date')->paginate(25)->links() }}
    </div>
</div>
