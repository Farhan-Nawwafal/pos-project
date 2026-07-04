<div class="min-h-screen bg-gray-50 font-poppins">
    <header class="bg-white border-b border-gray-200">
        <div class="px-4 py-4 flex items-center gap-3">
            <div class="bg-white p-2 rounded-xl border border-gray-200">
                <img src="<?php echo e(asset('storage/' . $setting->store_logo ?? 'logo.png')); ?>" alt="<?php echo e($setting->store_name ?? 'Store'); ?>" class="w-8 h-8">
            </div>
            <div class="min-w-0">
                <div class="text-sm font-bold text-gray-900 truncate"><?php echo e($setting->store_name ?? 'Self Order'); ?></div>
                <div class="text-xs text-gray-500 truncate">Meja #<?php echo e($tableNumber ?? '-'); ?></div>
            </div>
        </div>
    </header>

    <main class="px-4 py-4 space-y-4 pb-10">
        <div class="bg-white border border-gray-200 rounded-2xl p-4">
            <div class="text-sm font-bold text-gray-900">Mulai</div>
            <div class="text-xs text-gray-500 mt-1">Pilih cara masuk untuk mulai memesan.</div>

            <div class="grid grid-cols-2 gap-2 mt-4">
                <button
                    type="button"
                    wire:click="setTab('guest')"
                    class="<?php echo e($tab === 'guest' ? 'bg-primary-60 text-white border-primary-60' : 'bg-white text-gray-900 border-gray-200'); ?> border rounded-xl px-3 py-3 text-sm font-semibold">
                    Sebagai Tamu
                </button>
                <button
                    type="button"
                    wire:click="setTab('member')"
                    class="<?php echo e($tab === 'member' || $tab === 'register' ? 'bg-primary-60 text-white border-primary-60' : 'bg-white text-gray-900 border-gray-200'); ?> border rounded-xl px-3 py-3 text-sm font-semibold">
                    Sebagai Member
                </button>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-4">
            <div class="text-xs font-semibold text-gray-700">Benefit Member</div>
            <div class="mt-2 grid grid-cols-3 gap-2">
                <div class="rounded-xl bg-gray-50 border border-gray-200 p-3">
                    <div class="text-[10px] text-gray-500">Poin</div>
                    <div class="text-sm font-bold text-gray-900 mt-1">Reward</div>
                </div>
                <div class="rounded-xl bg-gray-50 border border-gray-200 p-3">
                    <div class="text-[10px] text-gray-500">Promo</div>
                    <div class="text-sm font-bold text-gray-900 mt-1">Khusus</div>
                </div>
                <div class="rounded-xl bg-gray-50 border border-gray-200 p-3">
                    <div class="text-[10px] text-gray-500">Riwayat</div>
                    <div class="text-sm font-bold text-gray-900 mt-1">Order</div>
                </div>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($notice)): ?>
            <div class="bg-white border border-gray-200 rounded-2xl p-4">
                <div class="text-sm font-semibold text-gray-900">Info</div>
                <div class="text-xs text-gray-600 mt-1"><?php echo e($notice); ?></div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'guest'): ?>
            <div class="bg-white border border-gray-200 rounded-2xl p-4 space-y-3">
                <div class="text-sm font-bold text-gray-900">Data Pemesan (Tamu)</div>
                <div>
                    <label class="text-xs font-semibold text-gray-600">Nama</label>
                    <input
                        type="text"
                        wire:model.defer="guest_name"
                        aria-invalid="<?php echo e($errors->has('guest_name') ? 'true' : 'false'); ?>"
                        aria-describedby="<?php echo e($errors->has('guest_name') ? 'error-guest_name' : ''); ?>"
                        class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 text-sm focus:border-primary-60 focus:ring-2 focus:ring-primary-20"
                        placeholder="Nama pemesan">
                    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'guest_name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'guest_name']); ?>
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
                <div>
                    <label class="text-xs font-semibold text-gray-600">No. WhatsApp</label>
                    <input
                        type="tel"
                        wire:model.defer="guest_phone"
                        aria-invalid="<?php echo e($errors->has('guest_phone') ? 'true' : 'false'); ?>"
                        aria-describedby="<?php echo e($errors->has('guest_phone') ? 'error-guest_phone' : ''); ?>"
                        class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 text-sm focus:border-primary-60 focus:ring-2 focus:ring-primary-20"
                        placeholder="08xxxxxxxxxx">
                    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'guest_phone']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'guest_phone']); ?>
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
                <button
                    type="button"
                    wire:click="proceedGuest"
                    class="w-full rounded-xl bg-primary-60 hover:bg-primary-70 text-white py-3 font-bold text-sm">
                    Lanjut Pilih Menu
                </button>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'member'): ?>
            <div class="bg-white border border-gray-200 rounded-2xl p-4 space-y-3">
                <div class="text-sm font-bold text-gray-900">Masuk Member</div>
                <div class="text-xs text-gray-500">Masukkan email atau nomor WhatsApp member.</div>
                <div>
                    <label class="text-xs font-semibold text-gray-600">Email / WhatsApp</label>
                    <input
                        type="text"
                        wire:model.defer="member_identifier"
                        aria-invalid="<?php echo e($errors->has('member_identifier') ? 'true' : 'false'); ?>"
                        aria-describedby="<?php echo e($errors->has('member_identifier') ? 'error-member_identifier' : ''); ?>"
                        class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 text-sm focus:border-primary-60 focus:ring-2 focus:ring-primary-20"
                        placeholder="email@contoh.com / 08xxxxxxxxxx">
                    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'member_identifier']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'member_identifier']); ?>
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
                <button
                    type="button"
                    wire:click="proceedMember"
                    class="w-full rounded-xl bg-primary-60 hover:bg-primary-70 text-white py-3 font-bold text-sm">
                    Masuk & Lanjut Pesan
                </button>
                <button
                    type="button"
                    wire:click="setTab('register')"
                    class="w-full rounded-xl bg-white border border-gray-200 hover:border-primary-40 text-gray-900 py-3 font-bold text-sm">
                    Daftar Member Baru
                </button>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tab === 'register'): ?>
            <div class="bg-white border border-gray-200 rounded-2xl p-4 space-y-3">
                <div class="text-sm font-bold text-gray-900">Daftar Member</div>
                <div class="text-xs text-gray-500">Lengkapi data untuk mendapatkan promo dan poin.</div>

                <div>
                    <label class="text-xs font-semibold text-gray-600">Nama</label>
                    <input
                        type="text"
                        wire:model.defer="register_name"
                        aria-invalid="<?php echo e($errors->has('register_name') ? 'true' : 'false'); ?>"
                        aria-describedby="<?php echo e($errors->has('register_name') ? 'error-register_name' : ''); ?>"
                        class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 text-sm focus:border-primary-60 focus:ring-2 focus:ring-primary-20"
                        placeholder="Nama lengkap">
                    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'register_name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'register_name']); ?>
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

                <div>
                    <label class="text-xs font-semibold text-gray-600">Email</label>
                    <input
                        type="email"
                        wire:model.defer="register_email"
                        aria-invalid="<?php echo e($errors->has('register_email') ? 'true' : 'false'); ?>"
                        aria-describedby="<?php echo e($errors->has('register_email') ? 'error-register_email' : ''); ?>"
                        class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 text-sm focus:border-primary-60 focus:ring-2 focus:ring-primary-20"
                        placeholder="email@contoh.com">
                    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'register_email']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'register_email']); ?>
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

                <div>
                    <label class="text-xs font-semibold text-gray-600">No. WhatsApp</label>
                    <input
                        type="tel"
                        wire:model.defer="register_phone"
                        aria-invalid="<?php echo e($errors->has('register_phone') ? 'true' : 'false'); ?>"
                        aria-describedby="<?php echo e($errors->has('register_phone') ? 'error-register_phone' : ''); ?>"
                        class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 text-sm focus:border-primary-60 focus:ring-2 focus:ring-primary-20"
                        placeholder="08xxxxxxxxxx">
                    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'register_phone']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'register_phone']); ?>
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

                <div>
                    <label class="text-xs font-semibold text-gray-600">Provinsi</label>
                    <select
                        wire:model.live="register_province"
                        aria-invalid="<?php echo e($errors->has('register_province') ? 'true' : 'false'); ?>"
                        aria-describedby="<?php echo e($errors->has('register_province') ? 'error-register_province' : ''); ?>"
                        class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 text-sm focus:border-primary-60 focus:ring-2 focus:ring-primary-20">
                        <option value="">Pilih provinsi</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($p); ?>"><?php echo e($p); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'register_province']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'register_province']); ?>
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

                <div>
                    <label class="text-xs font-semibold text-gray-600">Kabupaten / Kota</label>
                    <select
                        wire:model.live="register_regency"
                        <?php if(empty($register_province)): ?> disabled <?php endif; ?>
                        aria-invalid="<?php echo e($errors->has('register_regency') ? 'true' : 'false'); ?>"
                        aria-describedby="<?php echo e($errors->has('register_regency') ? 'error-register_regency' : ''); ?>"
                        class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 text-sm focus:border-primary-60 focus:ring-2 focus:ring-primary-20 disabled:opacity-60">
                        <option value="">Pilih kabupaten/kota</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $regencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($r); ?>"><?php echo e($r); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'register_regency']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'register_regency']); ?>
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

                <div>
                    <label class="text-xs font-semibold text-gray-600">Kecamatan</label>
                    <select
                        wire:model.defer="register_district"
                        <?php if(empty($register_province) || empty($register_regency)): ?> disabled <?php endif; ?>
                        aria-invalid="<?php echo e($errors->has('register_district') ? 'true' : 'false'); ?>"
                        aria-describedby="<?php echo e($errors->has('register_district') ? 'error-register_district' : ''); ?>"
                        class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 text-sm focus:border-primary-60 focus:ring-2 focus:ring-primary-20 disabled:opacity-60">
                        <option value="">Pilih kecamatan</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($d); ?>"><?php echo e($d); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                    <?php if (isset($component)) { $__componentOriginalee90cf1aab8b8cee8674701eaf7a143f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee90cf1aab8b8cee8674701eaf7a143f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.input-error','data' => ['for' => 'register_district']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'register_district']); ?>
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

                <button
                    type="button"
                    wire:click="registerMember"
                    class="w-full rounded-xl bg-primary-60 hover:bg-primary-70 text-white py-3 font-bold text-sm">
                    Daftar & Lanjut Pesan
                </button>

                <button
                    type="button"
                    wire:click="setTab('member')"
                    class="w-full rounded-xl bg-white border border-gray-200 hover:border-primary-40 text-gray-900 py-3 font-bold text-sm">
                    Kembali
                </button>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </main>
</div>
<?php /**PATH C:\Users\Idin Naufal Hakim\Desktop\project\pos-project\resources\views\livewire\self-order\start.blade.php ENDPATH**/ ?>