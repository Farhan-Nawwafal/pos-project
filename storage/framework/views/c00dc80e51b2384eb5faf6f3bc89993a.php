<div class="min-h-screen bg-gray-50 font-poppins pb-32"
    x-data="{ method: '<?php echo e($hasUnpaidTransaction ? 'online' : (($payment_gateway_enabled ?? true) ? 'online' : 'cashier')); ?>', locked: <?php echo e($hasUnpaidTransaction ? 'true' : 'false'); ?> }">
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('self-order.components.page-title-nav', ['backCart' => true,'title' => 'Checkout','hasBack' => true,'hasFilter' => false]);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2598816109-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>

    <div class="max-w-md mx-auto px-4 space-y-5">
        
        <!-- Customer Information -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Informasi Pemesan
                </h2>
            </div>
            <div class="p-4 space-y-4">
                <!-- Table Number Display -->
                <div class="flex items-center justify-between p-3 rounded-xl bg-primary-10 border border-primary-20">
                    <div class="flex items-center gap-3">
                        <div class="p-1.5 bg-white rounded-lg shadow-sm">
                            <svg class="w-4 h-4 text-primary-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Nomor Meja</span>
                    </div>
                    <span class="text-lg font-bold text-primary-70">#<?php echo e($tableNumber); ?></span>
                </div>

                <!-- Form Fields -->
                <div class="space-y-3">
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Pemesan</label>
                        <input 
                            type="text" 
                            wire:model.live="name" 
                            aria-invalid="<?php echo e($errors->has('name') ? 'true' : 'false'); ?>"
                            aria-describedby="<?php echo e($errors->has('name') ? 'error-name' : ''); ?>"
                            placeholder="Nama Lengkap" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 focus:border-primary-60 focus:ring-2 focus:ring-primary-20 transition-all placeholder-gray-400 text-sm" 
                        />
                        <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'name']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $attributes = $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $component = $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">No. Telepon</label>
                        <input 
                            type="tel" 
                            wire:model.live="phone" 
                            aria-invalid="<?php echo e($errors->has('phone') ? 'true' : 'false'); ?>"
                            aria-describedby="<?php echo e($errors->has('phone') ? 'error-phone' : ''); ?>"
                            placeholder="08xxxxxxxxxx" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 focus:border-primary-60 focus:ring-2 focus:ring-primary-20 transition-all placeholder-gray-400 text-sm" 
                        />
                        <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'phone']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'phone']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $attributes = $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $component = $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Email (Opsional)</label>
                        <input 
                            type="email" 
                            wire:model.live="email" 
                            aria-invalid="<?php echo e($errors->has('email') ? 'true' : 'false'); ?>"
                            aria-describedby="<?php echo e($errors->has('email') ? 'error-email' : ''); ?>"
                            placeholder="email@example.com" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 focus:border-primary-60 focus:ring-2 focus:ring-primary-20 transition-all placeholder-gray-400 text-sm" 
                        />
                        <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'email']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'email']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $attributes = $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f)): ?>
