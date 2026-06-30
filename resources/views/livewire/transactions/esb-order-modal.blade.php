@props(['transactions' => []])

@php
    $rows = $transactions ?? [];

    $getStatusClasses = function (string $status) {
        $base = 'rounded-full px-2 py-0.5 text-theme-xs font-medium';

        return match ($status) {
            'paid' => $base.' bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500',
            'pending' => $base.' bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-orange-400',
            default => $base.' bg-gray-50 text-gray-600 dark:bg-gray-500/15 dark:text-gray-400',
        };
    };
@endphp
<div x-data x-show="$store.sidebar.isEsbModalOpen" class="fixed inset-0 z-[50000]" x-cloak>
    <div @click="$store.sidebar.isEsbModalOpen = false" class="fixed inset-0 bg-black/20 z-[49999]"></div>

    <div class="fixed top-0 right-0 h-full w-full max-w-[70%] bg-white shadow-2xl p-3 z-[50000] border-l flex flex-col"
         x-show="$store.sidebar.isEsbModalOpen"
         x-transition:enter="transition-transform duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0">
        
        <div class="flex justify-between items-center mb-4 border-b pb-4">
            <h2 class="text-sm font-bold">ESB Order Report</h2>
            <button @click="$store.sidebar.isEsbModalOpen = false" class="text-gray-500"><i class="bi bi-x-lg"></i></button>
        </div>

        <div class="flex-1 overflow-y-auto">
            <table class="w-full text-left">
                <tbody>
                    @forelse($rows as $row)
                        <tr class="border-t text-xs">
                            <td class="p-3">{{ $row['code'] ?? '-' }}</td>
                            <td class="p-3">{{ $row['customer'] ?? '-' }}</td>
                            <td class="p-3 text-right">{{ $row['total'] ?? '-' }}</td>
                            <td class="p-3 text-center">
                                <span class="{{ $this->getStatusClasses(strtolower($row['payment_status'] ?? '')) }}">
                                    {{ $row['payment_status'] ?? '-' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-10 text-center">No Data Available</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>