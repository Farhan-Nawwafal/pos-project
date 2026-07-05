<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; -webkit-font-smoothing: antialiased;">
    <?php
        $setting = \App\Models\Setting::current();
        $publicStorageUrl = rtrim((string) config('filesystems.disks.public.url'), '/');
        $logoPath = trim((string) ($setting->store_logo ?? ''), '/');
        $logoUrl = $logoPath !== '' && $publicStorageUrl !== '' ? $publicStorageUrl.'/'.$logoPath : null;
        $logoHost = $logoUrl ? (string) (parse_url($logoUrl, PHP_URL_HOST) ?? '') : '';
        if (in_array($logoHost, ['127.0.0.1', 'localhost'], true)) {
            $logoUrl = null;
        }
        $storeName = (string) ($setting->store_name ?? config('app.name'));
        $storePhone = trim((string) ($setting->phone ?? ''));
        $storeAddress = trim((string) ($setting->address ?? ''));
        $brand = '#dc2626';
        $brandDark = '#b91c1c';
        $surface = '#ffffff';
        $background = '#f3f4f6';
        $ink = '#111827';
        $muted = '#64748b';
        $mutedLight = '#94a3b8';
        $paidAt = $transaction->paid_at ?? $transaction->updated_at;
        $detailUrl = route('self-order.payment.receipt', ['code' => $transaction->code, 'token' => $transaction->self_order_token]);
        $orderTypeLabel = \App\Helpers\DataLabelHelper::enum($transaction->order_type ?? null, 'order_type');
        $paymentMethodLabel = \App\Helpers\DataLabelHelper::enum($transaction->payment_method ?? null, 'payment_method');
        $subtotal = (int) ($transaction->subtotal ?? 0);
        $taxAmount = (int) ($transaction->tax_amount ?? 0);
        $taxPercentage = (string) ($transaction->tax_percentage ?? '');
        $roundingAmount = (int) ($transaction->rounding_amount ?? 0);
        $paymentFee = (int) ($transaction->payment_fee_amount ?? 0);
        $voucherDiscount = (int) ($transaction->voucher_discount_amount ?? 0);
        $voucherCode = trim((string) ($transaction->voucher_code ?? ''));
        $pointDiscount = (int) ($transaction->point_discount_amount ?? 0);
        $pointsRedeemed = (int) ($transaction->points_redeemed ?? 0);
        $manualDiscount = (int) ($transaction->manual_discount_amount ?? 0);
        $total = (int) ($transaction->total ?? 0);
        $cashReceived = (int) ($transaction->cash_received ?? 0);
        $cashChange = (int) ($transaction->cash_change ?? 0);
        $tableNumber = $transaction->diningTable?->table_number ? (string) $transaction->diningTable->table_number : '';
    ?>

    <div style="display:none!important; visibility:hidden; opacity:0; color:transparent; height:0; width:0; overflow:hidden; mso-hide:all;">
        Struk pembayaran #<?php echo e($transaction->code); ?> dari <?php echo e($storeName); ?>. Total Rp <?php echo e(number_format($total, 0, ',', '.')); ?>.
    </div>
    
    <div style="width: 100%; background-color: <?php echo e($background); ?>; padding: 32px 0;">
        <div style="max-width: 640px; margin: 0 auto; background-color: <?php echo e($surface); ?>; border-radius: 14px; box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08); overflow: hidden;">
            
            <div style="background-color: <?php echo e($brand); ?>; padding: 28px 28px 20px 28px; text-align: center;">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($logoUrl): ?>
                    <img src="<?php echo e($logoUrl); ?>" alt="<?php echo e($storeName); ?>" style="max-height: 56px; margin-bottom: 14px;">
                <?php else: ?>
                    <h1 style="color: #ffffff; margin: 0; font-size: 22px; font-weight: 800; letter-spacing: 0.2px;"><?php echo e($storeName); ?></h1>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($storeAddress !== ''): ?>
                    <div style="color: rgba(255, 255, 255, 0.92); font-size: 13px; margin-top: 6px; line-height: 1.4;"><?php echo e($storeAddress); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($storePhone !== ''): ?>
                    <div style="color: rgba(255, 255, 255, 0.92); font-size: 13px; margin-top: 4px;"><?php echo e($storePhone); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div style="background-color: <?php echo e($brandDark); ?>; color: #ffffff; padding: 14px 28px; text-align: center; font-weight: 800; font-size: 14px; letter-spacing: 0.3px;">
                PEMBAYARAN BERHASIL
            </div>

            <div style="padding: 26px 28px 10px 28px;">
                <div style="margin-bottom: 18px;">
                    <div style="font-size: 14px; color: #111827; font-weight: 800; margin-bottom: 6px;">Ringkasan Transaksi</div>
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 8px 0; color: <?php echo e($muted); ?>; font-size: 13px;">Kode Transaksi</td>
                            <td style="padding: 8px 0; text-align: right; font-weight: 800; color: <?php echo e($ink); ?>; font-size: 13px;">#<?php echo e($transaction->code); ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: <?php echo e($muted); ?>; font-size: 13px;">Tanggal</td>
                            <td style="padding: 8px 0; text-align: right; color: <?php echo e($ink); ?>; font-size: 13px;"><?php echo e($paidAt?->format('d M Y, H:i')); ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: <?php echo e($muted); ?>; font-size: 13px;">Metode Pembayaran</td>
                            <td style="padding: 8px 0; text-align: right; color: <?php echo e($ink); ?>; font-size: 13px;"><?php echo e($paymentMethodLabel); ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: <?php echo e($muted); ?>; font-size: 13px;">Tipe Pesanan</td>
                            <td style="padding: 8px 0; text-align: right; color: <?php echo e($ink); ?>; font-size: 13px;"><?php echo e($orderTypeLabel); ?></td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tableNumber !== ''): ?>
                        <tr>
                            <td style="padding: 8px 0; color: <?php echo e($muted); ?>; font-size: 13px;">Nomor Meja</td>
                            <td style="padding: 8px 0; text-align: right; color: <?php echo e($ink); ?>; font-size: 13px;"><?php echo e($tableNumber); ?></td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </table>
                </div>

                <div style="border-top: 1px solid #e5e7eb; margin: 18px 0;"></div>

                <div style="margin-bottom: 18px;">
                    <div style="font-size: 14px; color: #111827; font-weight: 800; margin-bottom: 6px;">Informasi Pelanggan</div>
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 6px 0; color: #64748b; font-size: 13px; width: 120px;">Nama</td>
                            <td style="padding: 6px 0; color: #111827; font-size: 13px;"><?php echo e($transaction->name); ?></td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($transaction->phone): ?>
                        <tr>
                            <td style="padding: 6px 0; color: #64748b; font-size: 13px;">No. HP</td>
                            <td style="padding: 6px 0; color: #111827; font-size: 13px;"><?php echo e($transaction->phone); ?></td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($transaction->email ?? '') !== ''): ?>
                        <tr>
                            <td style="padding: 6px 0; color: #64748b; font-size: 13px;">Email</td>
                            <td style="padding: 6px 0; color: #111827; font-size: 13px;"><?php echo e($transaction->email); ?></td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </table>
                </div>

                <div style="border-top: 1px solid #e5e7eb; margin: 18px 0;"></div>

                <div style="margin-bottom: 18px;">
                    <div style="font-size: 14px; color: #111827; font-weight: 800; margin-bottom: 10px;">Rincian Pesanan</div>
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead style="background-color: #f8fafc;">
                            <tr>
                                <th style="padding: 10px; text-align: left; font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 0.4px; border-bottom: 1px solid #e5e7eb;">Item</th>
                                <th style="padding: 10px; text-align: right; font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 0.4px; border-bottom: 1px solid #e5e7eb;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $transaction->transactionItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <tr>
                                <td style="padding: 12px 10px; border-bottom: 1px solid #f1f5f9;">
                                    <div style="font-weight: 800; color: #111827; font-size: 13px; line-height: 1.35;"><?php echo e($item->product->name ?? 'Item'); ?></div>
                                    <?php
                                        $variantDisplay = \App\Support\Products\ItemNameFormatter::displayVariantName((int) $item->product_id, $item->variant?->name);
                                    ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($variantDisplay !== ''): ?>
                                        <div style="font-size: 12px; color: #64748b; margin-top: 2px;">Varian: <?php echo e($variantDisplay); ?></div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($item->note)): ?>
                                        <div style="font-size: 12px; color: #64748b; margin-top: 2px;">Catatan: <?php echo e($item->note); ?></div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div style="font-size: 12px; color: #64748b; margin-top: 4px;"><?php echo e((int) $item->quantity); ?> x Rp <?php echo e(number_format((int) $item->price, 0, ',', '.')); ?></div>
                                </td>
                                <td style="padding: 12px 10px; text-align: right; vertical-align: top; border-bottom: 1px solid #f1f5f9; color: #111827; font-size: 13px; font-weight: 800;">
                                    Rp <?php echo e(number_format((int) $item->subtotal, 0, ',', '.')); ?>

                                </td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div style="border-top: 1px solid #e5e7eb; margin: 18px 0;"></div>

                <div style="background-color: #f8fafc; border-radius: 12px; padding: 18px;">
                    <div style="font-size: 14px; color: #111827; font-weight: 800; margin-bottom: 8px;">Rincian Pembayaran</div>
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 7px 0; color: #64748b; font-size: 13px;">Subtotal</td>
                            <td style="padding: 7px 0; text-align: right; color: #111827; font-size: 13px;">Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?></td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($voucherDiscount > 0): ?>
                        <tr>
                            <td style="padding: 7px 0; color: #64748b; font-size: 13px;">Diskon Voucher<?php echo e($voucherCode !== '' ? ' ('.$voucherCode.')' : ''); ?></td>
                            <td style="padding: 7px 0; text-align: right; color: #111827; font-size: 13px;">-Rp <?php echo e(number_format($voucherDiscount, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pointDiscount > 0): ?>
                        <tr>
                            <td style="padding: 7px 0; color: #64748b; font-size: 13px;">Diskon Poin<?php echo e($pointsRedeemed > 0 ? ' ('.number_format($pointsRedeemed, 0, ',', '.').' poin)' : ''); ?></td>
                            <td style="padding: 7px 0; text-align: right; color: #111827; font-size: 13px;">-Rp <?php echo e(number_format($pointDiscount, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($manualDiscount > 0): ?>
                        <tr>
                            <td style="padding: 7px 0; color: #64748b; font-size: 13px;">Diskon</td>
                            <td style="padding: 7px 0; text-align: right; color: #111827; font-size: 13px;">-Rp <?php echo e(number_format($manualDiscount, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($transaction->tax_amount > 0): ?>
                        <tr>
                            <td style="padding: 7px 0; color: #64748b; font-size: 13px;">Pajak PB1<?php echo e($taxPercentage !== '' ? ' ('.$taxPercentage.'%)' : ''); ?></td>
                            <td style="padding: 7px 0; text-align: right; color: #111827; font-size: 13px;">Rp <?php echo e(number_format($taxAmount, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentFee > 0): ?>
                        <tr>
                            <td style="padding: 7px 0; color: #64748b; font-size: 13px;">Biaya Admin</td>
                            <td style="padding: 7px 0; text-align: right; color: #111827; font-size: 13px;">Rp <?php echo e(number_format($paymentFee, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($roundingAmount !== 0): ?>
                        <tr>
                            <td style="padding: 7px 0; color: #64748b; font-size: 13px;">Pembulatan</td>
                            <td style="padding: 7px 0; text-align: right; color: #111827; font-size: 13px;">Rp <?php echo e(number_format($roundingAmount, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <tr>
                            <td style="padding-top: 12px; border-top: 1px dashed #cbd5e1; font-weight: 800; color: #111827; font-size: 15px;">Total Pembayaran</td>
                            <td style="padding-top: 12px; border-top: 1px dashed #cbd5e1; text-align: right; font-weight: 900; color: #dc2626; font-size: 15px;">Rp <?php echo e(number_format($total, 0, ',', '.')); ?></td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($transaction->payment_method ?? '') === 'cash' && $cashReceived > 0): ?>
                        <tr>
                            <td style="padding-top: 10px; color: #64748b; font-size: 13px;">Tunai Diterima</td>
                            <td style="padding-top: 10px; text-align: right; color: #111827; font-size: 13px;">Rp <?php echo e(number_format($cashReceived, 0, ',', '.')); ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 7px 0 0 0; color: #64748b; font-size: 13px;">Kembalian</td>
                            <td style="padding: 7px 0 0 0; text-align: right; color: #111827; font-size: 13px;">Rp <?php echo e(number_format($cashChange, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </table>
                </div>

                <div style="padding: 16px 0 6px 0; text-align: center;">
                    <a href="<?php echo e($detailUrl); ?>" style="display: inline-block; background-color: <?php echo e($brand); ?>; color: #ffffff; text-decoration: none; padding: 12px 18px; border-radius: 12px; font-weight: 800; font-size: 13px; letter-spacing: 0.2px;">Lihat Struk Digital</a>
                    <div style="margin-top: 10px; font-size: 12px; color: <?php echo e($muted); ?>; line-height: 1.45;">Jika tombol tidak bisa diklik, salin tautan ini ke browser:<br><span style="color: <?php echo e($ink); ?>;"><?php echo e($detailUrl); ?></span></div>
                </div>
            </div>

            <div style="background-color: #f8fafc; padding: 18px 28px; text-align: center; border-top: 1px solid #e5e7eb;">
                <p style="margin: 0; font-size: 14px; color: #111827; font-weight: 900;">Terima kasih telah memesan di <?php echo e($storeName); ?>.</p>
                <p style="margin: 6px 0 0 0; font-size: 12px; color: #64748b; line-height: 1.45;">Simpan email ini sebagai bukti pembayaran yang sah. Untuk pertanyaan atau koreksi pesanan, silakan hubungi kami.</p>
                
                <div style="margin-top: 14px; font-size: 12px; color: <?php echo e($mutedLight); ?>;">
                    &copy; <?php echo e(date('Y')); ?> <?php echo e($storeName); ?>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\resources\views\livewire\emails\receipt.blade.php ENDPATH**/ ?>