<?php

namespace App\Livewire\ShiftLogs;

use App\Models\Shift;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ShiftLogsPage extends Component
{
    use WithPagination;

    public string $title = 'Shift Logs';

    public ?string $fromDate = null;

    public ?string $toDate = null;

    public string $rangePreset = 'today';

    // Variabel untuk menangkap ketikan dari search bar
    public string $searchNumber = '';

    // Variabel untuk membatasi jumlah data per halaman
    public int $perPage = 15;

    public function mount(): void
    {
        // Set filter tanggal bawaan ke "Hari Ini" saat halaman pertama kali dibuka
        $this->setRange('today');
    }

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

    protected function getShiftsQuery(): Builder
    {
        $query = Shift::query()
            ->with(['startedBy', 'endedBy'])
            // 1. Filter Wajib: Hanya ambil data sesuai cabang user yang login
            ->where('cabang_id', auth()->user()->cabang_id);

        // 2. Filter Tanggal
        if ($this->fromDate) {
            $query->whereDate('started_at', '>=', $this->fromDate);
        }

        if ($this->toDate) {
            $query->whereDate('started_at', '<=', $this->toDate);
        }

        // 3. Pencarian Multi-Kolom (Waktu mulai, waktu akhir, nama kasir buka, nama kasir tutup)
        if (trim($this->searchNumber) !== '') {
            $term = '%'.trim($this->searchNumber).'%';

            $query->where(function (Builder $q) use ($term) {
                // Cari di kolom waktu
                $q->where('started_at', 'like', $term)
                    ->orWhere('ended_at', 'like', $term)

                  // Cari di tabel user (relasi startedBy)
                    ->orWhereHas('startedBy', function (Builder $subQ) use ($term) {
                        $subQ->where('name', 'like', $term);
                    })

                  // Cari di tabel user (relasi endedBy)
                    ->orWhereHas('endedBy', function (Builder $subQ) use ($term) {
                        $subQ->where('name', 'like', $term);
                    });
            });
        }

        // 4. Urutkan dari shift terbaru
        return $query->orderBy('started_at', 'desc');
    }

    public function render(): View
    {
        $shifts = $this->getShiftsQuery()->paginate($this->perPage);

        return view('livewire.shift-logs.index', [
            'shifts' => $shifts,
        ])->layout('layouts.app', ['title' => $this->title]);
    }
}
