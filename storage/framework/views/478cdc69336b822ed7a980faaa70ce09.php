<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <script>
        window.APP_AUTHENTICATED = <?php echo json_encode(auth()->check(), 15, 512) ?>;
        window.APP_CAN_CASHIER_ORDERS = <?php echo json_encode(auth()->user()?->can('pos.access') ?? false, 15, 512) ?>;
    </script>

    <title><?php echo e($title ?? 'Dashboard'); ?> | Restaurant - Alas Bu Yanti</title>
    <link rel="icon" href="<?php echo e(asset('assets/images/logoesb.png')); ?>" type="image/png">
    <link rel="manifest" href="<?php echo e(route('admin.manifest')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


    <script>
        window.PRINTER_DEBUG = false;
    </script>

    <script defer src="<?php echo e(asset('js/notification-system/notification-manager.js')); ?>"></script>

    <?php $v = time(); ?>
    <script defer src="<?php echo e(asset('js/printer-system/bluetooth-service.js')); ?>?v=<?php echo e($v); ?>"></script>
    <script defer src="<?php echo e(asset('js/printer-system/receipt-templates.js')); ?>?v=<?php echo e($v); ?>"></script>
    <script defer src="<?php echo e(asset('js/printer-system/print-queue.js')); ?>?v=<?php echo e($v); ?>"></script>
    <script defer src="<?php echo e(asset('js/printer-system/printer-manager.js')); ?>?v=<?php echo e($v); ?>"></script>
    <script defer src="<?php echo e(asset('js/printer-system/printer-ui.js')); ?>?v=<?php echo e($v); ?>"></script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                init() {
                    const savedTheme = localStorage.getItem('theme');
                    const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' :
                        'light';
                    this.theme = savedTheme || systemTheme;
                    this.updateTheme();
                },
                theme: 'light',
                toggle() {
                    this.theme = this.theme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('theme', this.theme);
                    this.updateTheme();
                },
                updateTheme() {
                    const html = document.documentElement;
                    const body = document.body;
                    if (this.theme === 'dark') {
                        html.classList.add('dark');
                        if (body) body.classList.add('dark', 'bg-gray-900');
                    } else {
                        html.classList.remove('dark');
                        if (body) body.classList.remove('dark', 'bg-gray-900');
                    }
                }
            });

            Alpine.store('sidebar', {
                isEsbModalOpen: false, 
                toggleEsbModal() {
                    this.isEsbModalOpen = !this.isEsbModalOpen;
                },
                get isExpanded() {
                    const saved = localStorage.getItem('sidebar-expanded');
                    return saved === null ? window.innerWidth >= 1024 : saved !== 'false';
                },
                set isExpanded(val) {
                    localStorage.setItem('sidebar-expanded', val);
                },
                isMobileOpen: false,
                isHovered: false,
                isMobile: window.innerWidth <= 820,
                updateMobile() {
                    this.isMobile = window.innerWidth <= 820;
                },
                restoreState() {
                    const saved = localStorage.getItem('sidebar-expanded');
                    const width = window.innerWidth;
                    if (saved !== null) {
                        this.isExpanded = saved !== 'false';
                    }
                    if (width <= 820) {
                        this.isMobileOpen = false;
                        this.isExpanded = false;
                    }
                    this.isHovered = false;
                },
                toggleExpanded() {
                    const width = window.innerWidth;
                    if (width <= 820) {
                        this.isMobileOpen = !this.isMobileOpen;
                        this.isExpanded = this.isMobileOpen;
                    } else {
                        this.isExpanded = !this.isExpanded;
                        this.isMobileOpen = false;
                    }
                },
                toggleMobileOpen() {
                    this.isMobileOpen = !this.isMobileOpen;
                },
                setMobileOpen(val) {
                    this.isMobileOpen = val;
                },
                setHovered(val) {
                    if (window.innerWidth >= 1024 && !this.isExpanded) {
                        this.isHovered = val;
                    }
                }
            });
        });
    </script>
</head>

<body x-data="{ 'loaded': true }" x-init="const checkResponsive = () => {
    $store.sidebar.updateMobile();
    const width = window.innerWidth;
    if (width <= 820) {
        $store.sidebar.isExpanded = false;
        $store.sidebar.isMobileOpen = false;
    } else {
        const saved = localStorage.getItem('sidebar-expanded');
        if (saved !== null) {
            $store.sidebar.isExpanded = saved !== 'false';
        } else if (width >= 1024) {
            $store.sidebar.isExpanded = true;
        }
        $store.sidebar.isMobileOpen = false;
    }
};
checkResponsive();
window.addEventListener('resize', checkResponsive);" class="antialiased">
    <?php if (isset($component)) { $__componentOriginalb61632ad80e39a3770bbaf55089af949 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb61632ad80e39a3770bbaf55089af949 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.preloader','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.preloader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb61632ad80e39a3770bbaf55089af949)): ?>
