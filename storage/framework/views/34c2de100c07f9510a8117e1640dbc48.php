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
            Outlet: <?php echo e(optional($currentShift->cabang)->name ?? '-'); ?><br>
            Kasir : <?php echo e($currentShift->startedBy->name ?? '-'); ?><br>
            Mulai : <?php echo e($currentShift->started_at->format('d-m-Y H:i')); ?><br>
            Selesai: <?php echo e($currentShift->ended_at ? $currentShift->ended_at->format('d-m-Y H:i') : 'Belum Ditutup'); ?>

        </div>

        <div class="divider-solid"></div>
        <div class="text-center font-bold">SALES RECAP</div>
        <div class="divider-solid"></div>

        <div class="flex-between">
            <span>Total Sales</span>
            <span>Rp <?php echo e(number_format($salesTotal, 0, ',', '.')); ?></span>
        </div>
        <div class="flex-between">
            <span>Discount</span>
            <span>Rp <?php echo e(number_format($discount, 0, ',', '.')); ?></span>
        </div>
        <div class="flex-between">
            <span>Service Chg</span>
            <span>Rp <?php echo e(number_format($serviceCharge, 0, ',', '.')); ?></span>
        </div>
        <div class="flex-between">
            <span>Tax</span>
            <span>Rp <?php echo e(number_format($tax, 0, ',', '.')); ?></span>
        </div>

        <div class="divider"></div>

        <div class="flex-between font-bold">
            <span>NET SALES</span>
            <span>Rp <?php echo e(number_format($netSales, 0, ',', '.')); ?></span>
        </div>
        <div class="flex-between">
            <span>Total Bills</span>
            <span><?php echo e($numberOfBills); ?></span>
        </div>

        <div class="divider-solid"></div>
        <div class="text-center font-bold">PAYMENT RECAP</div>
        <div class="divider-solid"></div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $paymentRecaps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="flex-between">
                <span style="text-transform: uppercase;"><?php echo e($payment->payment_method); ?></span>
                <span>Rp <?php echo e(number_format($payment->total_amount, 0, ',', '.')); ?></span>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="text-center">Belum ada pembayaran</div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="divider"></div>

        <div class="flex-between font-bold">
            <span>TOTAL PAYMENT</span>
            <span>Rp <?php echo e(number_format($totalPayment, 0, ',', '.')); ?></span>
        </div>

        <div class="divider-solid"></div>

        <div class="text-center" style="font-size: 10px; margin-top: 10px;">
            Dicetak pada: <?php echo e(now()->format('d-m-Y H:i:s')); ?>

        </div>
        
        <div class="divider-solid"></div>
        <div class="text-center font-bold">ITEM TERJUAL</div>
        <div class="divider-solid"></div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $salesByMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="flex-between" style="margin-bottom: 3px;">
                <span style="width: 70%; word-break: break-all;">
                    <?php echo e($item->total_qty); ?>x <?php echo e($item->product->name ?? 'Produk Dihapus'); ?>

                </span>
                <span style="width: 30%; text-align: right;">
                    <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?>

                </span>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="text-center">Belum ada item terjual</div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customMenus->count() > 0): ?>
            <div class="divider-solid"></div>
            <div class="text-center font-bold">CUSTOM MENU</div>
            <div class="divider-solid"></div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $customMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="flex-between">
                    <span><?php echo e($custom->total_qty); ?>x <?php echo e($custom->item_name); ?></span>
                    <span><?php echo e(number_format($custom->total_amount, 0, ',', '.')); ?></span>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <script>
        window.onload = function () {
            window.print();
            // Opsional: Tutup tab secara otomatis setelah jendela print ditutup
            // window.onafterprint = function() { window.close(); };
        }
    </script>
</body>

</html><?php /**PATH D:\Shaall\PROJECT\pos-project\resources\views/components/day-start-end/shift-out.blade.php ENDPATH**/ ?>