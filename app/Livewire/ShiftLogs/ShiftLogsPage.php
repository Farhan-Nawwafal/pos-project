<?php

namespace App\Livewire\ShiftLogs;

use Livewire\Component;
use Carbon\CarbonImmutable;
use Livewire\WithPagination;

class ShiftLogsPage extends Component
{
    use WithPagination;

    public ?string $fromDate = null;
    public ?string $toDate = null;
    public string $rangePreset = 'today';

    // Variabel untuk menangkap ketikan dari search bar
    public string $searchNumber = '';

    public function updatedFromDate(): void
    {
        $this->resetPage();
    }

    public function updatedToDate(): void
    {
        $this->resetPage();
    }

    public function updatedSearchNumber(): void
    {
        $this->resetPage();
    }

    public function setRange(string $preset): void
    {
        $today = CarbonImmutable::now();

        if ($preset === 'today') {
            $from = $today;
            $to = $today;
        } elseif ($preset === '7d') {
            $from = $today->subDays(6);
            $to = $today;
        } elseif ($preset === '30d') {
            $from = $today->subDays(29);
            $to = $today;
        } elseif ($preset === 'custom') {
            return;
        } else {
            return;
        }

        $this->fromDate = $from->format('Y-m-d');
        $this->toDate = $to->format('Y-m-d');

        $this->rangePreset = $preset;
        $this->resetPage();
    }

    public function setTransactionsRange(?string $from, ?string $to): void
    {
        if (! $from || ! $to) {
            return;
        }

        if ($from > $to) {
            [$from, $to] = [$to, $from];
        }

        $this->fromDate = $from;
        $this->toDate = $to;
        $this->rangePreset = 'custom';
        $this->resetPage();
    }

    public function render()
    {
        // DUMMY SEBELUM QUERY
        $allData = [
            [
                'starting_shift' => '13-05-2026 08:07:24',
                'started_by' => 'KASIR',
                'starting_cash' => 0,
                'ending_shift' => '- Currently Open -',
                'ended_by' => '-',
                'expected_cash' => null,
                'actual_cash' => null,
                'difference_total' => null,
            ],
            [
                'starting_shift' => '12-05-2026 09:34:27',
                'started_by' => 'Faishal',
                'starting_cash' => 0,
                'ending_shift' => '12-05-2026 21:02:14',
                'ended_by' => 'Faishal',
                'expected_cash' => 1507700,
                'actual_cash' => 1507700,
                'difference_total' => 0,
            ],
            [
                'starting_shift' => '11-05-2026 07:42:51',
                'started_by' => 'Budi',
                'starting_cash' => 0,
                'ending_shift' => '11-05-2026 21:09:06',
                'ended_by' => 'Budi',
                'expected_cash' => 1640200,
                'actual_cash' => 1640200,
                'difference_total' => 0,
            ],
            [
                'starting_shift' => '10-05-2026 09:21:47',
                'started_by' => 'KASIR',
                'starting_cash' => 0,
                'ending_shift' => '10-05-2026 21:57:14',
                'ended_by' => 'KASIR',
                'expected_cash' => 2329700,
                'actual_cash' => 2329700,
                'difference_total' => 0,
            ],
            [
                'starting_shift' => '09-05-2026 08:52:10',
                'started_by' => 'Siti',
                'starting_cash' => 0,
                'ending_shift' => '09-05-2026 22:04:25',
                'ended_by' => 'Siti',
                'expected_cash' => 1379900,
                'actual_cash' => 1379900,
                'difference_total' => 0,
            ]
        ];

        // 2. Logika Search/Pencarian
        $filteredData = $allData;

        if (!empty($this->searchNumber)) {
            // Ubah inputan menjadi huruf kecil agar pencarian tidak sensitif besar/kecil huruf
            $search = strtolower($this->searchNumber);

            $filteredData = array_filter($allData, function ($row) use ($search) {
                return str_contains(strtolower($row['starting_shift']), $search) ||
                    str_contains(strtolower($row['ending_shift']), $search) ||
                    str_contains(strtolower($row['started_by']), $search) ||
                    str_contains(strtolower($row['ended_by']), $search);
            });
        }

        return view('livewire.shift-logs.index', [
            'shiftLogs' => $filteredData
        ]);
    }
}