<?php $component = $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f; ?>
<?php unset($__componentOriginalee90cf1aab8b8cee8674701eaf7a143f); ?>
<?php endif; ?>
                        <p class="text-xs text-gray-500">Struk digital akan dikirim melalui email.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Method -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
             <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                    Metode Pembayaran
                </h2>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-1 gap-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($payment_gateway_enabled ?? true) === true): ?>
                    <label class="relative flex items-center p-3.5 rounded-xl border-2 cursor-pointer transition-all duration-200 hover:bg-gray-50 group"
                        :class="[
                            method === 'online' ? 'border-primary-60 bg-primary-10/60' : 'border-gray-200',
                            locked ? 'opacity-50 cursor-not-allowed pointer-events-none' : ''
                        ]">
                        <input type="radio" name="method" form="checkout-form" value="online" class="sr-only" x-model="method" :disabled="locked">
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 rounded-full border flex items-center justify-center flex-shrink-0"
                                :class="method === 'online' ? 'border-primary-60' : 'border-gray-300'">
                                <div class="w-2.5 h-2.5 rounded-full bg-primary-60" x-show="method === 'online'"></div>
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-gray-900">QRIS / E-Wallet</span>
                                <span class="block text-xs text-gray-500">Biaya layanan 0,7%</span>
                            </div>
                        </div>
                    </label>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    
                    <label class="relative flex items-center p-3.5 rounded-xl border-2 cursor-pointer transition-all duration-200 hover:bg-gray-50 group"
                        :class="[
                            method === 'cashier' ? 'border-primary-60 bg-primary-10/60' : 'border-gray-200',
                            locked ? 'opacity-50 cursor-not-allowed pointer-events-none' : ''
                        ]">
                        <input type="radio" name="method" form="checkout-form" value="cashier" class="sr-only" x-model="method" :disabled="locked">
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 rounded-full border flex items-center justify-center flex-shrink-0"
                                :class="method === 'cashier' ? 'border-primary-60' : 'border-gray-300'">
                                <div class="w-2.5 h-2.5 rounded-full bg-primary-60" x-show="method === 'cashier'"></div>
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-gray-900">Bayar di Kasir</span>
                                <span class="block text-xs text-gray-500">Tanpa biaya admin</span>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((string) session('customer_type') === 'member' && is_numeric(session('member_id'))): ?>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary-60" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="9" stroke-width="2"></circle>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10l1 2h2l-1.5 1.5.5 2.5-2-1.5-2 1.5.5-2.5-1.5-1.5h2l1-2z"></path>
                        </svg>
                        Poin Member
                    </h2>
                </div>
                <div class="p-4 space-y-3">
                    <div class="flex items-center justify-between rounded-xl bg-gray-50 border border-gray-200 px-3 py-2">
                        <div class="text-xs font-semibold text-gray-600">Saldo Poin</div>
                        <div class="text-sm font-bold text-gray-900"><?php echo e(number_format((int) ($availablePoints ?? 0), 0, ',', '.')); ?></div>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((bool) ($canUsePoints ?? false)): ?>
                        <label class="flex items-center justify-between gap-3 rounded-xl border border-gray-200 bg-white px-3 py-3">
                            <div class="min-w-0">
                                <div class="text-sm font-bold text-gray-900">Gunakan Poin</div>
                                <div class="text-xs text-gray-500">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((int) ($pointsToRedeem ?? 0) > 0): ?>
                                        Pakai <?php echo e(number_format((int) $pointsToRedeem, 0, ',', '.')); ?> poin (Rp<?php echo e(number_format((int) ($pointDiscountAmount ?? 0), 0, ',', '.')); ?>)
                                    <?php else: ?>
                                        Aktifkan untuk memakai poin sebagai diskon
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                            <input type="checkbox" wire:model.live="usePoints" class="h-5 w-5 rounded border-gray-300 text-primary-60 focus:ring-primary-20" />
                        </label>
                    <?php else: ?>
                        <div class="rounded-xl border border-gray-200 bg-gray-50 px-3 py-3">
                            <div class="text-sm font-bold text-gray-900">Gunakan Poin</div>
                            <div class="mt-0.5 text-xs text-gray-600">
                                <?php echo e((string) (($pointsEligibilityMessage ?? '') !== '' ? $pointsEligibilityMessage : 'Poin belum memenuhi syarat untuk digunakan.')); ?>

                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($inventoryWarnings)): ?>
            <div class="rounded-2xl border border-warning-200 bg-warning-50 p-4">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 inline-flex h-8 w-8 items-center justify-center rounded-full bg-warning-600 text-white flex-shrink-0">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M12 3a9 9 0 100 18 9 9 0 000-18z"></path>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-warning-900">Informasi</p>
                        <p class="mt-0.5 text-xs text-warning-900/80">Sebagian item mungkin perlu konfirmasi ketersediaan di kasir.</p>
                        <ul class="mt-2 space-y-1 text-xs text-warning-900/90">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $inventoryWarnings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <li class="flex gap-2">
                                    <span class="mt-1 h-1.5 w-1.5 rounded-full bg-warning-700 flex-shrink-0"></span>
                                    <span class="min-w-0"><?php echo e($w); ?></span>
                                </li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                    Voucher
                </h2>
            </div>
            <div class="p-4 space-y-2">
                <input
                    type="text"
                    wire:model.live.debounce.500ms="voucherCodeInput"
                    placeholder="Masukkan kode voucher (opsional)"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 focus:border-primary-60 focus:ring-2 focus:ring-primary-20 transition-all placeholder-gray-400 text-sm"
                />
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(trim((string) ($voucherCodeInput ?? '')) !== ''): ?>
                    <p class="text-xs <?php echo e(($voucherValid ?? false) ? 'text-success-600' : 'text-gray-500'); ?>">
                        <?php echo e($voucherMessage); ?>

                    </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <?php
            $totalNoRounding = (int) (($netSubtotal ?? $subtotal) + $tax);
            $midtransFee = (int) round($totalNoRounding * 0.007);
            $totalWithFee = $totalNoRounding + $midtransFee;
        ?>

        <!-- Order Summary -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Ringkasan Pesanan
                </h3>
            </div>
            
            <div class="p-4 space-y-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
                        $hasDiscount = isset($item['price_afterdiscount']) && (int) $item['price_afterdiscount'] > 0 && (int) $item['price_afterdiscount'] < (int) $item['price'];
                        $price = $hasDiscount ? (int) $item['price_afterdiscount'] : (int) $item['price'];
                        $qty = (int) ($item['quantity'] ?? 1);
                        $lineSubtotal = $price * $qty;
                    ?>
                    <div class="flex gap-3">
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <h4 class="text-sm font-medium text-gray-900 line-clamp-2 leading-snug"><?php echo e($item['name']); ?></h4>
                                <span class="text-sm font-semibold text-gray-900 ml-2">
                                    Rp<?php echo e(number_format($lineSubtotal, 0, ',', '.')); ?>

                                </span>
                            </div>
                            <div class="text-xs text-gray-500 mt-1 flex items-center gap-2">
                                <span class="font-medium bg-gray-100 px-1.5 py-0.5 rounded text-gray-600"><?php echo e($qty); ?>x</span>
                                <span>@ Rp<?php echo e(number_format($price, 0, ',', '.')); ?></span>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($packageContentsByProductId[(int) ($item['id'] ?? 0)] ?? [])): ?>
                                <div class="mt-2 rounded-xl border border-gray-200 bg-gray-50 px-3 py-2">
                                    <div class="text-[10px] font-semibold uppercase tracking-wider text-gray-600">Isi Paket</div>
                                    <ul class="mt-1 space-y-0.5 text-xs text-gray-700">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ($packageContentsByProductId[(int) ($item['id'] ?? 0)] ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <li class="flex gap-2">
                                                <span class="mt-1 h-1.5 w-1.5 rounded-full bg-gray-400 flex-shrink-0"></span>
                                                <span class="min-w-0"><?php echo e($content); ?></span>
                                            </li>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </ul>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($item['note'])): ?>
                                <p class="text-[10px] text-gray-400 italic mt-1 line-clamp-1">"<?php echo e($item['note']); ?>"</p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="text-center py-6 text-gray-500">Keranjang kosong</div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($voucherDiscountAmount ?? 0) > 0): ?>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Diskon Voucher</span>
                    <span class="font-semibold text-gray-900">-Rp<?php echo e(number_format((int) $voucherDiscountAmount, 0, ",", ".")); ?></span>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($pointDiscountAmount ?? 0) > 0): ?>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Diskon Poin (<?php echo e(number_format((int) ($pointsToRedeem ?? 0), 0, ",", ".")); ?> poin)</span>
                    <span class="font-semibold text-gray-900">-Rp<?php echo e(number_format((int) ($pointDiscountAmount ?? 0), 0, ",", ".")); ?></span>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tax > 0): ?>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">PB1 (<?php echo e($taxRate); ?>%)</span>
                    <span class="font-semibold text-gray-900">Rp<?php echo e(number_format($tax, 0, ",", ".")); ?></span>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($rounding_adjustment != 0): ?>
                <div class="flex justify-between text-sm" x-show="method !== 'online'">
                    <span class="text-gray-600">Pembulatan</span>
                    <span class="font-semibold text-gray-900">Rp<?php echo e(number_format($rounding_adjustment, 0, ",", ".")); ?></span>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="flex justify-between text-sm" x-show="method === 'online'">
                    <span class="text-gray-600">Biaya Admin (0,7%)</span>
                    <span class="font-semibold text-gray-900">Rp<?php echo e(number_format($midtransFee, 0, ",", ".")); ?></span>
                </div>

                <div class="pt-4 border-t border-gray-100 flex justify-between text-base font-bold">
                    <span class="text-gray-900">Total</span>
                    <span class="text-primary-70" x-show="method !== 'online'">Rp<?php echo e(number_format($total, 0, ",", ".")); ?></span>
                    <span class="text-primary-70" x-show="method === 'online'">Rp<?php echo e(number_format($totalWithFee, 0, ",", ".")); ?></span>
                </div>
            </div>
        </div>

        <p class="text-[10px] text-center text-gray-400">
            Dengan melanjutkan, Anda menyetujui <a href="#" class="underline hover:text-gray-500">Syarat & Ketentuan</a> kami.
        </p>
    </div>

    <!-- Fixed Bottom Bar -->
    <div class="fixed bottom-0 inset-x-0 z-40 w-full max-w-md mx-auto bg-white border-t border-gray-100 p-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)]">
        <div class="max-w-md mx-auto flex items-center gap-4">
            <div class="flex-1">
                <p class="text-xs text-gray-500">Total Tagihan</p>
                <p class="text-xl font-bold text-primary-70" x-show="method !== 'online'">Rp<?php echo e(number_format($total, 0, ",", ".")); ?></p>
                <p class="text-xl font-bold text-primary-70" x-show="method === 'online'">Rp<?php echo e(number_format($totalWithFee, 0, ",", ".")); ?></p>
            </div>
            
            <div class="flex-1">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $hasUnpaidTransaction): ?>
                    <form id="checkout-form" action="<?php echo e(route('self-order.payment.pay')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="token" value="<?php echo e($paymentToken); ?>" />
                        <input type="hidden" name="method" x-bind:value="method" />
                        <input type="hidden" name="voucher_code" value="<?php echo e((string) ($voucherCodeInput ?? '')); ?>" />
                        <input type="hidden" name="use_points" value="<?php echo e(($usePoints ?? false) ? 1 : 0); ?>" />
                        <input type="hidden" name="points_to_redeem" value="<?php echo e((int) ($pointsToRedeem ?? 0)); ?>" />
                        <button 
                            <?php if(empty($name) || empty($phone)): ?> disabled <?php endif; ?> 
                            type="submit" 
                            name="action" 
                            value="pay" 
                            class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-primary-60 to-primary-70 hover:from-primary-70 hover:to-primary-80 text-white font-bold text-sm shadow-lg shadow-primary-60/30 transform active:scale-95 transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none flex items-center justify-center gap-2"
                        >
                            <span>Bayar</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                <?php else: ?>
                    <form action="<?php echo e(route('self-order.payment.pay')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="token" value="<?php echo e($paymentToken); ?>" />
                        <input type="hidden" name="method" x-bind:value="method" />
                        <input type="hidden" name="voucher_code" value="<?php echo e((string) ($voucherCodeInput ?? '')); ?>" />
                        <input type="hidden" name="use_points" value="<?php echo e(($usePoints ?? false) ? 1 : 0); ?>" />
                        <input type="hidden" name="points_to_redeem" value="<?php echo e((int) ($pointsToRedeem ?? 0)); ?>" />
                        <button 
                            type="submit" 
                            <?php if(empty($name) || empty($phone)): ?> disabled <?php endif; ?> 
                            name="action" 
                            value="continue" 
                            class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-primary-60 to-primary-70 hover:from-primary-70 hover:to-primary-80 text-white font-bold text-sm shadow-lg shadow-primary-60/30 transform active:scale-95 transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none flex items-center justify-center gap-2"
                        >
                            <span>Lanjut</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </button>
                    </form>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\resources\views\livewire\self-order\payment\checkout.blade.php ENDPATH**/ ?>