<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Void</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header {
            margin-bottom: 20px;
            border-b: 2px solid #0d9488;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #0d9488;
            text-transform: uppercase;
        }
        .header p {
            margin: 4px 0 0 0;
            color: #666;
            font-size: 11px;
        }
        .summary-box {
            width: 100%;
            margin-bottom: 20px;
        }
        .summary-card {
            width: 48%;
            float: left;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px 14px;
            box-sizing: border-box;
        }
        .summary-card.right {
            float: right;
        }
        .summary-title {
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: bold;
        }
        .summary-value {
            font-size: 16px;
            font-weight: bold;
            color: #0f172a;
            margin-top: 4px;
        }
        .clear {
            clear: both;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #f1f5f9;
            color: #475569;
            font-size: 10px;
            text-transform: uppercase;
            text-align: left;
            padding: 8px;
            border-bottom: 2px solid #cbd5e1;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
            font-size: 10px;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
            background: #ccfbf1;
            color: #0f766e;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 9px;
            color: #94a3b8;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Void</h1>
        <p>Periode: <?php echo e(\Carbon\Carbon::parse($startDate)->locale('id')->isoFormat('D MMMM Y')); ?> &ndash; <?php echo e(\Carbon\Carbon::parse($endDate)->locale('id')->isoFormat('D MMMM Y')); ?></p>
    </div>

    <div class="summary-box">
        <div class="summary-card">
            <div class="summary-title">Total Nilai Void</div>
            <div class="summary-value" style="color: #e11d48;">
                Rp <?php echo e(number_format($summary['total_void'], 0, ',', '.')); ?>

            </div>
        </div>
        <div class="summary-card right">
            <div class="summary-title">Total Transaksi Void</div>
            <div class="summary-value">
                <?php echo e($summary['total_transaksi']); ?> Transaksi
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="10%">No Nota</th>
                <th width="14%">Waktu Void</th>
                <th width="14%">Waktu Order</th>
                <th width="12%">Kasir</th>
                <th width="12%">Otorisasi</th>
                <th>Produk</th>
                <th width="12%" class="text-right">Subtotal Void</th>
                <th width="10%" class="text-center">Jenis Order</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <tr>
                    <td style="font-weight: bold; color: #0d9488;"><?php echo e($t->code); ?></td>
                    <td><?php echo e($t->voided_at ? \Carbon\Carbon::parse($t->voided_at)->locale('id')->isoFormat('D MMM Y, HH:mm') : '-'); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($t->created_at)->locale('id')->isoFormat('D MMM Y, HH:mm')); ?></td>
                    <td><?php echo e($t->user?->name ?? '-'); ?></td>
                    <td><?php echo e($t->voidedBy?->name ?? '-'); ?></td>
                    <td>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $t->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div>• <?php echo e($item->product?->name ?? 'Produk'); ?> (x<?php echo e($item->quantity ?? 1); ?>)</div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </td>
                    <td class="text-right" style="font-weight: bold;">
                        Rp <?php echo e(number_format($t->subtotal ?? 0, 0, ',', '.')); ?>

                    </td>
                    <td class="text-center">
                        <span class="badge">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($t->order_type === 'dine_in'): ?>
                                Dine In
                            <?php elseif($t->order_type === 'take_away'): ?>
                                Take Away
                            <?php else: ?>
                                <?php echo e($t->order_type ?? '-'); ?>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </span>
                    </td>
                </tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <tr>
                    <td colspan="8" class="text-center" style="padding: 20px; color: #94a3b8;">
                        Tidak ada data void pada periode ini.
                    </td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        Dicetak otomatis pada <?php echo e(\Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y, HH:mm')); ?>

    </div>

</body>
</html>
<?php /**PATH D:\farhan\projects\freelance\pos-restoran-v2\resources\views/pdf/void-report-pdf.blade.php ENDPATH**/ ?>