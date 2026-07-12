<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan Hari Ini</title>
    <style>
        /* Styling khusus struk thermal */
        body {
            font-family: 'Courier New', Courier, monospace;
            /* Font monospace paling aman untuk struk */
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .ticket {
            width: 58mm;
            /* Lebar standar struk thermal kecil. Ganti 80mm jika printer kasirnya lebar */
            max-width: 58mm;
            padding: 5mm;
            margin: auto;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        .divider-solid {
            border-top: 1px solid #000;
            margin: 5px 0;
        }

        .flex-between {
            display: flex;
            justify-content: space-between;
        }

        .mb-2 {
            margin-bottom: 10px;
        }

        /* Hilangkan margin/padding saat diprint sungguhan */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .ticket {
                width: 100%;
                max-width: 100%;
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <div class="text-center font-bold mb-2">
            === SHIFT OUT REPORT ===
        </div>

        <div>
            Outlet: {{ optional($currentShift->cabang)->name ?? '-' }}<br>
            Kasir : {{ $currentShift->startedBy->name ?? '-' }}<br>
            Mulai : {{ $currentShift->started_at->format('d-m-Y H:i') }}<br>
            Selesai: {{ $currentShift->ended_at ? $currentShift->ended_at->format('d-m-Y H:i') : 'Belum Ditutup' }}
        </div>

        <div class="divider-solid"></div>
        <div class="text-center font-bold">SALES RECAP</div>
        <div class="divider-solid"></div>

        <div class="flex-between">
            <span>Total Sales</span>
            <span>Rp {{ number_format($salesTotal, 0, ',', '.') }}</span>
        </div>
        <div class="flex-between">
            <span>Discount</span>
            <span>Rp {{ number_format($discount, 0, ',', '.') }}</span>
        </div>
        <div class="flex-between">
            <span>Service Chg</span>
            <span>Rp {{ number_format($serviceCharge, 0, ',', '.') }}</span>
        </div>
        <div class="flex-between">
            <span>Tax</span>
            <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
        </div>

        <div class="divider"></div>

        <div class="flex-between font-bold">
            <span>NET SALES</span>
            <span>Rp {{ number_format($netSales, 0, ',', '.') }}</span>
        </div>
        <div class="flex-between">
            <span>Total Bills</span>
            <span>{{ $numberOfBills }}</span>
        </div>

        <div class="divider-solid"></div>
        <div class="text-center font-bold">PAYMENT RECAP</div>
        <div class="divider-solid"></div>

        @forelse($paymentRecaps as $payment)
            <div class="flex-between">
                <span style="text-transform: uppercase;">{{ $payment->payment_method }}</span>
                <span>Rp {{ number_format($payment->total_amount, 0, ',', '.') }}</span>
            </div>
        @empty
            <div class="text-center">Belum ada pembayaran</div>
        @endforelse

        <div class="divider"></div>

        <div class="flex-between font-bold">
            <span>TOTAL PAYMENT</span>
            <span>Rp {{ number_format($totalPayment, 0, ',', '.') }}</span>
        </div>

        <div class="divider-solid"></div>

        <div class="text-center" style="font-size: 10px; margin-top: 10px;">
            Dicetak pada: {{ now()->format('d-m-Y H:i:s') }}
        </div>
        {{-- BAGIAN SALES MENU --}}
        <div class="divider-solid"></div>
        <div class="text-center font-bold">ITEM TERJUAL</div>
        <div class="divider-solid"></div>

        @forelse($salesByMenus as $item)
            <div class="flex-between" style="margin-bottom: 3px;">
                <span style="width: 70%; word-break: break-all;">
                    {{ $item->total_qty }}x {{ $item->product->name ?? 'Produk Dihapus' }}
                </span>
                <span style="width: 30%; text-align: right;">
                    {{ number_format($item->subtotal, 0, ',', '.') }}
                </span>
            </div>
        @empty
            <div class="text-center">Belum ada item terjual</div>
        @endforelse

        {{-- BAGIAN CUSTOM MENU (Hanya Tampil Jika Ada) --}}
        @if($customMenus->count() > 0)
            <div class="divider-solid"></div>
            <div class="text-center font-bold">CUSTOM MENU</div>
            <div class="divider-solid"></div>
            @foreach($customMenus as $custom)
                <div class="flex-between">
                    <span>{{ $custom->total_qty }}x {{ $custom->item_name }}</span>
                    <span>{{ number_format($custom->total_amount, 0, ',', '.') }}</span>
                </div>
            @endforeach
        @endif
    </div>

    {{-- Script untuk memicu dialog print secara otomatis --}}
    <script>
        window.onload = function () {
            window.print();
            // Opsional: Tutup tab secara otomatis setelah jendela print ditutup
            // window.onafterprint = function() { window.close(); };
        }
    </script>
</body>

</html>