<?php $attributes = $__attributesOriginalb61632ad80e39a3770bbaf55089af949; ?>
<?php unset($__attributesOriginalb61632ad80e39a3770bbaf55089af949); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb61632ad80e39a3770bbaf55089af949)): ?>
<?php $component = $__componentOriginalb61632ad80e39a3770bbaf55089af949; ?>
<?php unset($__componentOriginalb61632ad80e39a3770bbaf55089af949); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal9a4eafff4df50043677d39fbe586617f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a4eafff4df50043677d39fbe586617f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.loading-bar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.loading-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a4eafff4df50043677d39fbe586617f)): ?>
<?php $attributes = $__attributesOriginal9a4eafff4df50043677d39fbe586617f; ?>
<?php unset($__attributesOriginal9a4eafff4df50043677d39fbe586617f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a4eafff4df50043677d39fbe586617f)): ?>
<?php $component = $__componentOriginal9a4eafff4df50043677d39fbe586617f; ?>
<?php unset($__componentOriginal9a4eafff4df50043677d39fbe586617f); ?>
<?php endif; ?>

    <div class="min-h-screen xl:flex">
        <?php echo $__env->make('layouts.backdrop', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('layouts.sidebar', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1860390039-0', $__key);

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

        <div class="flex-1 transition-all duration-300 ease-in-out relative z-10 ml-0" :class="{
                'lg:ml-[60px]': true,
                'lg:ml-[0px] :ml-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
                'sm:translate-x-[0px]': $store.sidebar.isExpanded,
                'translate-x-0': !$store.sidebar.isExpanded
            }">

            <div x-show="$store.sidebar.isExpanded && window.innerWidth >= 1024"
                @click="$store.sidebar.toggleExpanded()" class="fixed inset-0 z-[999] bg-gray-900/50"></div>

            <?php echo $__env->make('layouts.app-header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="md:p-0">
                <?php echo e($slot); ?>

            </div>
        </div>
    </div>

    <!-- Modal POS Print -->
    <div x-data="posPrintModal" x-init="init()" x-show="open" class="fixed inset-0 z-[100000]" style="display: none;"
        aria-modal="true" role="dialog">
        <template x-if="open">
            <div class="absolute inset-0">
                <div class="absolute inset-0 bg-black/50" @click="close()"></div>
                <div class="absolute inset-0 flex items-center justify-center p-4">
                    <div class="relative flex max-h-[85vh] w-full max-w-2xl flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900">
                        <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                            <div>
                                <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Cetak Struk</h3>
                            </div>
                            <button type="button" @click="close()" class="text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-gray-400">Tutup</button>
                        </div>
                        <!-- Konten modal print lainnya ... -->
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Modal Baru: ESB Order Report -->
   <?php echo $__env->make('livewire.transactions.esb-order-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php app("livewire")->forceAssetInjection(); ?><div x-persist="<?php echo e('toast-center'); ?>">
    <?php if (isset($component)) { $__componentOriginal10afb6a75a927024643c78d9c8aff657 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal10afb6a75a927024643c78d9c8aff657 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.toast-center','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('common.toast-center'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal10afb6a75a927024643c78d9c8aff657)): ?>
<?php $attributes = $__attributesOriginal10afb6a75a927024643c78d9c8aff657; ?>
<?php unset($__attributesOriginal10afb6a75a927024643c78d9c8aff657); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal10afb6a75a927024643c78d9c8aff657)): ?>
<?php $component = $__componentOriginal10afb6a75a927024643c78d9c8aff657; ?>
<?php unset($__componentOriginal10afb6a75a927024643c78d9c8aff657); ?>
<?php endif; ?>
    </div>

    <style>
        .flatpickr-calendar { z-index: 1000000 !important; }
        [x-cloak] { display: none !important; }
    </style>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>

    <script>
        // Sisa script aslinya tetap sama...
        document.addEventListener('DOMContentLoaded', () => {
            const sources = <?php echo json_encode($printerSourcesForJs ?? [], 15, 512) ?>;
            window.PRINTER_SOURCES = Array.isArray(sources) ? sources : [];
            if (window.PrinterManager?.configureSources) {
                window.PrinterManager.configureSources(window.PRINTER_SOURCES);
            }
        });
        // ... (lanjutan script asli Anda)
    </script>
</body>
</html><?php /**PATH D:\farhan\project-freelance\pos-restoran-v2\resources\views/layouts/app.blade.php ENDPATH**/ ?>