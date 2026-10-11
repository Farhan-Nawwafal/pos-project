<div class="p-4 md:p-6 space-y-5">

    {{-- ───────────── HEADER ───────────── --}}
    <div class="flex flex-col gap-1">
        <div class="flex items-start justify-between gap-3">
            <div class="flex items-center gap-2">
                <h1 class="text-lg font-semibold text-gray-800 dark:text-white">Laporan Void</h1>
                <button class="text-gray-400 hover:text-gray-500 transition-colors" title="Tentang laporan ini">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </button>
                <button class="text-gray-400 hover:text-yellow-400 transition-colors" title="Tambahkan ke favorit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </button>
            </div>
            {{-- ───────────── BUTTON EKSPOR LAPORAN DENGAN DROPDOWN ───────────── --}}
            <div class="relative" x-data="{ openExport: false }" @click.outside="openExport = false">
                <button
                    @click="openExport = !openExport"
                    type="button"
                    class="flex items-center gap-2 px-4 py-2 bg-teal-500 hover:bg-teal-600 text-white rounded-lg text-sm font-medium transition-colors shadow-sm"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Ekspor Laporan</span>
                    <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': openExport }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Dropdown Options --}}
                <div
                    x-show="openExport"
                    x-cloak
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 py-1.5 z-50 overflow-hidden"
                >
                    <button
                        wire:click="exportPdf"
                        @click="openExport = false"
                        type="button"
                        class="w-full flex items-center gap-2.5 px-4 py-2.5 text-xs text-gray-700 dark:text-gray-200 hover:bg-red-50 dark:hover:bg-red-950/30 hover:text-red-600 dark:hover:text-red-400 transition-colors text-left"
                    >
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-semibold">Ekspor ke PDF</span>
                    </button>

                    <button
                        wire:click="exportExcel"
                        @click="openExport = false"
                        type="button"
                        class="w-full flex items-center gap-2.5 px-4 py-2.5 text-xs text-gray-700 dark:text-gray-200 hover:bg-emerald-50 dark:hover:bg-emerald-950/30 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors text-left border-t border-gray-100 dark:border-gray-700/60"
                    >
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        </svg>
                        <span class="font-semibold">Ekspor ke Excel (CSV)</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span>
                {{ \Carbon\Carbon::parse($startDate)->locale('id')->isoFormat('D MMMM Y') }}
                &ndash;
                {{ \Carbon\Carbon::parse($endDate)->locale('id')->isoFormat('D MMMM Y') }}
            </span>
        </div>
    </div>

    {{-- ───────────── FILTERS ───────────── --}}
    <div class="flex flex-wrap items-center gap-3">
        {{-- Search --}}
        <div class="relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="Cari nota, kasir, produk, meja..."
                class="pl-9 pr-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg text-sm bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-1 focus:ring-teal-500 w-64"
            >
        </div>

        {{-- ── DATE RANGE PICKER ── --}}
        <div
            class="relative"
            wire:ignore
            x-data="{
                open: false,
                start: null,
                end: null,
                hover: null,
                selecting: false,
                rightYear: new Date().getFullYear(),
                rightMonth: new Date().getMonth(),

                months: ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
                dayNames: ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],

                init() {
                    this.syncFromLivewire();
                    this.$watch('$wire.startDate', () => this.syncFromLivewire());
                    this.$watch('$wire.endDate', () => this.syncFromLivewire());
                },

                syncFromLivewire() {
                    const s = $wire.startDate;
                    const e = $wire.endDate;
                    if (s) this.start = new Date(s + 'T00:00:00');
                    if (e) {
                        this.end = new Date(e + 'T00:00:00');
                        this.rightYear  = this.end.getFullYear();
                        this.rightMonth = this.end.getMonth();
                    }
                },

                get leftYear()  { return this.rightMonth === 0 ? this.rightYear - 1 : this.rightYear; },
                get leftMonth() { return this.rightMonth === 0 ? 11 : this.rightMonth - 1; },
                get leftDays()  { return this.getCalDays(this.leftYear, this.leftMonth); },
                get rightDays() { return this.getCalDays(this.rightYear, this.rightMonth); },

                getCalDays(year, month) {
                    const first = new Date(year, month, 1).getDay();
                    const total = new Date(year, month + 1, 0).getDate();
                    const days  = [];
                    for (let i = 0; i < first; i++)
                        days.push({ date: null, key: 'e' + i + '-' + year + '-' + month });
                    for (let d = 1; d <= total; d++) {
                        const dt = new Date(year, month, d, 0, 0, 0, 0);
                        days.push({ date: dt, key: dt.getTime() });
                    }
                    return days;
                },

                prevMonth() {
                    if (this.rightMonth === 0) { this.rightMonth = 11; this.rightYear--; }
                    else this.rightMonth--;
                },
                nextMonth() {
                    if (this.rightMonth === 11) { this.rightMonth = 0; this.rightYear++; }
                    else this.rightMonth++;
                },

                clickDay(date) {
                    const d = new Date(date.getTime());
                    if (!this.selecting || !this.start) {
                        this.start = d; this.end = null; this.selecting = true;
                    } else {
                        if (d < this.start) { this.end = this.start; this.start = d; }
                        else { this.end = d; }
                        this.selecting = false;
                    }
                },

                same(a, b) { return a && b && a.toDateString() === b.toDateString(); },
                effEnd()   { return this.end || (this.selecting && this.hover ? this.hover : null); },

                bgClass(date) {
                    if (!date || !this.start) return '';
                    const e = this.effEnd();
                    if (!e || this.same(this.start, e)) return '';
                    const [s, en] = this.start <= e ? [this.start, e] : [e, this.start];
                    if (this.same(date, s) || this.same(date, en) || (date > s && date < en))
                        return 'bg-teal-50 dark:bg-teal-900/20';
                    return '';
                },

                circleClass(date) {
                    if (!date) return 'text-gray-700 dark:text-gray-300';
                    const isS = this.same(date, this.start);
                    const isE = this.end && this.same(date, this.end);
                    const isH = this.selecting && this.hover && this.same(date, this.hover);
                    if (isS || isE) return 'bg-teal-500 text-white font-semibold';
                    if (isH)        return 'bg-teal-300 text-white';
                    return 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700';
                },

                setPreset(p) {
                    const t = new Date(); t.setHours(0,0,0,0);
                    const ms = 86400000;
                    const map = {
                        today:     [new Date(t), new Date(t)],
                        yesterday: [new Date(t-ms), new Date(t-ms)],
                        last7:     [new Date(t-6*ms), new Date(t)],
                        thisWeek:  [new Date(t-t.getDay()*ms), new Date(t+(6-t.getDay())*ms)],
                        lastWeek:  (() => { const e = new Date(t-(t.getDay()+1)*ms); return [new Date(e-6*ms), e]; })(),
                        last30:    [new Date(t-29*ms), new Date(t)],
                        thisMonth: [new Date(t.getFullYear(), t.getMonth(), 1), new Date(t.getFullYear(), t.getMonth()+1, 0)],
                        lastMonth: [new Date(t.getFullYear(), t.getMonth()-1, 1), new Date(t.getFullYear(), t.getMonth(), 0)],
                    };
                    if (!map[p]) return;
                    [this.start, this.end] = map[p];
                    this.selecting = false;
                    this.rightYear  = this.end.getFullYear();
                    this.rightMonth = this.end.getMonth();
                },

                fmt(d) {
                    if (!d) return '';
                    return d.getFullYear() + '-' + String(d.getMonth()+1).padStart(2,'0') + '-' + String(d.getDate()).padStart(2,'0');
                },
                fmtDisplay(d) {
                    if (!d) return '...';
                    return String(d.getDate()).padStart(2,'0') + ' ' + this.months[d.getMonth()] + ' ' + d.getFullYear();
                },

                get triggerText() {
                    if (!this.start) return 'Pilih tanggal';
                    if (!this.end) return this.fmtDisplay(this.start);
                    return this.fmtDisplay(this.start) + ' - ' + this.fmtDisplay(this.end);
                },
                get bottomText() {
                    if (!this.start) return 'Pilih tanggal';
                    if (!this.end) return this.fmtDisplay(this.start);
                    return this.fmtDisplay(this.start) + ' - ' + this.fmtDisplay(this.end);
                },

                apply() {
                    if (!this.start || !this.end) return;
                    $wire.set('startDate', this.fmt(this.start));
                    $wire.set('endDate',   this.fmt(this.end));
                    this.open = false;
                },
                cancel() {
                    this.syncFromLivewire();
                    this.open = false;
                }
            }"
        >
            {{-- Trigger button --}}
            <button
                @click="open = !open"
                class="flex items-center gap-2 px-3 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors whitespace-nowrap"
            >
                <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span x-text="triggerText"></span>
            </button>

            {{-- Picker dropdown --}}
            <div
                x-show="open"
                x-cloak
                @click.outside="open = false"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute left-0 top-full mt-2 z-[100] bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden"
                style="width: 570px;"
            >
                <div class="flex divide-x divide-gray-100 dark:divide-gray-700">

                    {{-- Sidebar shortcuts --}}
                    <div class="w-36 p-2 flex flex-col gap-0.5 flex-shrink-0">
                        <template x-for="item in [
                            {label: 'Hari Ini',        value: 'today'},
                            {label: 'Kemarin',         value: 'yesterday'},
                            {label: '7 Hari Terakhir', value: 'last7'},
                            {label: 'Minggu Ini',      value: 'thisWeek'},
                            {label: 'Minggu Lalu',     value: 'lastWeek'},
                            {label: '30 Hari Terakhir',value: 'last30'},
                            {label: 'Bulan Ini',       value: 'thisMonth'},
                            {label: 'Bulan Lalu',      value: 'lastMonth'},
                        ]" :key="item.value">
                            <button
                                @click="setPreset(item.value)"
                                class="text-left px-3 py-1.5 text-xs rounded-lg text-gray-600 dark:text-gray-400 hover:bg-teal-50 dark:hover:bg-teal-900/20 hover:text-teal-600 dark:hover:text-teal-400 transition-colors whitespace-nowrap"
                                x-text="item.label"
                            ></button>
                        </template>
                    </div>

                    {{-- Calendars + footer --}}
                    <div class="flex-1 flex flex-col min-w-0">
                        <div class="flex gap-3 p-4">

                            {{-- Left calendar --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-2">
                                    <button @click="prevMonth()" class="p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                        </svg>
                                    </button>
                                    <span class="text-xs font-bold text-gray-700 dark:text-gray-200" x-text="months[leftMonth] + ' ' + leftYear"></span>
                                    <div class="w-6"></div>
                                </div>
                                <div class="grid grid-cols-7 mb-1">
                                    <template x-for="d in dayNames" :key="d">
                                        <div class="text-center text-xs font-medium text-gray-400 py-0.5" x-text="d"></div>
                                    </template>
                                </div>
                                <div class="grid grid-cols-7">
                                    <template x-for="item in leftDays" :key="item.key">
                                        <div
                                            class="h-7 flex items-center justify-center"
                                            :class="item && item.date ? bgClass(item.date) : ''"
                                            @click="item && item.date && clickDay(item.date)"
                                            @mouseenter="item && item.date && (hover = item.date)"
                                            @mouseleave="hover = null"
                                        >
                                            <span
                                                x-show="!!(item && item.date)"
                                                class="w-6 h-6 flex items-center justify-center rounded-full text-xs transition-colors"
                                                :class="item && item.date ? circleClass(item.date) : ''"
                                                x-text="item && item.date ? item.date.getDate() : ''"
                                            ></span>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            {{-- Right calendar --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="w-6"></div>
                                    <span class="text-xs font-bold text-gray-700 dark:text-gray-200" x-text="months[rightMonth] + ' ' + rightYear"></span>
                                    <button @click="nextMonth()" class="p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="grid grid-cols-7 mb-1">
                                    <template x-for="d in dayNames" :key="d">
                                        <div class="text-center text-xs font-medium text-gray-400 py-0.5" x-text="d"></div>
                                    </template>
                                </div>
                                <div class="grid grid-cols-7">
                                    <template x-for="item in rightDays" :key="item.key">
                                        <div
                                            class="h-7 flex items-center justify-center"
                                            :class="item && item.date ? bgClass(item.date) : ''"
                                            @click="item && item.date && clickDay(item.date)"
                                            @mouseenter="item && item.date && (hover = item.date)"
                                            @mouseleave="hover = null"
                                        >
                                            <span
                                                x-show="!!(item && item.date)"
                                                class="w-6 h-6 flex items-center justify-center rounded-full text-xs transition-colors"
                                                :class="item && item.date ? circleClass(item.date) : ''"
                                                x-text="item && item.date ? item.date.getDate() : ''"
                                            ></span>
                                        </div>
                                    </template>
                                </div>
                            </div>

                        </div>

                        {{-- Footer --}}
                        <div class="px-4 pb-3 pt-2 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between gap-4">
                            <span class="text-xs text-gray-600 dark:text-gray-400 font-medium" x-text="bottomText"></span>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <button @click="cancel()" class="px-3 py-1.5 text-sm text-teal-500 hover:text-teal-600 font-medium transition-colors">
                                    Batal
                                </button>
                                <button
                                    @click="apply()"
                                    :disabled="!start || !end"
                                    class="px-4 py-1.5 text-sm bg-teal-500 hover:bg-teal-600 text-white rounded-lg font-medium transition-colors disabled:opacity-40 disabled:cursor-not-allowed"
                                >
                                    Proses
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ── END DATE RANGE PICKER ── --}}

        {{-- Order type filter --}}
        <select
            wire:model.live="orderTypeFilter"
            class="px-3 py-2 border border-gray-200 dark:border-gray-700 rounded-lg text-sm bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-1 focus:ring-teal-500"
        >
            <option value="">Semua Jenis Order</option>
            @foreach($this->orderTypes as $type)
                <option value="{{ $type }}">
                    {{ $type === 'dine_in' ? 'Dine In' : ($type === 'take_away' ? 'Take Away' : $type) }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- ───────────── SUMMARY CARDS ───────────── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-5">
            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Total Void</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white">
                Rp {{ number_format($this->summary['total_void'], 2, ',', '.') }}
            </p>
            <div class="mt-4 h-1 bg-red-500 rounded-full"></div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 p-5">
            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Total Transaksi</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white">
                {{ $this->summary['total_transaksi'] }}
            </p>
            <div class="mt-4 h-1 bg-teal-500 rounded-full"></div>
        </div>
    </div>

    {{-- ───────────── TABLE ───────────── --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm" style="min-width: 950px;">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider whitespace-nowrap">No Nota</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider whitespace-nowrap">Tanggal Void</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider whitespace-nowrap">Tanggal Order</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider whitespace-nowrap">Kasir</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider whitespace-nowrap">Otorisasi</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider whitespace-nowrap">Produk</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider whitespace-nowrap">Subtotal Void</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider whitespace-nowrap">Jenis Order</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider whitespace-nowrap">Nama Meja</th>
                        <th class="px-4 py-3 w-10"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                    @forelse($this->transactions as $transaction)
                        <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-700/30 transition-colors duration-100">
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="text-teal-500 font-medium text-xs">{{ $transaction->code }}</span>
                            </td>
                            <td class="px-4 py-4 text-gray-700 dark:text-gray-300 whitespace-nowrap text-xs">
                                {{ $transaction->voided_at ? \Carbon\Carbon::parse($transaction->voided_at)->locale('id')->isoFormat('D MMMM Y, HH:mm') : '-' }}
                            </td>
                            <td class="px-4 py-4 text-gray-700 dark:text-gray-300 whitespace-nowrap text-xs">
                                {{ \Carbon\Carbon::parse($transaction->created_at)->locale('id')->isoFormat('D MMMM Y, HH:mm') }}
                            </td>
                            <td class="px-4 py-4 text-gray-700 dark:text-gray-300 whitespace-nowrap text-xs">
                                {{ auth()->user()->name }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs">
                                <span class="text-teal-500">{{ $transaction->voidedBy?->name ?? 'Badar Cahaya Putra' }}</span>
                            </td>
                            <td class="px-4 py-4 text-gray-700 dark:text-gray-300 text-xs">
                                {!! $this->formatProducts($transaction) !!}
                            </td>
                            <td class="px-4 py-4 text-gray-700 dark:text-gray-300 whitespace-nowrap text-xs">
                                Rp {{ number_format($transaction->subtotal ?? 0, 2, ',', '.') }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs">
                                <span class="text-teal-500">
                                    @if($transaction->order_type === 'dine_in')
                                        Dine In
                                    @elseif($transaction->order_type === 'take_away')
                                        Take Away
                                    @else
                                        {{ $transaction->order_type ?? '-' }}
                                    @endif
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs">
                                @php $meja = $this->getMejaName($transaction) @endphp
                                @if($meja)
                                    <span class="text-gray-700 dark:text-gray-300">{{ $meja }}</span>
                                @else
                                    <span class="text-teal-500">null</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-right">
                                <button wire:click="showDetail({{ $transaction->id }})" class="text-gray-400 hover:text-teal-500 transition-colors" title="Lihat detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-4 py-14 text-center">
                                <div class="flex flex-col items-center gap-2 text-gray-400 dark:text-gray-500">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    <span class="text-sm">Tidak ada data void ditemukan.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Footer --}}
        @if($this->transactions->total() > 0)
        <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-700 flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                <span>Tampilkan:</span>
                <select wire:model.live="perPage" class="border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded px-2 py-1 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-1 focus:ring-teal-500 cursor-pointer">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span>
                    Ditampilkan {{ $this->transactions->firstItem() ?? 0 }}
                    - {{ $this->transactions->lastItem() ?? 0 }}
                    dari {{ $this->transactions->total() }} data
                </span>
            </div>
            <div class="flex items-center gap-1">
                <button wire:click="previousPage" @disabled($this->transactions->onFirstPage())
                    class="flex items-center gap-1 px-3 py-1.5 text-sm rounded-lg border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Sebelumnya
                </button>
                @php
                    $cp   = $this->transactions->currentPage();
                    $lp   = $this->transactions->lastPage();
                    $start = max(1, min($cp - 2, $lp - 4));
                    $end   = min($lp, max($cp + 2, 5));
                @endphp
                @if($start > 1)
                    <button wire:click="gotoPage(1)" class="px-3 py-1.5 text-sm rounded-lg border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">1</button>
                    @if($start > 2)<span class="px-1 text-gray-400">…</span>@endif
                @endif
                @for($page = $start; $page <= $end; $page++)
                    <button wire:click="gotoPage({{ $page }})"
                        class="px-3 py-1.5 text-sm rounded-lg transition-colors {{ $cp === $page ? 'bg-teal-500 text-white font-medium' : 'border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                        {{ $page }}
                    </button>
                @endfor
                @if($end < $lp)
                    @if($end < $lp - 1)<span class="px-1 text-gray-400">…</span>@endif
                    <button wire:click="gotoPage({{ $lp }})" class="px-3 py-1.5 text-sm rounded-lg border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">{{ $lp }}</button>
                @endif
                <button wire:click="nextPage" @disabled($this->transactions->onLastPage())
                    class="flex items-center gap-1 px-3 py-1.5 text-sm rounded-lg border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed transition-colors">
                    Selanjutnya
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
        @endif
    </div>

    {{-- ───────────── MODAL DETAIL LAPORAN VOID ───────────── --}}
    @if($showDetailModal && $selectedTransaction)
        <div class="fixed inset-0 z-[100001] flex flex-col bg-gray-100 dark:bg-gray-900 overflow-y-auto">

            {{-- Header Top Bar --}}
            <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-3 flex items-center justify-between sticky top-0 z-10 shadow-xs">
                <div class="flex items-center gap-4">
                    <button wire:click="closeDetail" type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors p-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Detail Laporan Void</h2>
                </div>

                {{-- Logo --}}
                <div class="flex items-center gap-1.5">
                    <span class="text-2xl font-black text-emerald-400 tracking-tighter">Alas Daun</span>
                </div>

                <div class="w-16"></div>
            </div>

            {{-- Body Content --}}
            <div class="flex-1 p-4 md:p-8 max-w-4xl w-full mx-auto space-y-6">

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-8 space-y-8">

                    {{-- Title Void Icon --}}
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-teal-500 flex items-center justify-center text-white font-bold text-sm">
                            AD
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">Void</h3>
                    </div>

                    {{-- Banner Card --}}
                    <div class="bg-emerald-500 rounded-xl p-6 text-white flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-sm">
                        <div class="space-y-1">
                            <p class="text-xs font-medium text-emerald-100">Nomor Nota</p>
                            <p class="text-lg font-bold tracking-wide">{{ $selectedTransaction->code }}</p>
                            <p class="text-xs text-emerald-100">
                                Tanggal Transaksi: {{ \Carbon\Carbon::parse($selectedTransaction->created_at)->locale('id')->isoFormat('D MMM Y, HH:mm') }}
                            </p>
                        </div>
                        <div class="text-left sm:text-right space-y-1">
                            <p class="text-xs font-medium text-emerald-100">Total Pembayaran</p>
                            <p class="text-2xl font-extrabold">Rp {{ number_format($selectedTransaction->subtotal ?? 0, 2, ',', '.') }}</p>
                        </div>
                    </div>

                    {{-- Table Products --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="border-b border-gray-100 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-bold uppercase tracking-wider">
                                    <th class="pb-3 min-w-[200px]">NAMA PRODUK</th>
                                    <th class="pb-3 text-center">JUMLAH</th>
                                    <th class="pb-3 text-right">HARGA SATUAN</th>
                                    <th class="pb-3 text-right">HARGA TOTAL</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                                @forelse($selectedTransaction->items as $item)
                                    <tr class="text-gray-700 dark:text-gray-300">
                                        <td class="py-4">
                                            <p class="font-bold text-gray-900 dark:text-white text-sm">{{ $item->product?->name ?? 'Salmon Skin' }}</p>
                                            <p class="text-gray-500 dark:text-gray-400 text-xs mt-0.5">Satuan: Porsi</p>
                                            <p class="text-gray-500 dark:text-gray-400 text-xs">Catatan: Tidak ada catatan</p>
                                        </td>
                                        <td class="py-4 text-center font-medium">{{ $item->quantity ?? 1 }} item</td>
                                        <td class="py-4 text-right font-medium">Rp {{ number_format($item->price ?? $selectedTransaction->subtotal, 2, ',', '.') }}</td>
                                        <td class="py-4 text-right font-bold text-gray-900 dark:text-white">Rp {{ number_format(($item->quantity ?? 1) * ($item->price ?? $selectedTransaction->subtotal), 2, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr class="text-gray-700 dark:text-gray-300">
                                        <td class="py-4">
                                            <p class="font-bold text-gray-900 dark:text-white text-sm">Salmon Skin</p>
                                            <p class="text-gray-500 dark:text-gray-400 text-xs mt-0.5">Satuan: Porsi</p>
                                            <p class="text-gray-500 dark:text-gray-400 text-xs">Catatan: Tidak ada catatan</p>
                                        </td>
                                        <td class="py-4 text-center font-medium">1 item</td>
                                        <td class="py-4 text-right font-medium">Rp 15.000,00</td>
                                        <td class="py-4 text-right font-bold text-gray-900 dark:text-white">Rp 15.000,00</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Mini Pagination Inside Card --}}
                    @php
                        $itemCount = $selectedTransaction->items?->count() ?? 0;
                    @endphp
                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 pt-2 border-t border-gray-50 dark:border-gray-700/50">
                        <div class="flex items-center gap-1.5">
                            <span>Tampilkan:</span>
                            <select class="border border-gray-200 dark:border-gray-700 rounded px-1.5 py-0.5 bg-white dark:bg-gray-800 text-xs">
                                <option>{{ max(10, $itemCount) }}</option>
                            </select>
                            <span class="ml-2">Ditampilkan {{ $itemCount > 0 ? 1 : 0 }} - {{ $itemCount }} dari {{ $itemCount }} data</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="flex items-center gap-1 hover:text-teal-600 disabled:opacity-40" disabled>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                Sebelumnya
                            </button>
                            <span class="w-5 h-5 bg-teal-500 text-white rounded flex items-center justify-center font-bold text-xs">1</span>
                            <button class="flex items-center gap-1 hover:text-teal-600 disabled:opacity-40" disabled>
                                Selanjutnya
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- Detail Info Breakdown --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">

                        {{-- Left Info --}}
                        <div class="space-y-6 text-xs text-gray-700 dark:text-gray-300">
                            <div>
                                <h4 class="font-bold text-gray-900 dark:text-white text-sm mb-1">Catatan Pesanan</h4>
                                <p class="text-gray-600 dark:text-gray-400">
                                    {{ $selectedTransaction->additional_info ?? $selectedTransaction->manual_discount_note ?? '-' }}
                                </p>
                            </div>

                            <div class="space-y-2">
                                <h4 class="font-bold text-gray-900 dark:text-white text-sm">Detail Pemesanan</h4>
                                <div class="grid grid-cols-2 gap-y-1.5">
                                    <span class="text-gray-500 dark:text-gray-400">Dilayani oleh</span>
                                    <span>{{ $selectedTransaction->paymentProcessedBy?->name ?? $selectedTransaction->user?->name ?? '-' }}</span>

                                    <span class="text-gray-500 dark:text-gray-400">Order</span>
                                    <span>{{ $selectedTransaction->name ?? '-' }}</span>

                                    <span class="text-gray-500 dark:text-gray-400">Kasir</span>
                                    <span>{{ $selectedTransaction->paymentProcessedBy?->name ?? auth()->user()->name }}</span>

                                    <span class="text-gray-500 dark:text-gray-400">Pelanggan</span>
                                    <span>{{ $selectedTransaction->member?->name ?? $selectedTransaction->name ?? '-' }}</span>

                                    <span class="text-gray-500 dark:text-gray-400">Tipe Pesanan</span>
                                    <span>
                                        @if($selectedTransaction->order_type === 'dine_in')
                                            Dine In
                                        @elseif($selectedTransaction->order_type === 'take_away')
                                            Take Away
                                        @else
                                            {{ $selectedTransaction->order_type ?? '-' }}
                                        @endif
                                    </span>
                                    <span class="text-gray-500 dark:text-gray-400">Jumlah Pax</span>
                                    <span>{{ $selectedTransaction->pax ?? 1 }} Person</span>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <h4 class="font-bold text-gray-900 dark:text-white text-sm">Alasan Void</h4>
                                <div class="grid grid-cols-2 gap-y-1.5">
                                    <span class="text-gray-500 dark:text-gray-400">Diotorisasi oleh</span>
                                    <span>{{ $selectedTransaction->voidedBy?->name ?? '-' }}</span>

                                    <span class="text-gray-500 dark:text-gray-400">Waktu Void</span>
                                    <span>
                                        {{ $selectedTransaction->voided_at ? \Carbon\Carbon::parse($selectedTransaction->voided_at)->locale('id')->isoFormat('D MMMM Y, HH:mm') : '-' }}
                                    </span>

                                    <span class="text-gray-500 dark:text-gray-400">Alasan Void</span>
                                    <span>{{ $selectedTransaction->void_reason ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Right Summary Total --}}
                        <div class="flex flex-col justify-end space-y-2.5 text-xs">
                            <div class="flex items-center justify-between text-gray-600 dark:text-gray-400 font-medium">
                                <span>Subtotal {{ $itemCount }} Produk</span>
                                <span class="font-bold text-gray-900 dark:text-white">Rp {{ number_format($selectedTransaction->subtotal ?? 0, 2, ',', '.') }}</span>
                            </div>

                            <div class="border-t border-gray-100 dark:border-gray-700 pt-3 flex items-center justify-between">
                                <span class="text-base font-extrabold text-gray-900 dark:text-white">Total</span>
                                <span class="text-xl font-black text-gray-900 dark:text-white">Rp {{ number_format($selectedTransaction->subtotal ?? 0, 2, ',', '.') }}</span>
                            </div>
                        </div>

                    </div>

                    {{-- Action Button --}}
                    <div class="flex justify-end pt-4">
                        <button wire:click="closeDetail" type="button" class="px-6 py-2 border border-teal-500 text-teal-500 hover:bg-teal-50 dark:hover:bg-teal-950/30 rounded-lg text-xs font-semibold transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>

            </div>

        </div>
    @endif

</div>
