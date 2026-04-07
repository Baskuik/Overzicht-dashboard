<div class="bg-slate-800/50 border border-slate-700 rounded-xl p-6">
    <h2 class="text-xl font-semibold text-white mb-6">Recent Records</h2>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-slate-600">
                    <th class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Date
                    </th>
                    <th class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Action
                    </th>
                    <th class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Employee
                    </th>
                    <th class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Duration
                    </th>
                    <th class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Cost
                    </th>
                    <th class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                        Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse(\App\Models\Record::latest('date')->paginate(25) as $record)
                    <tr class="border-b border-slate-700 hover:bg-slate-700/30 transition">
                        <td class="px-4 py-4 text-sm text-gray-300">{{ $record->date?->format('d-m-Y') }}</td>
                        <td class="px-4 py-4 text-sm">
                            <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-xs font-medium">
                                {{ $record->action }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-300">{{ $record->employee_name }}</td>
                        <td class="px-4 py-4 text-sm text-gray-400">{{ number_format($record->duration, 2) }}h</td>
                        <td class="px-4 py-4 text-sm font-semibold text-cyan-400">€
                            {{ number_format($record->cost, 2) }}</td>
                        <td class="px-4 py-4 text-sm text-gray-400">
                            {{ Str::limit($record->description, 50) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-gray-400">
                            No records found. Upload an Excel file to get started.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        <div class="flex justify-between items-center text-sm text-gray-400">
            {{ \App\Models\Record::latest('date')->paginate(25)->links() }}
        </div>
    </div>
</div>
