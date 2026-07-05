<?php

namespace App\Livewire\Pos;

use App\Events\SelfOrderPaymentUpdated;
use App\Models\Category;
use App\Models\DiningTable;
use App\Models\Member;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\TransactionEvent;
use App\Models\TransactionItem;
use App\Models\User;
use App\Models\VoucherCode;
use App\Models\VoucherRedemption;
use App\Services\Inventory\VariantIngredientStockStatusService;
use App\Services\Printing\PosPrintPayloadService;
use App\Support\Products\ItemNameFormatter;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class PosPage extends Component
{
    public string $title = 'POS';

    public string $activeTab = 'pos';

    public string $search = '';

    public string $scanCode = '';

    public string $tableRange = '1-50';

    public ?int $selectedCategoryId = null;

    public string $orderType = 'dine_in';

    public ?int $selectedTableId = null;

    public bool $tableModalOpen = false;

    public bool $variantModalOpen = false;

    public ?int $variantProductId = null;

    public array $variantOptions = [];

    public bool $complexPackageModalOpen = false;

    public ?int $complexPackageParentVariantId = null;

    public array $complexPackageComponents = [];

    public ?int $editingComplexPackageCartIndex = null;

    public array $cartItems = [];

    public int $subtotal = 0;

    public int $netSubtotal = 0;

    public int $voucherDiscountAmount = 0;

    public ?string $voucherCodeInput = null;

    public string $voucherMessage = '';

    public bool $voucherValid = false;

    public array $voucherAllocations = [];

    public bool $cartLocked = false;

    public ?string $lockedVoucherCode = null;

    public int $lockedVoucherDiscountAmount = 0;

    public array $lockedVoucherAllocations = [];

    public int $lockedPointsToRedeem = 0;

    public int $lockedPointDiscountAmount = 0;

    public ?int $lockedMemberId = null;

    public ?string $lockedCustomerName = null;

    public ?string $lockedCustomerPhone = null;

    public ?string $manualDiscountType = null;

    public ?int $manualDiscountValue = null;

    public int $manualDiscountAmount = 0;

    public ?string $manualDiscountNote = null;

    public int $discountTotalAmount = 0;

    public int $memberPoints = 0;

    public bool $redeemPoints = false;

    public int $pointDiscountAmount = 0;

    public int $pointsToRedeem = 0;

    public int $minRedemptionPoints = 0;

    public float $pointRedemptionValue = 0;

    public ?float $taxRate = null;

    public int $taxAmount = 0;

    public ?float $serviceRate = null;

    public int $serviceAmount = 0;

    public int $roundingAmount = 0;

    public int $total = 0;

    public int $roundingBase = 100;

    public bool $discountAppliesBeforeTax = true;

    public bool $checkoutModalOpen = false;

    public int $checkoutStep = 1;

    public bool $savePendingModalOpen = false;

    public bool $pendingOrdersModalOpen = false;

    public ?int $editingTransactionId = null;

    public ?int $memberId = null;

    public string $customerName = '';

    public ?string $customerPhone = null;

    public string $paymentMethod = 'cash';

    public ?string $cashReceived = null;

    public int $cashChange = 0;

    public array $productCards = [];

    public array $variantStockStatuses = [];

    public bool $voidItemModalOpen = false;

    public ?int $voidItemIndex = null;

    public string $voidItemReason = '';

    public string $voidItemPin = '';

    public ?int $voidItemApproverId = null;

    public $productPage = 1;

    public $selectTableModalOpen = false;
    public $tableToSelect = null;
    public $tableToSelectLabel = '';
    public $numberOfPax = 1; // Default pax diisi 1

    // State untuk mengontrol buka/tutup modal Scan / Input
    public $scanInputModalOpen = false;
    public string $esbOrderIdInput = '';

    // Properti pengikat data (wire:model) di dalam modal Scan / Input
    public $transactionBarcode = '';
    public $tableNumberInput = '';

    public string $viewMode = 'menu'; // Pilihan value: 'menu' atau 'payment'
    public $paymentPage = 1;          // Pagination metode bayar

    public bool $paymentModalOpen = false;
    public string $selectedPaymentLabel = 'Cash Payment';

    public $showModal = false;

    // --- STATE UNTUK PHONE NUMBER ---
    public bool $phoneNumberModalOpen = false;

    // --- STATE UNTUK MEMBER ---
    public bool $editMemberModalOpen = false;
    public string $memberSearch = '';
    public int $memberListPage = 1;

    // --- STATE UNTUK EDIT TABLE ---
    public bool $editTableModalOpen = false;

    // --- STATE UNTUK DELIVERY COST ---
    public bool $deliveryCostModalOpen = false;
    public ?string $deliveryCost = null;
    public ?string $orderFee = null;
    public int $platformFee = 0;

    // --- STATE UNTUK SPLIT BILL ---
    public bool $splitBillModalOpen = false; // Mengontrol buka/tutup modal split bill
    public array $splitBills = [];           // Menampung data sub-bill yang dibuat
    public int $activeSplitTab = 1;          // Menentukan sub-bill mana yang sedang aktif dipilih kasir
    public int $splitBillTotal = 0;
    public array $currentSplitItems = [];
    public bool $isSplitPaymentMode = false;
    public ?int $currentSplitBillIndex = null;

    // --- STATE UNTUK CANCEL TABLE ---
    public bool $cancelTableModalOpen = false; // Mengontrol buka/tutup modal cancel table
    public string $cancelTableReason = '';      // Menampung input alasan pembatalan

    public bool $showQuickServiceWaitlist = true;
    public bool $quickServiceModalOpen = false; // Mengontrol munculnya modal Quick Service otomatis
    public string $quickServiceSalesMode = 'take_away'; // Menampung pilihan sales mode di modal ('dine_in', 'gofood', 'take_away')

    // --- STATE UNTUK CARD PAYMENT METHOD ---
    public bool $cardDetailModalOpen = false;
    public ?string $cardAmount = null;
    public ?string $cardNumber = null;
    public ?string $cardVerificationCode = null;
    public ?string $cardBankName = null;
    public ?string $cardAccountName = null;
    public ?string $cardSelfOrderId = null;

    // --- STATE UNTUK COMPLIMENT PAYMENT METHOD ---
    public bool $complimentModalOpen = false;
    public ?string $complimentPercentage = null;
    public ?string $complimentAmount = null;
    public string $complimentNotes = '';

    // --- STATE UNTUK OTHER COST PAYMENT METHOD ---
    public bool $otherCostModalOpen = false;
    public string $otherCostNotes = '';

    public function openQuickService()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function mount(): void
    {
        $this->authorize('pos.access');

        $setting = Setting::current();
        $this->taxRate = (float) $setting->tax_rate;
        $this->serviceRate = (float) ($setting->service_rate ?? 0);
        $this->roundingBase = max(0, (int) $setting->rounding_base);
        $this->discountAppliesBeforeTax = (bool) ($setting->discount_applies_before_tax ?? true);
        $this->minRedemptionPoints = (int) ($setting->min_redemption_points ?? 0);
        $this->pointRedemptionValue = (float) ($setting->point_redemption_value ?? 0);

        if ($this->customerName === '') {
            $this->customerName = (string) ($setting->pos_default_customer_name ?? 'Walk-in');
        }

        if ($this->paymentMethod === 'cash' && (string) ($setting->pos_default_payment_method ?? 'cash') !== 'cash') {
            $this->paymentMethod = (string) ($setting->pos_default_payment_method ?? 'cash');
        }

        $orderType = request()->query('type');
        if (in_array($orderType, ['take_away', 'dine_in'], true)) {
            $this->orderType = $orderType;
        }

        $tableId = request()->query('table');
        if ($tableId !== null && $tableId !== '') {
            $table = DiningTable::query()->find((int) $tableId);
            if ($table) {
                $this->orderType = 'dine_in';
                $this->selectedTableId = (int) $table->id;
            }
        }

        $tab = (string) request()->query('tab', '');
        if (in_array($tab, ['pos', 'self_order'], true)) {
            $this->activeTab = $tab;
        }

        if ($this->activeTab === 'pos') {
            $this->refreshProductCards();
        }

        $this->recalculateTotals();
    }

    public function nextPage()
    {
        // Hitung total halaman maksimum berdasarkan batasan array produk
        $maxPage = ceil(count($this->productCards) / 16);

        if ($this->productPage < $maxPage) {
            $this->productPage++;
        }
    }

    public function previousPage()
    {
        if ($this->productPage > 1) {
            $this->productPage--;
        }
    }

    public function incrementPax()
    {
        $this->numberOfPax++;
    }

    public function decrementPax()
    {
        if ($this->numberOfPax > 1) {
            $this->numberOfPax--;
        }
    }

    public function openSelectTableModal($tableId)
    {
        // Cari data meja berdasarkan ID yang di-klik kasir
        $table = collect($this->tables)->firstWhere('id', $tableId);

        if ($table) {
            $status = strtolower($table['status'] ?? 'available');

            // JIKA MEJA SUDAH TERISI / BOOKING (Langsung Masuk Tanpa Modal)
            if (in_array($status, ['occupied', 'booked', 'billed'])) {

                // Tutup/pastikan pemicu modal bernilai false
                $this->selectTableModalOpen = false;

                // Cari transaksi gantung (pending) terakhir di meja ini
                $trx = \App\Models\Transaction::where('dining_table_id', $tableId)
                    ->where('payment_status', 'pending')
                    ->latest()
                    ->first();

                if ($trx) {
                    // Muat otomatis semua list menu makanan lama ke dalam keranjang belanja
                    $this->loadPending($trx->id);
                } else {
                    // Fallback jika status terisi tapi trx crash di DB: paksa bypass masuk halaman menu kosong
                    $this->selectedTableId = $tableId;
                    $this->editingTransactionId = null;
                    $this->cartItems = [];
                }

                $this->dispatch('toast', type: 'success', message: 'Memuat pesanan aktif ' . ($table['label'] ?? ''));
                return; // Selesai, hentikan baris kodingan agar modal tidak mencuat keluar
            }

            // Wajib bersihkan data sisa keranjang dan transaksi lama agar tidak bocor ke meja baru ini!
            $this->cartItems = [];
            $this->editingTransactionId = null;
            $this->subtotal = 0;
            $this->total = 0;
            $this->voucherDiscountAmount = 0;
            $this->manualDiscountAmount = 0;
            $this->voucherCodeInput = null;
            $this->voucherValid = false;

            // JIKA MEJA KOSONG / AVAILABLE (Picu Modal Number of Pax Seperti Biasa)
            $this->tableToSelect = $tableId;
            $this->tableToSelectLabel = $table['label'];
            $this->numberOfPax = 1; // Reset jumlah tamu ke 1
            $this->selectTableModalOpen = true; // Munculkan modal setup pax
        }
    }

    // 2. Method eksekusi akhir setelah kasir memilih tipe alurnya
    public function confirmSelectTable($actionType)
    {
        // Validasi input pax minimal 1
        $this->validate([
            'numberOfPax' => 'required|integer|min:1',
        ]);

        $tableId = $this->tableToSelect;

        if (!$tableId) {
            $this->dispatch('toast', type: 'error', message: 'Meja belum dipilih.');
            return;
        }

        $this->selectTableModalOpen = false;

        if ($actionType === 'order') {
            // Alur A: Masuk ke halaman kasir pilih menu produk
            $this->selectedTableId = $this->tableToSelect;
        } else {
            // Alur B: Book Table (Hanya booking meja, status terisi/occupied, timer jalan berkelanjutan)
            DB::transaction(function () use ($tableId) {
                // 1. Ambil setting default atau buat data transaksi gantung dengan nominal 0 (karena belum mesen produk)
                $cabangId = auth()->user()->cabang_id ?? 1;

                $trx = Transaction::create([
                    'code' => Transaction::generateUniqueCode(),
                    'cabang_id' => $cabangId,
                    'member_id' => null,
                    'channel' => 'pos',
                    'name' => 'Table ' . $this->tableToSelectLabel,
                    'phone' => null,
                    'order_type' => 'dine_in',
                    'dining_table_id' => $tableId,
                    'pax' => $this->numberOfPax,
                    'subtotal' => 0,
                    'service_percentage' => $this->serviceRate ?? 0,
                    'service_amount' => 0,
                    'tax_percentage' => $this->taxRate ?? 0,
                    'tax_amount' => 0,
                    'rounding_amount' => 0,
                    'total' => 0,
                    'payment_method' => 'pending',
                    'payment_status' => 'pending',
                    'order_status' => 'new',
                    'external_id' => Transaction::generateUniqueCode(10),
                    'checkout_link' => '',
                ]);

                // 2. Update status meja di database menjadi 'occupied' & set 'occupied_at' ke waktu sekarang
                // Di program kamu, timer FE New Date() mengikat database field 'occupied_at' agar durasi jalan realtime
                DB::table('dining_tables')->where('id', $tableId)->update([
                    'status' => 'occupied',
                    'occupied_at' => now(),
                ]);

                // 3. Catat log aktivitas jika tabel log audit event tersedia
                if (class_exists(\App\Models\TransactionEvent::class)) {
                    TransactionEvent::create([
                        'transaction_id' => $trx->id,
                        'actor_user_id' => auth()->id(),
                        'action' => 'book_table',
                        'meta' => ['message' => 'Meja berhasil dibooking tanpa pesanan makanan']
                    ]);
                }
            });

            // Bersihkan temporary state pemilih meja
            $this->tableToSelect = null;
            $this->tableToSelectLabel = '';

            // Kirim feedback sukses ke frontend dan memicu render ulang denah meja terbaru
            $this->dispatch('toast', type: 'success', message: 'Meja berhasil di-booking!');
        }
    }

    public function updatedSearch(): void
    {
        if ($this->activeTab !== 'pos') {
            return;
        }
        $this->productPage = 1;
        $this->refreshProductCards();
        $this->loadVariantStockStatuses();
    }

    public function updatedSelectedCategoryId(): void
    {
        if ($this->activeTab !== 'pos') {
            return;
        }

        $this->productPage = 1;
        $this->refreshProductCards();
        $this->loadVariantStockStatuses();
    }

    public function updatedVoucherCodeInput(): void
    {
        $this->recalculateTotals();
    }

    public function updatedMemberId(): void
    {
        if ($this->cartLocked) {
            $this->memberId = $this->lockedMemberId;
            $this->dispatch('toast', type: 'error', message: 'Pesanan self-order tidak dapat mengubah member.');

            return;
        }

        if ($this->memberId && ! auth()->user()?->can('members.view')) {
            $this->memberId = null;
            $this->dispatch('toast', type: 'error', message: 'Anda tidak memiliki akses untuk memilih member.');

            return;
        }

        $this->memberPoints = 0;
        $this->redeemPoints = false;
        $this->pointsToRedeem = 0;

        if ($this->memberId) {
            $member = Member::query()->find($this->memberId);
            if ($member) {
                $this->customerName = (string) $member->name;
                $this->customerPhone = (string) $member->phone;
                $this->memberPoints = (int) $member->points;
            }
        }

        $this->recalculateTotals();
    }

    public function updatedCustomerName(): void
    {
        if ($this->cartLocked) {
            $this->customerName = (string) ($this->lockedCustomerName ?? $this->customerName);
            $this->dispatch('toast', type: 'error', message: 'Pesanan self-order tidak dapat mengubah data pelanggan.');
        }
    }

    public function updatedCustomerPhone(): void
    {
        if ($this->cartLocked) {
            $this->customerPhone = $this->lockedCustomerPhone;
            $this->dispatch('toast', type: 'error', message: 'Pesanan self-order tidak dapat mengubah data pelanggan.');

            return;
        }

        $this->recalculateTotals();
    }

    public function updatedManualDiscountType(): void
    {
        $this->resetValidation(['manualDiscountType', 'manualDiscountValue']);

        $type = $this->manualDiscountType !== null ? trim((string) $this->manualDiscountType) : '';
        if ($type === '') {
            $this->manualDiscountType = null;
            $this->manualDiscountValue = null;
            $this->manualDiscountNote = null;
        }

        $this->recalculateTotals();
    }

    public function updatedManualDiscountValue(): void
    {
        $this->resetValidation(['manualDiscountType', 'manualDiscountValue']);

        $this->recalculateTotals();
    }

    public function updatedRedeemPoints(): void
    {
        if ($this->redeemPoints && $this->memberPoints < $this->minRedemptionPoints) {
            $this->redeemPoints = false;
            $this->dispatch('toast', type: 'error', message: 'Poin member belum mencapai minimal penukaran.');

            return;
        }

        $this->recalculateTotals();
    }

    public function setTab(string $tab): void
    {
        if (! in_array($tab, ['pos', 'self_order'], true)) {
            return;
        }

        $this->activeTab = $tab;

        if ($tab === 'pos') {
            $this->refreshProductCards();
            $this->loadVariantStockStatuses();
        }
    }

    public function loadVariantStockStatuses(): void
    {
        if ($this->activeTab !== 'pos') {
            return;
        }

        $variantIds = [];

        foreach ($this->productCards as $product) {
            $variants = (array) ($product['variants'] ?? []);
            foreach ($variants as $variant) {
                $variantId = (int) ($variant['id'] ?? 0);
                if ($variantId > 0) {
                    $variantIds[] = $variantId;
                }
            }

            $componentVariantIds = (array) ($product['package_component_variant_ids'] ?? []);
            foreach ($componentVariantIds as $componentVariantId) {
                $variantId = (int) $componentVariantId;
                if ($variantId > 0) {
                    $variantIds[] = $variantId;
                }
            }
        }

        $variantIds = array_values(array_unique($variantIds));

        $this->variantStockStatuses = app(VariantIngredientStockStatusService::class)
            ->statusesForVariantIds($variantIds);
    }

    private function refreshProductCards(): void
    {
        $term = trim($this->search);

        $products = Product::query()
            ->where('is_available', true)
            ->when($this->selectedCategoryId, fn(Builder $q) => $q->where('category_id', $this->selectedCategoryId))
            ->when($term !== '', function (Builder $q) use ($term): void {
                $like = '%' . $term . '%';
                $q->where(function (Builder $qq) use ($like): void {
                    $qq->where('name', 'like', $like)->orWhere('description', 'like', $like);
                });
            })
            ->with(['variants' => function ($q): void {
                $q->orderBy('id');
            }, 'packageItems' => function ($q): void {
                $q->orderBy('sort_order')->select(['id', 'package_product_id', 'component_product_variant_id']);
            }])
            ->orderBy('name')
            ->limit(120)
            ->get(['id', 'name', 'image', 'is_package', 'package_type']);

        $this->productCards = $products->map(function (Product $product): array {
            $packageType = (string) ($product->package_type ?? 'simple');
            $isPackage = (bool) $product->is_package;

            return [
                'id' => (int) $product->id,
                'name' => (string) $product->name,
                'image' => (string) ($product->image ?? ''),
                'is_package' => $isPackage,
                'package_type' => $packageType,
                'package_component_variant_ids' => $isPackage && $packageType !== 'complex'
                    ? $product->packageItems
                    ->pluck('component_product_variant_id')
                    ->filter(fn($v) => (int) $v > 0)
                    ->unique()
                    ->values()
                    ->map(fn($v) => (int) $v)
                    ->all()
                    : [],
                'variants' => $product->variants
                    ->map(fn(ProductVariant $v) => [
                        'id' => (int) $v->id,
                        'name' => (string) $v->name,
                        'price' => (float) $v->price,
                        'price_afterdiscount' => $v->price_afterdiscount === null ? null : (float) $v->price_afterdiscount,
                        'percent' => $v->percent === null ? null : (int) $v->percent,
                    ])
                    ->values()
                    ->all(),
            ];
        })->values()->all();
    }

    public function chooseOrderType(string $type): void
    {
        if (! in_array($type, ['take_away', 'dine_in'], true)) {
            return;
        }

        if ($type === 'take_away') {
            // ALUR BARU: Set tipe, kosongkan keranjang transaksi lama, dan langsung beralih ke halaman menu sambil memicu modal setup mencuat otomatis
            $this->orderType = 'take_away';
            $this->selectedTableId = null;
            $this->editingTransactionId = null;
            $this->cartItems = [];
            $this->numberOfPax = 1; // Reset default pax ke 1
            $this->quickServiceSalesMode = 'take_away'; // Default select button TAKEAWAY

            $this->showQuickServiceWaitlist = true; // Picu modal otomatis muncul di atas halaman menu
            $this->viewMode = 'menu';
        } else {
            // Alur Dine In bawaan lama kamu
            $this->orderType = 'dine_in';
            $this->tableModalOpen = true;
        }

        $this->recalculateTotals();
    }

    public function openAddQuickService(): void
    {
        $this->selectedTableId = null;
        $this->editingTransactionId = null;
        $this->cartItems = [];
        $this->numberOfPax = 1;
        $this->quickServiceSalesMode = 'take_away';
        $this->showQuickServiceWaitlist = false;
        $this->quickServiceModalOpen = true;
    }

    public function selectQuickServicePending(int $transactionId): void
    {
        $this->loadPending($transactionId);
        $this->showQuickServiceWaitlist = false;
    }

    public function getQuickServicePendingListProperty()
    {
        return Transaction::query()
            ->where('channel', 'pos')
            ->where('order_type', 'take_away')
            ->where('payment_status', 'pending')
            ->withCount('transactionItems')
            ->orderByDesc('created_at')
            ->limit(50)
            ->get();
    }

    public function selectTable(int $id): void
    {
        $table = DiningTable::query()->find($id);
        if (!$table) return;

        if ($table->status === 'occupied') {
            // Cari transaksi pending terakhir di meja ini
            $trx = Transaction::where('dining_table_id', $id)
                ->where('payment_status', 'pending')
                ->latest()
                ->first();

            if ($trx) {
                $this->loadPending($trx->id); // Langsung muat isinya ke keranjang
            }
        } else {
            $this->selectedTableId = (int) $table->id;
            $this->editingTransactionId = null;
            $this->cartItems = [];
        }
        $this->tableModalOpen = false;
    }

    public function openVariantModal(int $productId): void
    {
        $product = Product::query()->whereKey($productId)->first();
        if (! $product) {
            return;
        }

        $variants = ProductVariant::query()
            ->where('product_id', $productId)
            ->orderBy('name')
            ->get(['id', 'name', 'price', 'price_afterdiscount', 'percent']);

        if ($variants->count() <= 1) {
            $variant = $variants->first();
            if ($variant) {
                $this->addVariantToCart((int) $variant->id);
            }

            return;
        }

        $this->variantOptions = $variants->map(function (ProductVariant $v) {
            $base = (int) round((float) $v->price);
            $final = $this->finalVariantPrice($v);

            return [
                'id' => (int) $v->id,
                'name' => (string) $v->name,
                'price' => $base,
                'final_price' => $final,
                'percent' => $v->percent === null ? null : (int) $v->percent,
            ];
        })->all();

        $this->variantProductId = (int) $productId;
        $this->variantModalOpen = true;
    }

    public function addToCart(int $productId): void
    {
        if ($this->cartLocked) {
            $this->dispatch('toast', type: 'error', message: 'Pesanan yang dimuat tidak dapat diubah.');

            return;
        }

        $product = Product::query()->whereKey($productId)->first();
        if (! $product) {
            return;
        }

        $variantsCount = ProductVariant::query()->where('product_id', $productId)->count();
        if ($variantsCount <= 0) {
            $this->dispatch('toast', type: 'error', message: 'Produk belum memiliki varian harga.');

            return;
        }

        if ($variantsCount > 1) {
            $this->openVariantModal($productId);

            return;
        }

        $variant = ProductVariant::query()
            ->where('product_id', $productId)
            ->orderBy('id')
            ->first();

        if ($variant) {
            $this->addVariantToCart((int) $variant->id);
        }
    }

    public function addVariantToCart(int $variantId): void
    {
        if ($this->cartLocked) {
            $this->dispatch('toast', type: 'error', message: 'Pesanan yang dimuat tidak dapat diubah.');

            return;
        }

        $variant = ProductVariant::query()
            ->with('product')
            ->find($variantId);

        if (! $variant || ! $variant->product) {
            return;
        }

        if ((bool) $variant->product->is_package && (string) ($variant->product->package_type ?? 'simple') === 'complex') {
            $this->openComplexPackageModal((int) $variant->id);
            $this->variantModalOpen = false;

            return;
        }

        $finalPrice = $this->finalVariantPrice($variant);
        $base = (int) round((float) $variant->price);

        $existingIndex = null;
        foreach ($this->cartItems as $i => $item) {
            if ((int) ($item['variant_id'] ?? 0) === (int) $variant->id) {
                $existingIndex = $i;
                break;
            }
        }

        if ($existingIndex !== null) {
            $this->cartItems[$existingIndex]['quantity'] = (int) ($this->cartItems[$existingIndex]['quantity'] ?? 0) + 1;
            $this->recalculateTotals();
            $this->variantModalOpen = false;

            return;
        }

        $this->cartItems[] = [
            'product_id' => (int) $variant->product->id,
            'variant_id' => (int) $variant->id,
            'name' => (string) $variant->product->name,
            'variant_name' => ItemNameFormatter::displayVariantName((int) $variant->product->id, (string) $variant->name),
            'price' => $finalPrice,
            'original_price' => $base,
            'percent' => $variant->percent === null ? null : (int) $variant->percent,
            'quantity' => 1,
            'note' => null,
        ];

        $this->recalculateTotals();
        $this->variantModalOpen = false;
    }

    public function openComplexPackageModal(int $parentVariantId): void
    {
        if ($this->cartLocked) {
            $this->dispatch('toast', type: 'error', message: 'Pesanan yang dimuat tidak dapat diubah.');

            return;
        }

        $parentVariant = ProductVariant::query()
            ->with(['product.complexPackageItems.componentProduct'])
            ->find($parentVariantId);

        if (! $parentVariant || ! $parentVariant->product) {
            return;
        }

        $this->populateComplexPackageModal($parentVariant, null);
    }

    public function editComplexPackageInCart(int $index): void
    {
        if ($this->cartLocked) {
            $this->dispatch('toast', type: 'error', message: 'Pesanan yang dimuat tidak dapat diubah.');

            return;
        }

        if (! isset($this->cartItems[$index]) || ! is_array($this->cartItems[$index])) {
            return;
        }

        $cartItem = $this->cartItems[$index];
        if ((string) ($cartItem['package_type'] ?? '') !== 'complex') {
            return;
        }

        $parentVariantId = (int) ($cartItem['variant_id'] ?? 0);
        if ($parentVariantId <= 0) {
            return;
        }

        $parentVariant = ProductVariant::query()
            ->with(['product.complexPackageItems.componentProduct'])
            ->find($parentVariantId);

        if (! $parentVariant || ! $parentVariant->product) {
            return;
        }

        $this->editingComplexPackageCartIndex = $index;
        $this->populateComplexPackageModal($parentVariant, $cartItem);
    }

    private function populateComplexPackageModal(ProductVariant $parentVariant, ?array $cartItem): void
    {
        if (! $parentVariant->product) {
            return;
        }

        $product = $parentVariant->product;
        if (! (bool) $product->is_package || (string) ($product->package_type ?? 'simple') !== 'complex') {
            return;
        }

        $componentProductIds = $product->complexPackageItems
            ->pluck('component_product_id')
            ->map(fn($id) => (int) $id)
            ->filter(fn(int $id) => $id > 0)
            ->values()
            ->all();

        if ($componentProductIds === []) {
            $this->dispatch('toast', type: 'error', message: 'Isi paket belum diatur.');

            return;
        }

        $variantRows = ProductVariant::query()
            ->whereIn('product_id', $componentProductIds)
            ->orderBy('name')
            ->get(['id', 'product_id', 'name'])
            ->groupBy('product_id');

        $this->complexPackageParentVariantId = (int) $parentVariant->id;
        $existingByProductId = collect((array) ($cartItem['package_components'] ?? []))
            ->filter(fn($row) => is_array($row))
            ->groupBy(fn(array $row) => (int) ($row['product_id'] ?? 0));

        $this->complexPackageComponents = $product->complexPackageItems
            ->values()
            ->map(function ($item) use ($variantRows, $existingByProductId) {
                $componentProductId = (int) $item->component_product_id;
                $baseQty = (int) $item->quantity;
                $isSplitable = (bool) ($item->is_splitable ?? false);
                $options = $variantRows->get($componentProductId, collect())
                    ->map(fn(ProductVariant $v) => [
                        'id' => (int) $v->id,
                        'name' => (string) $v->name,
                    ])
                    ->values()
                    ->all();

                $existing = $existingByProductId->get($componentProductId, collect())
                    ->map(fn($row) => is_array($row) ? $row : [])
                    ->filter(fn(array $row) => (int) ($row['quantity'] ?? 0) > 0)
                    ->values();

                $allocations = $existing->map(fn(array $row) => [
                    'key' => (string) Str::uuid(),
                    'quantity' => (int) ($row['quantity'] ?? 0),
                    'variant_id' => (int) ($row['variant_id'] ?? 0),
                    'note' => array_key_exists('note', $row) ? ($row['note'] === '' ? null : (string) $row['note']) : null,
                ])->all();

                if (! $isSplitable) {
                    $merged = [];
                    foreach ($allocations as $row) {
                        $variantId = (int) ($row['variant_id'] ?? 0);
                        $note = $row['note'] ?? null;
                        $key = $variantId . '|' . trim((string) ($note ?? ''));
                        if (! array_key_exists($key, $merged)) {
                            $merged[$key] = $row;

                            continue;
                        }
                        $merged[$key]['quantity'] += (int) ($row['quantity'] ?? 0);
                    }
                    $allocations = array_values($merged);
                    $allocations = $allocations === [] ? [] : [$allocations[0]];
                    if ($allocations !== []) {
                        $allocations[0]['quantity'] = $baseQty;
                    }
                }

                if ($allocations === []) {
                    $allocations = [[
                        'key' => (string) Str::uuid(),
                        'quantity' => $baseQty,
                        'variant_id' => null,
                        'note' => null,
                    ]];
                } else {
                    $sum = collect($allocations)->sum(fn($a) => (int) ($a['quantity'] ?? 0));
                    if ($sum < $baseQty) {
                        $allocations[] = [
                            'key' => (string) Str::uuid(),
                            'quantity' => $baseQty - (int) $sum,
                            'variant_id' => null,
                            'note' => null,
                        ];
                    }
                    if ($sum > $baseQty) {
                        $left = $baseQty;
                        $normalized = [];
                        foreach ($allocations as $row) {
                            $qty = (int) ($row['quantity'] ?? 0);
                            if ($left <= 0) {
                                break;
                            }
                            $take = min($left, $qty);
                            $row['quantity'] = $take;
                            $normalized[] = $row;
                            $left -= $take;
                        }
                        $allocations = $normalized === [] ? [[
                            'key' => (string) Str::uuid(),
                            'quantity' => $baseQty,
                            'variant_id' => null,
                            'note' => null,
                        ]] : $normalized;
                    }
                }

                return [
                    'key' => (string) Str::uuid(),
                    'component_product_id' => $componentProductId,
                    'component_product_name' => (string) ($item->componentProduct?->name ?? ''),
                    'base_quantity' => $baseQty,
                    'is_splitable' => $isSplitable,
                    'variant_options' => $options,
                    'allocations' => $allocations,
                ];
            })
            ->all();

        if ($cartItem === null) {
            $this->editingComplexPackageCartIndex = null;
        }

        $this->complexPackageModalOpen = true;
    }

    public function addComplexPackageAllocation(string $componentKey): void
    {
        foreach ($this->complexPackageComponents as $index => $component) {
            if ((string) ($component['key'] ?? '') !== $componentKey) {
                continue;
            }

            if (! (bool) ($component['is_splitable'] ?? false)) {
                return;
            }

            $baseQty = (int) ($component['base_quantity'] ?? 0);
            if ($baseQty <= 0) {
                return;
            }

            $allocations = collect((array) ($component['allocations'] ?? []))
                ->filter(fn($row) => is_array($row))
                ->values()
                ->all();

            $splitFromIndex = null;
            foreach ($allocations as $i => $row) {
                if ((int) ($row['quantity'] ?? 0) > 1) {
                    $splitFromIndex = $i;
                    break;
                }
            }

            if ($splitFromIndex === null) {
                return;
            }

            $allocations[$splitFromIndex]['quantity'] = (int) ($allocations[$splitFromIndex]['quantity'] ?? 0) - 1;

            $allocations[] = [
                'key' => (string) Str::uuid(),
                'quantity' => 1,
                'variant_id' => null,
                'note' => null,
            ];

            $this->complexPackageComponents[$index]['allocations'] = array_values($allocations);

            return;
        }
    }

    public function removeComplexPackageAllocation(string $componentKey, string $allocationKey): void
    {
        foreach ($this->complexPackageComponents as $index => $component) {
            if ((string) ($component['key'] ?? '') !== $componentKey) {
                continue;
            }

            if (! (bool) ($component['is_splitable'] ?? false)) {
                return;
            }

            $baseQty = (int) ($component['base_quantity'] ?? 0);
            $allocations = collect((array) ($component['allocations'] ?? []))
                ->filter(fn($row) => is_array($row))
                ->reject(fn(array $row) => (string) ($row['key'] ?? '') === $allocationKey)
                ->values()
                ->all();

            if ($allocations === []) {
                $allocations = [[
                    'key' => (string) Str::uuid(),
                    'quantity' => $baseQty,
                    'variant_id' => null,
                    'note' => null,
                ]];
            } else {
                $sum = collect($allocations)->sum(fn($row) => (int) ($row['quantity'] ?? 0));
                $diff = $baseQty - (int) $sum;
                if ($diff > 0) {
                    $allocations[0]['quantity'] = (int) ($allocations[0]['quantity'] ?? 0) + $diff;
                }
            }

            $this->complexPackageComponents[$index]['allocations'] = array_values($allocations);

            return;
        }
    }

    public function closeComplexPackageModal(): void
    {
        $this->complexPackageModalOpen = false;
        $this->complexPackageParentVariantId = null;
        $this->complexPackageComponents = [];
        $this->editingComplexPackageCartIndex = null;
    }

    public function confirmComplexPackageToCart(): void
    {
        if ($this->cartLocked) {
            $this->dispatch('toast', type: 'error', message: 'Pesanan yang dimuat tidak dapat diubah.');

            return;
        }

        $parentVariantId = $this->complexPackageParentVariantId;
        if ($parentVariantId === null) {
            return;
        }

        $parentVariant = ProductVariant::query()
            ->with('product')
            ->find($parentVariantId);

        if (! $parentVariant || ! $parentVariant->product) {
            return;
        }

        $components = $this->complexPackageComponents;
        $packageComponents = [];
        foreach ($components as $row) {
            if (! is_array($row)) {
                continue;
            }

            $componentProductId = (int) ($row['component_product_id'] ?? 0);
            $baseQty = (int) ($row['base_quantity'] ?? 0);
            $allocations = (array) ($row['allocations'] ?? []);

            if ($componentProductId <= 0 || $baseQty <= 0) {
                continue;
            }

            $allowed = collect($row['variant_options'] ?? [])
                ->map(fn($v) => (int) ($v['id'] ?? 0))
                ->filter(fn(int $id) => $id > 0)
                ->values()
                ->all();

            $sumQty = 0;
            foreach ($allocations as $alloc) {
                if (! is_array($alloc)) {
                    continue;
                }

                $variantId = (int) ($alloc['variant_id'] ?? 0);
                $qty = (int) ($alloc['quantity'] ?? 0);
                $note = $alloc['note'] ?? null;

                if ($qty <= 0 || $variantId <= 0) {
                    $this->dispatch('toast', type: 'error', message: 'Semua komponen paket harus memilih varian dan qty valid.');

                    return;
                }

                if ($allowed !== [] && ! in_array($variantId, $allowed, true)) {
                    $this->dispatch('toast', type: 'error', message: 'Varian komponen tidak valid.');

                    return;
                }

                $sumQty += $qty;

                $packageComponents[] = [
                    'product_id' => $componentProductId,
                    'variant_id' => $variantId,
                    'quantity' => $qty,
                    'note' => $note === '' ? null : $note,
                ];
            }

            if ($sumQty !== $baseQty) {
                $this->dispatch('toast', type: 'error', message: 'Total qty komponen paket harus sesuai dengan qty paket.');

                return;
            }
        }

        $finalPrice = $this->finalVariantPrice($parentVariant);
        $base = (int) round((float) $parentVariant->price);

        $payload = [
            'product_id' => (int) $parentVariant->product->id,
            'variant_id' => (int) $parentVariant->id,
            'name' => (string) $parentVariant->product->name,
            'variant_name' => ItemNameFormatter::displayVariantName((int) $parentVariant->product->id, (string) $parentVariant->name),
            'price' => $finalPrice,
            'original_price' => $base,
            'percent' => $parentVariant->percent === null ? null : (int) $parentVariant->percent,
            'quantity' => 1,
            'note' => null,
            'package_type' => 'complex',
            'package_components' => collect($packageComponents)->values()->all(),
        ];

        if ($this->editingComplexPackageCartIndex !== null) {
            $index = $this->editingComplexPackageCartIndex;
            if (isset($this->cartItems[$index]) && is_array($this->cartItems[$index])) {
                $payload['quantity'] = (int) ($this->cartItems[$index]['quantity'] ?? 1);
                $payload['note'] = $this->cartItems[$index]['note'] ?? null;
                $this->cartItems[$index] = array_merge($this->cartItems[$index], $payload);
            }
        } else {
            $this->cartItems[] = $payload;
        }

        $this->recalculateTotals();
        $this->closeComplexPackageModal();
        $this->variantModalOpen = false;
    }

    public function increment(int $index): void
    {
        if ($this->cartLocked) {
            $this->dispatch('toast', type: 'error', message: 'Pesanan yang dimuat tidak dapat diubah.');

            return;
        }

        if (! isset($this->cartItems[$index])) {
            return;
        }

        $this->cartItems[$index]['quantity'] = (int) ($this->cartItems[$index]['quantity'] ?? 0) + 1;
        $this->recalculateTotals();
    }

    public function decrement(int $index): void
    {
        if ($this->cartLocked) {
            $this->dispatch('toast', type: 'error', message: 'Pesanan yang dimuat tidak dapat diubah.');

            return;
        }

        if (! isset($this->cartItems[$index])) {
            return;
        }

        $qty = (int) ($this->cartItems[$index]['quantity'] ?? 0);

        // Proteksi: Jangan decrement jika quantity sudah 1
        if ($qty <= 1) {
            return;   // atau bisa tambah toast jika ingin
        }

        $this->cartItems[$index]['quantity'] = $qty - 1;
        $this->recalculateTotals();
    }

    public function removeItem(int $index): void
    {
        if ($this->cartLocked) {
            $this->dispatch('toast', type: 'error', message: 'Pesanan yang dimuat tidak dapat diubah.');

            return;
        }

        if (!isset($this->cartItems[$index])) return;

        $item = $this->cartItems[$index];

        // LOGIKA: Jika item punya 'id' (berarti hasil load dari database/pesanan lama)
        // dan sedang dalam mode Dine In terisi (editingTransactionId ada)
        if (isset($item['id']) && $this->editingTransactionId !== null) {
            $this->voidItemIndex = $index;
            $this->voidItemReason = '';
            $this->voidItemPin = '';
            $this->voidItemModalOpen = true; // Munculkan Modal Void
        } else {
            // Jika item baru (belum tersimpan di DB), hapus langsung
            array_splice($this->cartItems, $index, 1);
            $this->recalculateTotals();
        }
    }

    public function confirmVoidItem(): void
    {
        $this->validate([
            'voidItemReason' => 'required|string|min:5',
            'voidItemPin' => 'required|numeric', // Asumsi butuh PIN
        ]);

        // Di sini kamu bisa tambahkan logika cek PIN Manager seperti di resolveApprover

        $candidates = User::query()
            ->where('is_active', true)
            ->whereNotNull('manager_pin')
            ->get();

        $validApprover = null;

        // 3. Cek PIN satu per satu menggunakan Hash::check
        foreach ($candidates as $candidate) {
            if (Hash::check($this->voidItemPin, $candidate->manager_pin)) {
                // Cek apakah user ini punya izin untuk approve void
                if ($candidate->can('transactions.void.approve') || $candidate->hasRole(['admin', 'owner'])) {
                    $validApprover = $candidate;
                    break;
                }
            }
        }

        // 4. Jika tidak ada PIN yang cocok atau tidak punya akses
        if (!$validApprover) {
            $this->addError('voidItemPin', 'PIN salah atau user tidak memiliki otoritas approval.');
            return;
        }

        // Untuk sekarang, kita anggap lolos dan langsung hapus dari array
        // 5. Eksekusi Void jika item memang ada
        if ($this->voidItemIndex !== null && isset($this->cartItems[$this->voidItemIndex])) {
            $item = $this->cartItems[$this->voidItemIndex];

            // Simpan log aktivitas void item
            \App\Models\TransactionEvent::create([
                'transaction_id' => $this->editingTransactionId,
                'actor_user_id' => auth()->id(),
                'action' => 'void_item',
                'meta' => [
                    'item_name' => $item['name'],
                    'variant' => $item['variant_name'] ?? '-',
                    'reason' => $this->voidItemReason,
                    'approved_by_user_id' => $validApprover->id, // Catat siapa yang kasih PIN
                    'approved_by_name' => $validApprover->name,
                ]
            ]);

            // Hapus item dari keranjang
            array_splice($this->cartItems, $this->voidItemIndex, 1);

            // Hitung ulang totalan
            $this->recalculateTotals();

            // Reset state dan tutup modal
            $this->voidItemModalOpen = false;
            $this->voidItemIndex = null;
            $this->voidItemPin = '';
            $this->voidItemReason = '';

            $this->dispatch('toast', type: 'success', message: 'Item berhasil di-void oleh ' . $validApprover->name);
        }
    }

    public function clearCart(): void
    {
        $this->cartItems = [];
        $this->editingTransactionId = null;
        $this->cartLocked = false;
        $this->lockedVoucherCode = null;
        $this->lockedVoucherDiscountAmount = 0;
        $this->lockedVoucherAllocations = [];
        $this->lockedPointsToRedeem = 0;
        $this->lockedPointDiscountAmount = 0;
        $this->lockedMemberId = null;
        $this->lockedCustomerName = null;
        $this->lockedCustomerPhone = null;
        $this->recalculateTotals();
    }

    private function resetOrderForNewTransaction(): void
    {
        $setting = Setting::current();

        $this->clearCart();
        $this->editingTransactionId = null;

        // GANTI: simpan order type sebelumnya supaya tahu mau balik ke mana
        $previousOrderType = $this->orderType;

        $this->selectedTableId = null;
        $this->memberId = null;

        $this->customerName = (string) ($setting->pos_default_customer_name ?? 'Walk-in');
        $this->customerPhone = null;

        $this->checkoutStep = 1;

        $this->cardBankName = null;
        $this->cardAccountName = null;
        $this->cardAmount = null;
        $this->cardNumber = null;
        $this->cardVerificationCode = null;

        if ($previousOrderType === 'take_away') {
            // Balik ke waitlist Quick Service
            $this->orderType = 'take_away';
            $this->showQuickServiceWaitlist = true;
        } else {
            // Balik ke denah meja dine in
            $this->orderType = 'dine_in';
            $this->showQuickServiceWaitlist = true; // reset juga biar konsisten kalau nanti pindah ke take_away lagi
        }

        $this->refreshProductCards();
    }
    public function openCheckout(): void
    {
        if (count($this->cartItems) === 0) {
            $this->dispatch('toast', type: 'error', message: 'Keranjang belanja kosong.');
            return;
        }

        $this->resetValidation();
        $this->cashReceived = null;
        $this->cashChange = 0;

        $isDineIn = $this->orderType === 'dine_in';
        $isEditing = $this->editingTransactionId !== null;

        if ($isDineIn) {
            $this->checkoutStep = 3;
            if (!$isEditing && $this->selectedTableId) {
                $table = collect($this->tables)->firstWhere('id', $this->selectedTableId);
                $this->customerName = $table['label'] ?? 'Meja';
            }
        } else {
            $this->checkoutStep = 1;
        }

        // KUNCI ALUR: Nonaktifkan modal pop-up lama, alihkan view ke halaman full screen payment
        $this->checkoutModalOpen = false;
        $this->viewMode = 'payment';
    }

    public function saveOrder(): void
    {
        // Hanya jalankan jika kita sedang mengedit transaksi yang sudah ada (meja terisi)
        if (!$this->editingTransactionId) {
            return;
        }

        // LOGIKA BARU: Jika keranjang kosong setelah void
        if (count($this->cartItems) === 0) {
            DB::transaction(function () {
                $trx = Transaction::query()->whereKey($this->editingTransactionId)->lockForUpdate()->first();

                if ($trx) {
                    // 1. Kembalikan Meja jadi Biru (Tersedia)
                    if ($trx->dining_table_id) {
                        DiningTable::where('id', $trx->dining_table_id)->update([
                            'status' => 'available',
                            'occupied_at' => null
                        ]);
                    }

                    // 2. Hapus detail item lama di DB
                    TransactionItem::where('transaction_id', $trx->id)->delete();

                    // 3. Hapus transaksinya (sesuai permintaanmu: jangan masuk ke database/bersihkan)
                    $trx->delete();
                }
            });

            $this->dispatch('toast', type: 'success', message: 'Pesanan dibatalkan & Meja telah dikosongkan.');

            // Balikkan tampilan ke halaman awal (Quick Service)
            $this->resetOrderForNewTransaction();
            return;
        }

        $this->recalculateTotals();

        DB::transaction(function () {
            $trx = Transaction::query()->whereKey($this->editingTransactionId)->lockForUpdate()->first();
            if (!$trx) return;

            // --- LOGIKA AUDIT: CEK PENGURANGAN / PENGHAPUSAN ITEM ---
            $existingItems = TransactionItem::where('transaction_id', $trx->id)->get();

            foreach ($existingItems as $oldItem) {
                // Cari item yang sama di keranjang (cartItems) berdasarkan variant_id
                $newItem = collect($this->cartItems)->firstWhere('variant_id', $oldItem->product_variant_id);

                // LOGIKA FILTER: Cek apakah item dihapus (removed) atau dikurangi (reduced)
                $isRemoved = !$newItem;
                $isReduced = $newItem && ($newItem['quantity'] < $oldItem->quantity);

                // SISTEM HANYA MENCATAT JIKA DIHAPUS ATAU DIKURANGI
                if ($isRemoved || $isReduced) {
                    activity('deleted_item')
                        ->performedOn($trx)
                        ->causedBy(auth()->user())
                        ->withProperties([
                            'cabang_id' => auth()->user()->cabang_id,
                            'product'   => $oldItem->product?->name ?? 'Produk',
                            'old_qty'   => $oldItem->quantity,
                            'new_qty'   => $isRemoved ? 0 : $newItem['quantity'],
                            'price'     => (int) $oldItem->price,
                            'type'      => $isRemoved ? 'removed' : 'reduced'
                        ])
                        ->log($isRemoved ? "Menghapus item" : "Mengurangi jumlah item");
                }
            }
            // --- END LOGIKA AUDIT ---

            $trx->update([
                'subtotal' => $this->subtotal,
                'service_percentage' => $this->serviceRate,
                'service_amount' => $this->serviceAmount,
                'tax_percentage' => $this->taxRate,
                'tax_amount' => $this->taxAmount,
                'total' => $this->total,
                'updated_at' => now(),
            ]);

            // 2. Sync Detail Item (Hapus yang lama, masukkan yang baru di keranjang)
            TransactionItem::where('transaction_id', $trx->id)->delete();

            foreach ($this->cartItems as $item) {
                TransactionItem::create([
                    'transaction_id' => $trx->id,
                    'product_id' => $item['product_id'],
                    'product_variant_id' => $item['variant_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['quantity'] * $item['price'],
                    'note' => $item['note'] ?? null,
                ]);
            }

            $this->dispatch('toast', type: 'success', message: 'Pesanan meja berhasil diperbarui');
            $this->resetOrderForNewTransaction();
        });
    }

    public function savePayment(): void
    {
        // Jika split bill, yang divalidasi adalah item split-nya
        $itemsToProcess = $this->isSplitPaymentMode ? $this->currentSplitItems : $this->cartItems;
        if (count($itemsToProcess) === 0) return;

        $isDineIn = $this->orderType === 'dine_in';
        $isEditing = $this->editingTransactionId !== null;
        $isFinalPayment = ($this->orderType === 'take_away' || ($isDineIn && $isEditing));

        // Validasi aturan dasar
        $rules = [
            'customerName' => ['required', 'string', 'max:255'],
            'customerPhone' => ['nullable', 'string', 'max:50'],
            'taxRate' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ];

        if ($isFinalPayment) {
            $rules['paymentMethod'] = ['required', 'string', 'max:50'];
            if ($this->paymentMethod === 'cash') {
                $rawCash = (int) preg_replace('/\D+/', '', (string)($this->cashReceived ?? '0'));
                if ($rawCash < $this->total) {
                    $this->addError('cashReceived', 'Uang diterima kurang dari total tagihan.');
                    return;
                }
            }
        }

        $validated = $this->validate($rules);
        $trxId = null;

        DB::transaction(function () use ($isDineIn, $isFinalPayment, $validated, &$trxId) {
            $cabangId = auth()->user()->cabang_id ?? 1;
            $cashReceivedValue = $isFinalPayment && $this->paymentMethod === 'cash'
                ? (int) preg_replace('/\D+/', '', (string)$this->cashReceived)
                : null;

            if ($this->isSplitPaymentMode) {
                // JALUR KELUARAN: SPLIT BILL PAYMENT

                $parentTrx = Transaction::query()->whereKey($this->editingTransactionId)->lockForUpdate()->first();
                $splitBillData = $this->splitBills[$this->currentSplitBillIndex];

                // 1. Buat invoice baru khusus untuk sub-bill yang lunas ini
                $newTrx = Transaction::create([
                    'cabang_id' => $cabangId,
                    'code' => Transaction::generateUniqueCode(),
                    'member_id' => $parentTrx->member_id,
                    'channel' => 'pos',
                    'name' => $parentTrx->name . ' (' . $splitBillData['name'] . ')',
                    'phone' => $parentTrx->phone,
                    'order_type' => $parentTrx->order_type,
                    'dining_table_id' => null, // Dikosongkan agar meja aslinya tidak lepas status terisi
                    'subtotal' => $this->subtotal,
                    'service_percentage' => $this->serviceRate,
                    'service_amount' => $this->serviceAmount,
                    'tax_percentage' => $this->taxRate,
                    'tax_amount' => $this->taxAmount,
                    'cash_received' => $cashReceivedValue,
                    'cash_change' => ($isFinalPayment && $cashReceivedValue) ? ($cashReceivedValue - $this->total) : null,
                    'total' => $this->total,
                    'payment_method' => $this->paymentMethod,
                    'bank_name' => $this->paymentMethod === 'card' ? $this->cardBankName : null,
                    'account_name' => $this->paymentMethod === 'card' ? $this->cardAccountName : null,
                    'payment_status' => 'paid',
                    'order_status' => 'completed',
                    'paid_at' => now(),
                    'payment_processed_by' => auth()->id(),
                    'external_id' => Transaction::generateUniqueCode(10),
                    'checkout_link' => '',
                ]);

                // Tulis item pesanan untuk invoice baru ini
                foreach ($this->currentSplitItems as $item) {
                    TransactionItem::create([
                        'cabang_id' => $cabangId,
                        'transaction_id' => $newTrx->id,
                        'product_id' => $item['product_id'],
                        'product_variant_id' => $item['variant_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'subtotal' => $item['quantity'] * $item['price'],
                        'note' => $item['note'] ?? null,
                    ]);
                }

                // 2. Update transaksi induk (mengurangi menu yang sudah dicabut)
                TransactionItem::where('transaction_id', $parentTrx->id)->delete();
                $newParentSubtotal = 0;
                foreach ($this->cartItems as $item) {
                    if ($item['quantity'] > 0) {
                        TransactionItem::create([
                            'cabang_id' => $cabangId,
                            'transaction_id' => $parentTrx->id,
                            'product_id' => $item['product_id'],
                            'product_variant_id' => $item['variant_id'],
                            'quantity' => $item['quantity'],
                            'price' => $item['price'],
                            'subtotal' => $item['quantity'] * $item['price'],
                            'note' => $item['note'] ?? null,
                        ]);
                        $newParentSubtotal += $item['quantity'] * $item['price'];
                    }
                }

                // Hitung ulang totalan sisa tagihan di induk
                $parentService = (int) round($newParentSubtotal * ($this->serviceRate / 100));
                $parentTax = (int) round(($newParentSubtotal + $parentService) * ($this->taxRate / 100));
                $parentTotal = $newParentSubtotal + $parentService + $parentTax;

                $parentTrx->update([
                    'subtotal' => $newParentSubtotal,
                    'service_amount' => $parentService,
                    'tax_amount' => $parentTax,
                    'total' => $parentTotal,
                ]);

                // Kunci timer meja lama agar tidak hilang
                if ($isDineIn) {
                    $currentTable = DiningTable::find($this->selectedTableId);
                    DiningTable::where('id', $this->selectedTableId)->update([
                        'status' => 'occupied',
                        'occupied_at' => $currentTable ? $currentTable->occupied_at : now()
                    ]);
                }

                $trxId = (int) $newTrx->id;

                // Bersihkan tab split bill yang selesai dibayar ini dari memori kasir
                unset($this->splitBills[$this->currentSplitBillIndex]);
            } else {
                // JALUR KELUARAN: TRANSAKSI NORMAL (ASLI)
                $trx = $this->editingTransactionId
                    ? Transaction::query()->whereKey($this->editingTransactionId)->lockForUpdate()->first()
                    : new Transaction();

                $trx->fill([
                    'code' => $trx->code ?? Transaction::generateUniqueCode(),
                    'cabang_id' => $cabangId,
                    'member_id' => $this->memberId,
                    'name' => $this->customerName,
                    'phone' => $this->customerPhone,
                    'order_type' => $this->orderType,
                    'dining_table_id' => $isDineIn ? ($this->selectedTableId ?? $trx->dining_table_id) : null,
                    'pax' => $this->numberOfPax,
                    'subtotal' => $this->subtotal,
                    'service_percentage' => $this->serviceRate,
                    'service_amount' => $this->serviceAmount,
                    'voucher_discount_amount' => $this->voucherDiscountAmount,
                    'manual_discount_amount' => $this->manualDiscountAmount,
                    'discount_total_amount' => $isFinalPayment ? $this->discountTotalAmount : 0,
                    'tax_percentage' => $this->taxRate,
                    'tax_amount' => $this->taxAmount,
                    'rounding_amount' => $this->roundingAmount,
                    'cash_received' => $cashReceivedValue,
                    'cash_change' => ($isFinalPayment && $cashReceivedValue) ? ($cashReceivedValue - $this->total) : null,
                    'total' => $isFinalPayment ? $this->total : ($this->subtotal + $this->serviceAmount + $this->taxAmount),
                    'payment_method' => $isFinalPayment ? $this->paymentMethod : 'pending',
                    'bank_name' => $this->paymentMethod === 'card' ? $this->cardBankName : null,
                    'account_name' => $this->paymentMethod === 'card' ? $this->cardAccountName : null,
                    'payment_status' => $isFinalPayment ? 'paid' : 'pending',
                    'paid_at' => $isFinalPayment ? now() : null,
                    'payment_processed_by' => $isFinalPayment ? auth()->id() : null,
                    'checkout_link' => '',
                    'external_id' => $trx->external_id ?? Transaction::generateUniqueCode(10),
                ]);

                $trx->save();

                TransactionItem::where('transaction_id', $trx->id)->delete();
                foreach ($this->cartItems as $item) {
                    TransactionItem::create([
                        'cabang_id' => $cabangId,
                        'transaction_id' => $trx->id,
                        'product_id' => $item['product_id'],
                        'product_variant_id' => $item['variant_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'subtotal' => $item['quantity'] * $item['price'],
                        'note' => $item['note'] ?? null,
                    ]);
                }

                if ($isDineIn) {
                    $targetTableId = $this->selectedTableId ?? $trx->dining_table_id;
                    if ($isFinalPayment) {
                        DiningTable::where('id', $targetTableId)->update(['status' => 'available', 'occupied_at' => null]);
                    } else {
                        $currentTable = DiningTable::find($targetTableId);
                        DiningTable::where('id', $targetTableId)->update([
                            'status' => 'occupied',
                            'occupied_at' => $currentTable ? $currentTable->occupied_at : now()
                        ]);
                    }
                }

                $trxId = (int) $trx->id;
            }
        });

        $this->dispatch('toast', type: 'success', message: $isFinalPayment ? 'Transaksi Berhasil Dilunasi!' : 'Pesanan Disimpan');

        // Cetak struk belanja khusus tagihan yang baru dibayar
        if ($isFinalPayment) {
            $payload = $this->buildPrintPayload($trxId);
            if ($payload) {
                $this->dispatch('pos-print-modal', payload: $payload, context: 'checkout');
            }
        }

        // Pembersihan akhir (Reset State)
        $this->checkoutModalOpen = false;
        $this->viewMode = 'menu';

        // Kembalikan filter cartItems agar membuang menu yang bernilai 0 karena dipotong split bill
        $this->cartItems = collect($this->cartItems)->filter(fn($item) => $item['quantity'] > 0)->values()->all();

        // Reset penampung split bill
        $this->isSplitPaymentMode = false;
        $this->currentSplitItems = [];
        $this->currentSplitBillIndex = null;

        $this->resetOrderForNewTransaction();
        $this->cashReceived = null;
        $this->cashChange = 0;
    }

    public function nextStep(): void
    {
        if ($this->checkoutStep === 1) {
            $this->validate([
                'customerName' => ['required', 'string', 'max:255'],
                'customerPhone' => ['nullable', 'string', 'max:50'],
            ]);

            $this->checkoutStep = 2;
        } elseif ($this->checkoutStep === 2) {
            if (!$this->ensureManualDiscountValid()) {
                return;
            }

            $this->checkoutStep = 3;
        }
    }

    public function prevStep(): void
    {
        if ($this->checkoutStep > 1) {
            $this->checkoutStep--;
        }
    }

    public function openSavePending(): void
    {
        if ($this->cartLocked) {
            $this->dispatch('toast', type: 'error', message: 'Pesanan self-order tidak bisa disimpan ulang.');

            return;
        }

        $this->resetValidation();
        $this->savePendingModalOpen = true;
    }

    public function openPendingOrders(): void
    {
        $this->authorize('transactions.view');

        $this->resetValidation();
        $this->pendingOrdersModalOpen = true;
    }

    public function loadPending(int $transactionId): void
    {
        $this->authorize('transactions.details');

        $trx = Transaction::query()
            ->with(['transactionItems.product', 'transactionItems.variant', 'diningTable'])
            ->whereKey($transactionId)
            ->where('payment_status', 'pending')
            ->whereIn('channel', ['pos', 'self_order'])
            ->first();

        if (! $trx) {
            return;
        }

        $this->editingTransactionId = (int) $trx->id;
        $this->orderType = (string) $trx->order_type;
        $this->selectedTableId = $trx->dining_table_id === null ? null : (int) $trx->dining_table_id;
        $this->memberId = $trx->member_id === null ? null : (int) $trx->member_id;
        $this->customerName = (string) $trx->name;
        $this->customerPhone = $trx->phone;
        $this->cartLocked = (string) $trx->channel === 'self_order';
        $this->lockedMemberId = $this->cartLocked ? $this->memberId : null;
        $this->lockedCustomerName = $this->cartLocked ? $this->customerName : null;
        $this->lockedCustomerPhone = $this->cartLocked ? $this->customerPhone : null;

        $displayItems = $trx->transactionItems
            ->whereNull('parent_transaction_item_id')
            ->values();

        $this->lockedVoucherCode = $trx->voucher_code === null ? null : (string) $trx->voucher_code;
        $this->lockedVoucherDiscountAmount = (int) ($trx->voucher_discount_amount ?? 0);
        $this->lockedVoucherAllocations = $displayItems->mapWithKeys(function (TransactionItem $item, int $index): array {
            return [$index => (int) ($item->voucher_discount_amount ?? 0)];
        })->all();
        $this->lockedPointsToRedeem = (int) ($trx->points_redeemed ?? 0);
        $this->lockedPointDiscountAmount = (int) ($trx->point_discount_amount ?? 0);

        $this->cartItems = $displayItems->map(function (TransactionItem $item) use ($trx) {
            $name = $item->product ? (string) $item->product->name : 'Produk';
            $variantName = ItemNameFormatter::displayVariantName((int) $item->product_id, $item->variant?->name);
            $price = (int) round((float) $item->price);

            $payload = [
                'id' => $item->id,
                'product_id' => (int) $item->product_id,
                'variant_id' => $item->product_variant_id === null ? 0 : (int) $item->product_variant_id,
                'name' => $item->product->name,
                'variant_name' => $variantName,
                'price' => $price,
                'original_price' => $price,
                'percent' => null,
                'quantity' => (int) $item->quantity,
                'note' => $item->note,
            ];

            if ($item->product && (bool) $item->product->is_package && (string) ($item->product->package_type ?? 'simple') === 'complex') {
                $children = $trx->transactionItems
                    ->where('parent_transaction_item_id', (int) $item->id)
                    ->values();

                $parentQty = (int) $item->quantity;
                $payload['package_type'] = 'complex';
                $payload['package_components'] = $children->map(fn(TransactionItem $child) => [
                    'product_id' => (int) $child->product_id,
                    'variant_id' => $child->product_variant_id === null ? 0 : (int) $child->product_variant_id,
                    'quantity' => $parentQty > 0 ? (int) max(1, (int) round(((int) $child->quantity) / $parentQty)) : (int) $child->quantity,
                    'note' => $child->note,
                ])->all();
            }

            return $payload;
        })->all();

        if ($trx->service_percentage > 0) {
            $this->serviceRate = (float) $trx->service_percentage;
        }

        if ($trx->tax_percentage > 0) {
            $this->taxRate = (float) $trx->tax_percentage;
        }

        $this->recalculateTotals();
        $this->pendingOrdersModalOpen = false;
    }

    public function takeSelfOrderPending(int $transactionId): void
    {
        $this->activeTab = 'pos';
        $this->loadPending($transactionId);
    }

    public function markSelfOrderProcessed(int $transactionId): void
    {
        $this->authorize('transactions.print');

        $payload = null;
        $didUpdate = false;

        DB::transaction(function () use ($transactionId, &$didUpdate): void {
            $trx = Transaction::query()
                ->whereKey($transactionId)
                ->lockForUpdate()
                ->first();

            if (! $trx) {
                return;
            }

            if ((string) $trx->channel !== 'self_order') {
                return;
            }

            if ((string) $trx->payment_method !== 'qris_midtrans') {
                return;
            }

            if ((string) $trx->payment_status !== 'paid') {
                return;
            }

            if ((bool) $trx->is_midtrans_processed) {
                return;
            }

            $trx->forceFill(['is_midtrans_processed' => true])->save();
            $didUpdate = true;
        });

        if ($didUpdate) {
            $payload = app(PosPrintPayloadService::class)->build($transactionId);
        }

        if ($payload) {
            $this->dispatch('pos-print-modal', payload: $payload, context: 'midtrans');
        }

        if ($didUpdate) {
            $this->dispatch('midtrans-processed');
            $this->dispatch('toast', type: 'success', message: 'Transaksi ditandai sudah diproses.');

            return;
        }
        $this->dispatch('toast', type: 'error', message: 'Transaksi tidak dapat diproses.');
    }

    public function saveAsPending(): void
    {
        if (count($this->cartItems) === 0) {
            return;
        }

        if ($this->cartLocked && $this->editingTransactionId !== null) {
            $this->reloadCartItemsFromTransaction((int) $this->editingTransactionId);
        } else {
            $this->applyVariantPricesToCartItems();
        }

        $this->recalculateTotals();

        if (!$this->ensureManualDiscountValid()) {
            return;
        }

        $voucherCode = null;
        $voucherCampaignId = null;
        $voucherCodeId = null;
        if ($this->voucherValid && trim((string) $this->voucherCodeInput) !== '') {
            $voucherCode = strtoupper(trim((string) $this->voucherCodeInput));
            $row = VoucherCode::query()->where('code', $voucherCode)->where('is_active', true)->first();
            if ($row && $row->campaign) {
                $voucherCampaignId = (int) $row->voucher_campaign_id;
                $voucherCodeId = (int) $row->id;
            } else {
                $voucherCode = null;
            }
        }

        $trxId = null;
        $validated = $this->validate([
            'customerName' => ['required', 'string', 'max:255'],
            'customerPhone' => ['nullable', 'string', 'max:50'],
        ]);

        $manualTypeForPermission = $this->manualDiscountType !== null ? trim((string) $this->manualDiscountType) : '';
        $manualValueForPermission = $this->manualDiscountValue === null ? 0 : (int) $this->manualDiscountValue;

        if (($manualValueForPermission > 0 || $manualTypeForPermission !== '') && ! $this->userHasManualDiscountPermission()) {
            $this->addError('manualDiscountType', 'Anda tidak memiliki izin untuk memberikan diskon manual.');
            return;
        }

        if ($this->orderType === 'dine_in' && ! $this->selectedTableId) {
            $this->dispatch('toast', type: 'error', message: 'Order dine-in wajib memilih meja.');
            return;
        }

        DB::transaction(function () use ($validated, $voucherCampaignId, $voucherCodeId, $voucherCode, &$trxId) {
            $trx = $this->editingTransactionId
                ? Transaction::query()->whereKey($this->editingTransactionId)->lockForUpdate()->first()
                : null;

            $manualType = $this->manualDiscountAmount > 0 ? $this->manualDiscountType : null;
            $manualValue = $this->manualDiscountAmount > 0 ? $this->manualDiscountValue : null;
            $manualNote = $this->manualDiscountAmount > 0 ? $this->manualDiscountNote : null;

            // Pastikan data cabang terisi dari user yang login
            $cabangId = auth()->user()->cabang_id ?? 1;

            if (! $trx) {
                $trx = Transaction::query()->create([
                    'code' => Transaction::generateUniqueCode(),
                    'cabang_id' => $cabangId, // Field wajib dari skema tabel kamu
                    'member_id' => $this->memberId,
                    'channel' => 'pos',
                    'name' => $validated['customerName'],
                    'phone' => $validated['customerPhone'] !== '' ? $validated['customerPhone'] : null,
                    'email' => null,
                    'order_type' => $this->orderType,
                    'dining_table_id' => $this->orderType === 'dine_in' ? $this->selectedTableId : null,
                    'pax' => $this->numberOfPax,
                    'voucher_campaign_id' => $voucherCampaignId,
                    'voucher_code_id' => $voucherCodeId,
                    'voucher_code' => $voucherCode,
                    'subtotal' => $this->subtotal,
                    'service_percentage' => $this->serviceRate,
                    'service_amount' => $this->serviceAmount,
                    'voucher_discount_amount' => $this->voucherDiscountAmount,
                    'manual_discount_type' => $manualType,
                    'manual_discount_value' => $manualValue,
                    'manual_discount_amount' => $this->manualDiscountAmount,
                    'manual_discount_note' => $manualNote,
                    'manual_discount_by_user_id' => auth()->id(),
                    'discount_total_amount' => $this->discountTotalAmount,
                    'point_discount_amount' => 0,
                    'points_redeemed' => 0,
                    'points_earned' => 0,
                    'tax_percentage' => $this->taxRate,
                    'tax_amount' => $this->taxAmount,
                    'rounding_amount' => $this->roundingAmount,
                    'cash_received' => null,
                    'cash_change' => null,
                    'total' => $this->total,
                    'checkout_link' => '',
                    'payment_method' => 'pending',
                    'payment_status' => 'pending',
                    'order_status' => 'new',
                    'external_id' => Transaction::generateUniqueCode(10),
                ]);
            } else {
                $trx->update([
                    'member_id' => $this->memberId,
                    'name' => $validated['customerName'],
                    'phone' => $validated['customerPhone'] !== '' ? $validated['customerPhone'] : null,
                    'order_type' => $this->orderType,
                    'dining_table_id' => $this->orderType === 'dine_in' ? $this->selectedTableId : null,
                    'voucher_campaign_id' => $voucherCampaignId,
                    'voucher_code_id' => $voucherCodeId,
                    'voucher_code' => $voucherCode,
                    'subtotal' => $this->subtotal,
                    'service_percentage' => $this->serviceRate,
                    'service_amount' => $this->serviceAmount,
                    'voucher_discount_amount' => $this->voucherDiscountAmount,
                    'manual_discount_type' => $manualType,
                    'manual_discount_value' => $manualValue,
                    'manual_discount_amount' => $this->manualDiscountAmount,
                    'manual_discount_note' => $manualNote,
                    'manual_discount_by_user_id' => auth()->id(),
                    'discount_total_amount' => $this->discountTotalAmount,
                    'total' => $this->total,
                    'tax_percentage' => $this->taxRate,
                    'tax_amount' => $this->taxAmount,
                    'rounding_amount' => $this->roundingAmount,
                ]);
                TransactionItem::query()->where('transaction_id', $trx->id)->delete();
            }

            $manualAllocations = $this->allocateManualDiscount($this->cartItems, $this->manualDiscountAmount, $this->voucherAllocations);

            foreach ($this->cartItems as $index => $item) {
                $productId = (int) ($item['product_id'] ?? 0);
                $variantId = (int) ($item['variant_id'] ?? 0);
                $qty = (int) ($item['quantity'] ?? 0);
                $price = (int) ($item['price'] ?? 0);
                $note = $item['note'] ?? null;

                if ($productId <= 0 || $variantId <= 0 || $qty <= 0) {
                    continue;
                }

                TransactionItem::query()->create([
                    'cabang_id' => $cabangId, // Field wajib dari skema tabel kamu
                    'transaction_id' => $trx->id,
                    'product_id' => $productId,
                    'product_variant_id' => $variantId,
                    'quantity' => $qty,
                    'price' => $price,
                    'subtotal' => $qty * $price,
                    'note' => $note === '' ? null : $note,
                ]);
            }

            if ($this->orderType === 'dine_in' && ! $this->selectedTableId) {
                $this->dispatch('toast', type: 'error', message: 'Order dine-in wajib memilih meja.');
                return;
            }

            // KUNCI UTAMA: Update Status Meja Makan Menjadi TERISI & ISI TIMER
            if ($this->orderType === 'dine_in' && $this->selectedTableId) {
                DB::table('dining_tables')->where('id', $this->selectedTableId)->update([
                    'status' => 'occupied',
                    'occupied_at' => now(), // Mengisi parameter awal mula waktu timer diaktifkan
                ]);
            }

            $trxId = (int) $trx->id;
        });

        if (class_exists(\App\Models\TransactionEvent::class) && $this->editingTransactionId) {
            try {
                TransactionEvent::create([
                    'transaction_id' => $trxId,
                    'actor_user_id' => auth()->id(),
                    'action' => 'save_order',
                    'meta' => ['message' => 'Pesanan disimpan kembali ke dapur']
                ]);
            } catch (\Exception $e) {
            }
        }

        $this->dispatch('toast', type: 'success', message: 'Pesanan meja berhasil disimpan & dikirim ke dapur.');
        $this->savePendingModalOpen = false;

        // Reset properti agar tampilan otomatis dialihkan kembali ke list denah meja makan
        $this->resetOrderForNewTransaction();
    }

    public function deletePending(int $transactionId): void
    {
        $this->authorize('transactions.void');

        $deleted = DB::transaction(function () use ($transactionId) {
            $trx = Transaction::query()
                ->whereKey($transactionId)
                ->lockForUpdate()
                ->first();

            if (! $trx) return false;

            if ($trx->order_type === 'dine_in' && $trx->dining_table_id) {
                DiningTable::where('id', $trx->dining_table_id)->update([
                    'status' => 'available',
                    'occupied_at' => null,
                ]);
            }

            TransactionItem::query()->where('transaction_id', $trx->id)->delete();
            $trx->delete();

            return true;
        });

        if (! $deleted) {
            return;
        }

        if ($this->editingTransactionId === (int) $transactionId) {
            $this->resetOrderForNewTransaction();
        }

        $this->dispatch('toast', type: 'success', message: 'Pesanan pending berhasil dihapus.');
    }

    private function ensureManualDiscountValid(): bool
    {
        $type = $this->manualDiscountType !== null ? trim((string) $this->manualDiscountType) : '';
        $value = $this->manualDiscountValue === null ? null : (int) $this->manualDiscountValue;

        if (($value ?? 0) > 0 && $type === '') {
            $this->addError('manualDiscountType', 'Tipe diskon wajib dipilih.');

            return false;
        }

        if ($type !== '' && ! in_array($type, ['percent', 'fixed_amount'], true)) {
            $this->addError('manualDiscountType', 'Tipe diskon tidak valid.');

            return false;
        }

        if ($type !== '' && ($value === null || $value <= 0)) {
            $this->addError('manualDiscountValue', 'Nilai diskon wajib diisi.');

            return false;
        }

        if ($type === 'percent' && $value !== null && ($value < 0 || $value > 100)) {
            $this->addError('manualDiscountValue', 'Diskon persen harus 0 - 100.');

            return false;
        }

        if ($type === 'fixed_amount' && $value !== null && $value < 0) {
            $this->addError('manualDiscountValue', 'Nilai diskon tidak valid.');

            return false;
        }

        return true;
    }

    public function checkout(): void
    {
        if (count($this->cartItems) === 0) return;

        $isDineIn = $this->orderType === 'dine_in';
        $isEditing = $this->editingTransactionId !== null;

        $isFinalPayment = ($this->orderType === 'take_away' || ($isDineIn && $isEditing));

        $this->recalculateTotals();

        $rules = [
            'customerName' => ['required', 'string', 'max:255'],
            'customerPhone' => ['nullable', 'string', 'max:50'],
            'taxRate' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ];

        if ($isFinalPayment) {
            $rules['paymentMethod'] = ['required', 'string', 'max:50'];
            if ($this->paymentMethod === 'cash') {
                $rules['cashReceived'] = ['required', 'numeric', 'min:' . $this->total];
            }
        }

        $validated = $this->validate($rules);

        $trxId = null;
        $previousPaymentStatus = null;

        DB::transaction(function () use ($isDineIn, $isFinalPayment, $validated, &$trxId, &$previousPaymentStatus) {
            $trx = $this->editingTransactionId
                ? Transaction::query()->whereKey($this->editingTransactionId)->lockForUpdate()->first()
                : new Transaction();

            $previousPaymentStatus = (string) $trx->payment_status;

            // Ambil nominal cash (bersihkan karakter non-digit jika ada)
            $cashReceivedValue = $isFinalPayment && $this->paymentMethod === 'cash'
                ? (int) preg_replace('/\D+/', '', (string)$this->cashReceived)
                : null;

            $trx->fill([
                'code' => $trx->code ?? Transaction::generateUniqueCode(),
                'member_id' => $this->memberId,
                'name' => $this->customerName,
                'phone' => $this->customerPhone,
                'order_type' => $this->orderType,
                'dining_table_id' => $isDineIn ? ($this->selectedTableId ?? $trx->dining_table_id) : null,
                'subtotal' => $this->subtotal,
                'service_percentage' => $this->serviceRate,
                'service_amount' => $isFinalPayment ? $this->serviceAmount : $this->serviceAmount,
                'tax_percentage' => $this->taxRate,
                'tax_amount' => $isFinalPayment ? $this->taxAmount : $this->taxAmount,
                'total' => $isFinalPayment ? $this->total : ($this->subtotal + $this->serviceAmount + $this->taxAmount),
                'payment_method' => $isFinalPayment ? $this->paymentMethod : 'pending',
                'bank_name' => $this->paymentMethod === 'card' ? $this->cardBankName : null,
                'account_name' => $this->paymentMethod === 'card' ? $this->cardAccountName : null,
                'payment_status' => $isFinalPayment ? 'paid' : 'pending',
                'paid_at' => $isFinalPayment ? now() : null,
                'payment_processed_by' => $isFinalPayment ? auth()->id() : null,
                'checkout_link' => '',
                'external_id' => $trx->external_id ?? Transaction::generateUniqueCode(10),
                'tax_percentage' => $this->taxRate,
                'tax_amount' => $isFinalPayment ? $this->taxAmount : $this->taxAmount,
                'discount_total_amount' => $isFinalPayment ? $this->discountTotalAmount : 0,
                'cash_received' => $cashReceivedValue,
                'cash_change' => ($isFinalPayment && $cashReceivedValue) ? ($cashReceivedValue - $this->total) : null,
            ]);

            $trx->save();

            TransactionItem::where('transaction_id', $trx->id)->delete();
            foreach ($this->cartItems as $item) {
                TransactionItem::create([
                    'transaction_id' => $trx->id,
                    'product_id' => $item['product_id'],
                    'product_variant_id' => $item['variant_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['quantity'] * $item['price'],
                ]);
            }

            if ($isDineIn) {
                $targetTableId = $this->selectedTableId ?? $trx->dining_table_id;
                if ($isFinalPayment && !$this->isSplitPaymentMode) {
                    DiningTable::where('id', $targetTableId)->update(['status' => 'available', 'occupied_at' => null]);
                } else {
                    $currentTable = DiningTable::find($targetTableId);
                    $oldOccupiedAt = $currentTable ? $currentTable->occupiedAt : now();
                    DiningTable::where('id', $targetTableId)->update(['status' => 'occupied', 'occupied_at' => now()]);
                }
            }

            $trxId = (int) $trx->id;
        });

        $this->dispatch('toast', type: 'success', message: $isFinalPayment ? 'Transaksi Lunas' : 'Pesanan Disimpan');

        if ($isFinalPayment) {
            $payload = $this->buildPrintPayload($trxId);
            if ($payload) {
                $this->dispatch('pos-print-modal', payload: $payload, context: 'checkout');
            }
        }

        $this->checkoutModalOpen = false;
        $this->resetOrderForNewTransaction();
    }

    public function printBill(): void
    {
        // Cek apakah ada transaksi yang sedang diedit (meja terisi/pesanan sudah di-save)
        if (! $this->editingTransactionId) {
            $this->dispatch('toast', type: 'error', message: 'Pesanan belum disimpan. Silakan klik "Pesan" atau "Simpan" terlebih dahulu.');
            return;
        }

        // Ambil payload cetak menggunakan fungsi internal yang sudah ada di baris 1109
        $payload = $this->buildPrintPayload($this->editingTransactionId);

        if ($payload) {
            // Dispatch event ke frontend untuk memunculkan modal print
            // Kita gunakan context 'bill_check' supaya printer tahu ini struk sementara, bukan struk lunas
            $this->dispatch('pos-print-modal', payload: $payload, context: 'bill_check');
            $this->dispatch('toast', type: 'success', message: 'Permintaan cetak bill berhasil dikirim.');
        } else {
            $this->dispatch('toast', type: 'error', message: 'Gagal menyiapkan data cetak.');
        }
    }

    private function userHasManualDiscountPermission(): bool
    {
        $user = auth()->user();
        if (! $user) {
            return false;
        }

        if ($user->permissions()->where('name', 'discounts.manual.apply')->exists()) {
            return true;
        }

        return $user->roles()
            ->whereHas('permissions', fn($q) => $q->where('name', 'discounts.manual.apply'))
            ->exists();
    }

    private function allocateManualDiscount(array $cartItems, int $manualDiscountAmount, array $voucherAllocations): array
    {
        $manualDiscountAmount = max(0, (int) $manualDiscountAmount);
        if ($manualDiscountAmount <= 0) {
            return [];
        }

        $bases = [];
        $sum = 0;

        foreach ($cartItems as $index => $item) {
            $qty = (int) ($item['quantity'] ?? 0);
            $price = (int) ($item['price'] ?? 0);
            $subtotal = $qty > 0 && $price >= 0 ? $qty * $price : 0;
            $voucher = (int) ($voucherAllocations[$index] ?? 0);
            $base = max(0, $subtotal - $voucher);

            $bases[$index] = $base;
            $sum += $base;
        }

        if ($sum <= 0) {
            return [];
        }

        $allocations = [];
        $remainders = [];
        $allocated = 0;

        foreach ($bases as $index => $base) {
            $raw = ($manualDiscountAmount * $base) / $sum;
            $floor = (int) floor($raw);
            $allocations[$index] = $floor;
            $remainders[$index] = $raw - $floor;
            $allocated += $floor;
        }

        $left = $manualDiscountAmount - $allocated;
        if ($left > 0) {
            arsort($remainders);
            foreach (array_keys($remainders) as $index) {
                if ($left <= 0) {
                    break;
                }
                $allocations[$index] = (int) $allocations[$index] + 1;
                $left--;
            }
        }

        return $allocations;
    }

    private function createPackageChildItems(Transaction $trx, TransactionItem $parent, Product $product, array $cartItem, int $parentQty): void
    {
        $packageType = (string) ($product->package_type ?? 'simple');

        if ($packageType === 'complex') {
            $components = $cartItem['package_components'] ?? [];
            if (! is_array($components)) {
                return;
            }

            $merged = [];
            foreach ($components as $row) {
                if (! is_array($row)) {
                    continue;
                }

                $componentProductId = (int) ($row['product_id'] ?? 0);
                $componentVariantId = (int) ($row['variant_id'] ?? 0);
                $componentBaseQty = (int) ($row['quantity'] ?? 0);
                $componentNote = $row['note'] ?? null;

                if ($componentProductId <= 0 || $componentVariantId <= 0 || $componentBaseQty <= 0) {
                    continue;
                }

                $note = $componentNote === '' ? null : $componentNote;
                $key = $componentProductId . '|' . $componentVariantId . '|' . trim((string) ($note ?? ''));

                if (! array_key_exists($key, $merged)) {
                    $merged[$key] = [
                        'product_id' => $componentProductId,
                        'variant_id' => $componentVariantId,
                        'base_qty' => 0,
                        'note' => $note,
                    ];
                }

                $merged[$key]['base_qty'] += $componentBaseQty;
            }

            foreach (array_values($merged) as $row) {
                $componentQty = $parentQty * (int) ($row['base_qty'] ?? 0);
                if ($componentQty <= 0) {
                    continue;
                }

                TransactionItem::query()->create([
                    'transaction_id' => $trx->id,
                    'parent_transaction_item_id' => (int) $parent->id,
                    'product_id' => (int) ($row['product_id'] ?? 0),
                    'product_variant_id' => (int) ($row['variant_id'] ?? 0),
                    'quantity' => $componentQty,
                    'price' => 0,
                    'subtotal' => 0,
                    'voucher_discount_amount' => 0,
                    'manual_discount_amount' => 0,
                    'note' => $row['note'] ?? null,
                ]);
            }

            return;
        }

        $note = $cartItem['note'] ?? null;

        foreach ($product->packageItems as $packageItem) {
            $componentVariant = $packageItem->componentVariant;
            if (! $componentVariant) {
                continue;
            }

            $componentQty = $parentQty * (int) $packageItem->quantity;
            if ($componentQty <= 0) {
                continue;
            }

            TransactionItem::query()->create([
                'transaction_id' => $trx->id,
                'parent_transaction_item_id' => (int) $parent->id,
                'product_id' => (int) $componentVariant->product_id,
                'product_variant_id' => (int) $componentVariant->id,
                'quantity' => $componentQty,
                'price' => 0,
                'subtotal' => 0,
                'voucher_discount_amount' => 0,
                'manual_discount_amount' => 0,
                'note' => $note === '' ? null : $note,
            ]);
        }
    }

    private function buildPrintPayload(int $transactionId): ?array
    {
        return app(PosPrintPayloadService::class)->build($transactionId);
    }


    public function updatedCashReceived(): void
    {
        $isCash = $this->paymentMethod === 'cash';
        if (! $isCash) {
            $this->cashChange = 0;

            return;
        }

        $cashReceived = (int) preg_replace('/\D+/', '', (string) ($this->cashReceived ?? '0'));
        $this->cashChange = max(0, $cashReceived - $this->total);
    }

    /**
     * Mengeksekusi pembatalan pesanan meja (Cancel Table)
     */
    public function confirmCancel()
    {
        // Validasi input alasan wajib diisi minimal 5 karakter
        $this->validate([
            'cancelTableReason' => 'required|string|min:5',
        ], [
            'cancelTableReason.required' => 'Alasan pembatalan wajib diisi.',
            'cancelTableReason.min' => 'Alasan minimal harus 5 karakter.',
        ]);

        // JIKA PESANAN SUDAH PERNAH TERSIMPAN DI DATABASE (Meja Occupied)
        if ($this->editingTransactionId !== null) {
            DB::transaction(function () {
                $trx = Transaction::query()->whereKey($this->editingTransactionId)->lockForUpdate()->first();

                if ($trx) {
                    // 1. Kosongkan kembali status meja makan menjadi tersedia (Warna Biru)
                    if ($trx->dining_table_id) {
                        DB::table('dining_tables')->where('id', $trx->dining_table_id)->update([
                            'status' => 'available',
                            'occupied_at' => null
                        ]);
                    }

                    // 2. Lakukan Soft Void (Isi kolom pembatalan audit tanpa menghapus data laporan)
                    $trx->update([
                        'payment_status' => 'void',
                        'order_status' => 'void',
                        'voided_at' => now(),
                        'voided_by_user_id' => auth()->id(),
                        'void_reason' => $this->cancelTableReason,
                    ]);

                    // Tambahkan log aktivitas jika tabel audit event tersedia
                    if (class_exists(\App\Models\TransactionEvent::class)) {
                        TransactionEvent::create([
                            'transaction_id' => $trx->id,
                            'actor_user_id' => auth()->id(),
                            'action' => 'cancel_table',
                            'meta' => ['reason' => $this->cancelTableReason]
                        ]);
                    }
                }
            });

            $this->dispatch('toast', type: 'success', message: 'Pesanan meja berhasil dibatalkan & di-audit.');
        } else {
            // JIKA TRANSAKSI BARU (Belum masuk database sama sekali)
            $this->dispatch('toast', type: 'success', message: 'Meja dilepas.');
        }

        // Tutup modal, bersihkan keranjang, balikkan halaman ke denah meja
        $this->cancelTableModalOpen = false;
        $this->cancelTableReason = '';
        $this->resetOrderForNewTransaction();
    }

    public function importTransactionCode(): void
    {
        $this->authorize('transactions.details');

        $code = trim($this->scanCode);
        if ($code === '') {
            return;
        }

        $trx = Transaction::query()
            ->with(['transactionItems.product', 'transactionItems.variant', 'diningTable'])
            ->where('code', $code)
            ->where('payment_status', 'pending')
            ->first();

        if (! $trx) {
            $this->dispatch('toast', type: 'error', message: 'Transaksi tidak ditemukan atau sudah dibayar.');
            $this->scanCode = '';

            return;
        }

        $this->editingTransactionId = (int) $trx->id;
        $this->orderType = (string) $trx->order_type;
        $this->selectedTableId = $trx->dining_table_id === null ? null : (int) $trx->dining_table_id;
        $this->memberId = $trx->member_id === null ? null : (int) $trx->member_id;
        $this->customerName = (string) $trx->name;
        $this->customerPhone = $trx->phone;
        $this->cartLocked = (string) $trx->channel === 'self_order';

        $this->lockedVoucherCode = $trx->voucher_code === null ? null : (string) $trx->voucher_code;
        $this->lockedVoucherDiscountAmount = (int) ($trx->voucher_discount_amount ?? 0);
        $this->lockedVoucherAllocations = $trx->transactionItems->mapWithKeys(function (TransactionItem $item, int $index): array {
            return [$index => (int) ($item->voucher_discount_amount ?? 0)];
        })->all();
        $this->lockedPointsToRedeem = (int) ($trx->points_redeemed ?? 0);
        $this->lockedPointDiscountAmount = (int) ($trx->point_discount_amount ?? 0);

        $this->cartItems = $trx->transactionItems->map(function (TransactionItem $item) {
            $name = $item->product ? (string) $item->product->name : 'Produk';
            $variantName = ItemNameFormatter::displayVariantName((int) $item->product_id, $item->variant?->name);
            $price = (int) round((float) $item->price);

            return [
                'product_id' => (int) $item->product_id,
                'variant_id' => $item->product_variant_id === null ? 0 : (int) $item->product_variant_id,
                'name' => $name,
                'variant_name' => $variantName,
                'price' => $price,
                'original_price' => $price,
                'percent' => null,
                'quantity' => (int) $item->quantity,
                'note' => $item->note,
            ];
        })->all();


        if ($trx->service_percentage > 0) {
            $this->serviceRate = (float) $trx->service_percentage;
        }

        if ($trx->tax_percentage > 0) {
            $this->taxRate = (float) $trx->tax_percentage;
        }

        // $this->taxRate = $trx->tax_percentage === null ? $this->taxRate : (float) $trx->tax_percentage;
        // $this->voucherCodeInput = $this->lockedVoucherCode;
        // $this->recalculateTotals();

        $this->recalculateTotals();
        $this->pendingOrdersModalOpen = false;

        $this->scanCode = '';
        $this->dispatch('toast', type: 'success', message: 'Transaksi dimuat.');
    }

    public function updatedTaxRate(): void
    {
        $this->recalculateTotals();
    }

    public function updatedServiceRate(): void
    {
        $this->recalculateTotals();
    }

    public function getPendingTransactionsProperty()
    {
        if (! auth()->user()?->can('transactions.view')) {
            return collect();
        }

        return Transaction::query()
            ->where('channel', 'pos')
            ->where('payment_status', 'pending')
            ->with(['diningTable'])
            ->withCount('transactionItems')
            ->orderByDesc('updated_at')
            ->limit(20)
            ->get();
    }

    public function getSelfOrderPaidUnprocessedProperty()
    {
        if (! auth()->user()?->can('transactions.view')) {
            return collect();
        }

        return Transaction::query()
            ->where('channel', 'self_order')
            ->where('payment_method', 'qris_midtrans')
            ->where('payment_status', 'paid')
            ->where('is_midtrans_processed', false)
            ->with(['diningTable'])
            ->withCount('transactionItems')
            ->latest('paid_at')
            ->limit(30)
            ->get();
    }

    public function getSelfOrderCashPendingProperty()
    {
        if (! auth()->user()?->can('transactions.view')) {
            return collect();
        }

        return Transaction::query()
            ->where('channel', 'self_order')
            ->where('payment_method', 'cash')
            ->where('payment_status', 'pending')
            ->with(['diningTable'])
            ->withCount('transactionItems')
            ->orderByDesc('updated_at')
            ->limit(30)
            ->get();
    }

    public function getCategoriesProperty()
    {
        return Category::query()->orderBy('name')->get(['id', 'name']);
    }

    public function getTablesProperty(): array
    {
        return DiningTable::query()
            // Gunakan trik yang sama di sini
            ->orderByRaw('table_number + 0')
            ->get(['id', 'table_number', 'status', 'occupied_at'])
            ->map(fn(DiningTable $t) => [
                'id' => (int) $t->id,
                'label' => $t->table_number,
                'number' => (string) $t->table_number,
                'status' => $t->status ?? 'available',
                'occupied_at' => $t->occupied_at ? $t->occupied_at->toDateTimeString() : null,
            ])
            ->all();
    }

    public function getMembersProperty()
    {
        if (! auth()->user()?->can('members.view')) {
            return collect();
        }

        return Member::query()
            ->orderBy('name')
            ->limit(200)
            ->get(['id', 'name', 'phone']);
    }

    public function getProductsProperty()
    {
        $term = trim($this->search);

        $products = Product::query()
            ->where('is_available', true)
            ->when($this->selectedCategoryId, fn(Builder $q) => $q->where('category_id', $this->selectedCategoryId))
            ->when($term !== '', function (Builder $q) use ($term) {
                $like = '%' . $term . '%';
                $q->where(function (Builder $qq) use ($like) {
                    $qq->where('name', 'like', $like)->orWhere('description', 'like', $like);
                });
            })
            ->with(['variants' => function ($q) {
                $q->orderBy('id');
            }])
            ->orderBy('name')
            ->limit(120)
            ->get();

        return $products;
    }

    private function finalVariantPrice(ProductVariant $variant): int
    {
        $base = (int) round((float) $variant->price);
        $after = $variant->price_afterdiscount === null ? null : (int) round((float) $variant->price_afterdiscount);
        if ($after !== null && $after > 0 && $after < $base) {
            return $after;
        }

        $percent = $variant->percent === null ? 0 : (int) $variant->percent;
        if ($percent > 0 && $percent < 100) {
            $computed = (int) round($base - ($base * ($percent / 100)));

            return max(0, $computed);
        }

        return $base;
    }

    private function applyVariantPricesToCartItems(): void
    {
        $variantIds = collect($this->cartItems)
            ->filter(fn($row) => is_array($row))
            ->map(fn(array $row) => (int) ($row['variant_id'] ?? 0))
            ->filter(fn(int $id) => $id > 0)
            ->unique()
            ->values()
            ->all();

        if ($variantIds === []) {
            $this->cartItems = [];

            return;
        }

        $variants = ProductVariant::query()
            ->with('product')
            ->whereIn('id', $variantIds)
            ->get()
            ->keyBy('id');

        $normalized = [];
        foreach ($this->cartItems as $row) {
            if (! is_array($row)) {
                continue;
            }

            $variantId = (int) ($row['variant_id'] ?? 0);
            $qty = (int) ($row['quantity'] ?? 0);

            if ($variantId <= 0 || $qty <= 0) {
                continue;
            }

            $variant = $variants->get($variantId);
            if (! $variant || ! $variant->product) {
                continue;
            }

            $final = $this->finalVariantPrice($variant);
            $base = (int) round((float) $variant->price);

            $row['product_id'] = (int) $variant->product->id;
            $row['name'] = (string) $variant->product->name;
            $row['variant_name'] = ItemNameFormatter::displayVariantName((int) $variant->product->id, (string) $variant->name);
            $row['price'] = $final;
            $row['original_price'] = $base;
            $row['percent'] = $variant->percent === null ? null : (int) $variant->percent;
            $row['quantity'] = $qty;

            if (array_key_exists('note', $row) && $row['note'] === '') {
                $row['note'] = null;
            }

            $normalized[] = $row;
        }

        $this->cartItems = array_values($normalized);
    }

    private function reloadCartItemsFromTransaction(int $transactionId): void
    {
        $trx = Transaction::query()
            ->with(['transactionItems.product', 'transactionItems.variant'])
            ->whereKey($transactionId)
            ->where('payment_status', 'pending')
            ->first();

        if (! $trx) {
            return;
        }

        $displayItems = $trx->transactionItems
            ->whereNull('parent_transaction_item_id')
            ->values();

        $this->cartItems = $displayItems->map(function (TransactionItem $item) use ($trx) {
            $name = $item->product ? (string) $item->product->name : 'Produk';
            $variantName = ItemNameFormatter::displayVariantName((int) $item->product_id, $item->variant?->name);
            $price = (int) round((float) $item->price);

            $payload = [
                'product_id' => (int) $item->product_id,
                'variant_id' => $item->product_variant_id === null ? 0 : (int) $item->product_variant_id,
                'name' => $name,
                'variant_name' => $variantName,
                'price' => $price,
                'original_price' => $price,
                'percent' => null,
                'quantity' => (int) $item->quantity,
                'note' => $item->note,
            ];

            if ($item->product && (bool) $item->product->is_package && (string) ($item->product->package_type ?? 'simple') === 'complex') {
                $children = $trx->transactionItems
                    ->where('parent_transaction_item_id', (int) $item->id)
                    ->values();

                $parentQty = (int) $item->quantity;
                $payload['package_type'] = 'complex';
                $payload['package_components'] = $children->map(fn(TransactionItem $child) => [
                    'product_id' => (int) $child->product_id,
                    'variant_id' => $child->product_variant_id === null ? 0 : (int) $child->product_variant_id,
                    'quantity' => $parentQty > 0 ? (int) max(1, (int) round(((int) $child->quantity) / $parentQty)) : (int) $child->quantity,
                    'note' => $child->note,
                ])->all();
            }

            return $payload;
        })->all();
    }

    private function recalculateTotals(): void
    {
        $subtotal = 0;
        foreach ($this->cartItems as $item) {
            $qty = (int) ($item['quantity'] ?? 0);
            $price = (int) ($item['price'] ?? 0);
            if ($qty > 0 && $price >= 0) {
                $subtotal += $qty * $price;
            }
        }

        $this->subtotal = max(0, $subtotal);

        $this->discountTotalAmount = max(0, $this->voucherDiscountAmount + $this->manualDiscountAmount + $this->pointDiscountAmount);
        $netSubtotal = max(0, $this->subtotal - $this->discountTotalAmount);
        $this->netSubtotal = $netSubtotal;

        // $this->serviceAmount = (int) round($netSubtotal * ((float) ($this->serviceRate ?? 0) / 100));
        $this->serviceAmount = (int) round($netSubtotal * ((float) ($this->serviceRate ?? 0) / 100));

        if ($this->orderType === 'take_away') {
            $this->serviceAmount = 0;
        } else {
            $this->serviceAmount = (int) round($netSubtotal * ((float) ($this->serviceRate ?? 0) / 100));
        }

        $this->voucherValid = false;
        $this->voucherDiscountAmount = 0;
        $this->voucherMessage = '';
        $this->voucherAllocations = [];

        $isLockedTransaction = $this->cartLocked && $this->editingTransactionId !== null;
        if ($isLockedTransaction) {
            $code = trim((string) ($this->lockedVoucherCode ?? ''));
            $this->voucherCodeInput = $code !== '' ? $code : null;
            $this->voucherValid = $code !== '' && $this->lockedVoucherDiscountAmount > 0;
            $this->voucherDiscountAmount = max(0, (int) $this->lockedVoucherDiscountAmount);
            $this->voucherAllocations = (array) $this->lockedVoucherAllocations;
            $this->voucherMessage = $this->voucherValid ? 'Voucher diterapkan.' : '';
        } else {
            $code = trim((string) ($this->voucherCodeInput ?? ''));
            if ($code !== '' && $this->subtotal > 0) {
                $member = null;
                if ($this->memberId) {
                    $member = Member::query()->find($this->memberId);
                }
                $guestId = $member ? null : ($this->customerPhone ? trim((string) $this->customerPhone) : null);

                $elig = app(\App\Services\Vouchers\VoucherEligibilityService::class)
                    ->validate($code, $member, $this->cartItems, $guestId);

                if ((bool) ($elig['ok'] ?? false)) {
                    $this->voucherValid = true;
                    $this->voucherMessage = (string) ($elig['message'] ?? 'Voucher dapat digunakan.');
                    $this->voucherDiscountAmount = (int) ($elig['discount_amount'] ?? 0);

                    $allocations = (array) ($elig['allocations'] ?? []);
                    $eligibleLines = (array) ($elig['eligible_lines'] ?? []);
                    $byIndex = [];
                    foreach ($eligibleLines as $i => $line) {
                        $idx = (int) ($line['index'] ?? -1);
                        if ($idx >= 0) {
                            $byIndex[$idx] = (int) ($allocations[$i] ?? 0);
                        }
                    }
                    $this->voucherAllocations = $byIndex;
                } else {
                    $this->voucherMessage = (string) ($elig['message'] ?? 'Voucher tidak bisa digunakan.');
                }
            }
        }

        $this->manualDiscountAmount = 0;

        $manualType = $this->manualDiscountType ? (string) $this->manualDiscountType : null;
        $manualValue = $this->manualDiscountValue === null ? null : (int) $this->manualDiscountValue;

        if ($manualType !== null && $manualValue !== null && $manualValue > 0) {
            $base = max(0, $this->subtotal - $this->voucherDiscountAmount);

            if ($manualType === 'percent') {
                $pct = max(0, min(100, $manualValue));
                $this->manualDiscountAmount = (int) round($base * ($pct / 100));
            } elseif ($manualType === 'fixed_amount') {
                $this->manualDiscountAmount = min($base, max(0, $manualValue));
            } else {
                $this->manualDiscountAmount = 0;
            }
        }

        $this->pointDiscountAmount = 0;
        $this->pointsToRedeem = 0;

        if ($isLockedTransaction) {
            $this->pointsToRedeem = max(0, (int) $this->lockedPointsToRedeem);
            $this->pointDiscountAmount = max(0, (int) $this->lockedPointDiscountAmount);
            $this->redeemPoints = $this->pointsToRedeem > 0;
        } elseif ($this->redeemPoints && $this->memberPoints >= $this->minRedemptionPoints && $this->pointRedemptionValue > 0) {
            $baseForPoints = max(0, $this->subtotal - $this->voucherDiscountAmount - $this->manualDiscountAmount);
            if ($baseForPoints > 0) {
                // Calculate max points needed to cover the base amount
                $maxPointsNeeded = (int) floor($baseForPoints / $this->pointRedemptionValue);

                // Use the lesser of member points or max needed
                $pointsToUse = min($this->memberPoints, $maxPointsNeeded);

                $this->pointsToRedeem = $pointsToUse;
                $this->pointDiscountAmount = (int) ($pointsToUse * $this->pointRedemptionValue);

                // Cap at base amount just in case rounding causes issues
                $this->pointDiscountAmount = min($this->pointDiscountAmount, $baseForPoints);
            }
        }

        $this->discountTotalAmount = max(0, $this->voucherDiscountAmount + $this->manualDiscountAmount + $this->pointDiscountAmount);
        $netSubtotal = max(0, $this->subtotal - $this->discountTotalAmount);
        $this->netSubtotal = $netSubtotal;

        // $taxBase = $this->discountAppliesBeforeTax ? $netSubtotal : $this->subtotal;
        $taxBase = $netSubtotal + $this->serviceAmount;
        $this->taxAmount = (int) round($taxBase * ((float) ($this->taxRate) / 100));

        $rawTotal = $netSubtotal + $this->serviceAmount + $this->taxAmount;

        if ($this->roundingBase <= 0) {
            $this->roundingAmount = 0;
            $this->total = $rawTotal;
        } else {
            $rounded = (int) (round($rawTotal / $this->roundingBase) * $this->roundingBase);
            $this->roundingAmount = $rounded - $rawTotal;
            $this->total = $rawTotal + $this->roundingAmount;
        }

        $this->updatedCashReceived();
    }

    public function openSplitBill(): void
    {
        if (count($this->cartItems) === 0) {
            $this->dispatch('toast', type: 'error', message: 'Keranjang belanja kosong.');
            return;
        }

        // Inisialisasi awal: Kita buatkan 2 Bill kosong secara default seperti di gambar UI kamu
        $this->splitBills = [
            1 => [
                'name' => 'Bill - 1',
                'items' => []
            ],
            2 => [
                'name' => 'Bill - 2',
                'items' => []
            ]
        ];
        $this->activeSplitTab = 1;
        $this->splitBillModalOpen = true;
    }

    /**
     * Menambah Bill Baru
     */
    public function addSplitBill(): void
    {
        $nextIndex = count($this->splitBills) > 0 ? max(array_keys($this->splitBills)) + 1 : 1;
        $this->splitBills[$nextIndex] = [
            'name' => 'Bill - ' . $nextIndex,
            'items' => []
        ];
        $this->activeSplitTab = $nextIndex;
    }

    /**
     * Menghapus Bill Tertentu
     */
    public function deleteSplitBill($billIndex): void
    {
        if (count($this->splitBills) <= 1) {
            $this->dispatch('toast', type: 'error', message: 'Minimal harus menyisakan 1 Bill.');
            return;
        }

        unset($this->splitBills[$billIndex]);
        // Pindahkan tab aktif ke bill pertama yang tersedia
        $this->activeSplitTab = array_key_first($this->splitBills);
    }

    /**
     * Memindahkan Item dari Keranjang Utama ke Sub-Bill yang sedang aktif
     */
    public function moveItemToSplit($cartIndex): void
    {
        if (!isset($this->cartItems[$cartIndex])) return;

        $item = $this->cartItems[$cartIndex];

        // Pastikan quantity di keranjang utama masih mencukupi
        if ($item['quantity'] <= 0) return;

        $variantId = $item['variant_id'];

        // Cek apakah item dengan variant ini sudah ada di Bill yang aktif saat ini
        $existingIndex = null;
        foreach ($this->splitBills[$this->activeSplitTab]['items'] as $i => $splitItem) {
            if ($splitItem['variant_id'] === $variantId) {
                $existingIndex = $i;
                break;
            }
        }

        if ($existingIndex !== null) {
            // Jika sudah ada, tambahkan quantity-nya di sub-bill
            $this->splitBills[$this->activeSplitTab]['items'][$existingIndex]['quantity'] += 1;
        } else {
            // Jika belum ada, buat baris baru di sub-bill
            $this->splitBills[$this->activeSplitTab]['items'][] = [
                'product_id'   => $item['product_id'],
                'variant_id'   => $item['variant_id'],
                'name'         => $item['name'],
                'variant_name' => $item['variant_name'],
                'price'        => $item['price'],
                'quantity'     => 1,
            ];
        }

        // Kurangi quantity di keranjang utama/induk
        $this->cartItems[$cartIndex]['quantity'] -= 1;

        // Jika quantity di keranjang utama habis (0), jangan dihapus array-nya agar baris menu di kiri UI tetap tampil untuk tracking sisa
        $this->recalculateTotals();
    }

    /**
     * Mengembalikan Item dari Sub-Bill ke Keranjang Utama
     */
    public function removeSplitItem($billIndex, $itemIndex): void
    {
        $splitItem = $this->splitBills[$billIndex]['items'][$itemIndex];
        $variantId = $splitItem['variant_id'];

        // Kembalikan quantity ke keranjang utama
        foreach ($this->cartItems as $i => $cartItem) {
            if ($cartItem['variant_id'] === $variantId) {
                $this->cartItems[$i]['quantity'] += 1;
                break;
            }
        }

        // Kurangi quantity di sub-bill
        $this->splitBills[$billIndex]['items'][$itemIndex]['quantity'] -= 1;

        // Jika quantity di sub-bill habis, hapus dari list bill tersebut
        if ($this->splitBills[$billIndex]['items'][$itemIndex]['quantity'] <= 0) {
            array_splice($this->splitBills[$billIndex]['items'], $itemIndex, 1);
        }

        $this->recalculateTotals();
    }

    /**
     * Memproses pembayaran khusus untuk sub-bill tertentu (Split Bill Eksekusi)
     */
    public function paySplitBill($billIndex): void
    {
        // 1. Validasi awal penampung data split bill [cite: 47]
        if (!isset($this->splitBills[$billIndex]) || empty($this->splitBills[$billIndex]['items'])) {
            $this->dispatch('toast', type: 'error', message: 'Tidak ada item di bill ini.');
            return;
        }

        // 2. Pastikan sedang mengedit transaksi meja aktif [cite: 48]
        if (!$this->editingTransactionId) {
            $this->dispatch('toast', type: 'error', message: 'Split bill hanya bisa dilakukan pada pesanan meja yang sudah disimpan.');
            return;
        }

        // 3. Ambil item dari sub-bill yang dipilih & tandai mode split aktif
        $this->currentSplitItems = $this->splitBills[$billIndex]['items'];
        $this->currentSplitBillIndex = $billIndex;
        $this->isSplitPaymentMode = true;

        // 4. Hitung matematika keuangan khusus untuk sub-bill ini [cite: 50]
        // Supaya angka yang muncul di halaman pilih metode pembayaran akurat sesuai item pecahan
        $subBillSubtotal = collect($this->currentSplitItems)->sum(fn($i) => $i['quantity'] * $i['price']);

        $this->subtotal = $subBillSubtotal;
        $this->serviceAmount = (int) round($this->subtotal * ($this->serviceRate / 100));
        $this->taxAmount = (int) round(($this->subtotal + $this->serviceAmount) * ($this->taxRate / 100));
        $rawGrandTotal = $this->subtotal + ($this->orderType === 'dine_in' ? $this->serviceAmount : 0) + $this->taxAmount;
        $this->total = $this->roundingBase > 0
            ? (int) (round($rawGrandTotal / $this->roundingBase) * $this->roundingBase)
            : $rawGrandTotal;

        // 4. Tutup modal split bill dan arahkan kasir ke halaman Select Payment Method utama
        $this->splitBillModalOpen = false;
        $this->viewMode = 'payment'; // Berpindah halaman inline sesuai layout blade kamu

        $this->dispatch('toast', type: 'success', message: 'Silakan pilih metode pembayaran untuk sub-bill ini.');
    }

    public function applyScanInput()
    {
        // 1. Validasi opsional (misalkan jika nama pelanggan wajib diisi atau format barcode tertentu)
        $this->validate([
            'numberOfPax' => 'required|integer|min:1',
            // 'transactionBarcode' => 'nullable|string', // aktifkan jika ada validasi khusus barcode
        ]);

        // 2. Logika pencarian atau pemrosesan pesanan berdasarkan Barcode/Nomor Transaksi (jika ada)
        if (trim($this->transactionBarcode) !== '') {
            // CONTOH LOGIKA: Jika barcode diisi, kamu bisa mencari data transaksi lama dari database
            // $oldTransaction = Transaction::where('invoice_number', $this->transactionBarcode)->first();
            // if ($oldTransaction) {
            //     // Muat item pesanan lama ke dalam cartItems kamu
            //     // $this->cartItems = $oldTransaction->itemsToArray();
            // }
        }

        // Jika nomor meja diinput secara manual, Anda bisa menyesuaikannya di sini
        if (trim($this->tableNumberInput) !== '') {
            // Sinkronisasi dengan sistem pemilihan meja bawaan jika diperlukan
            // $this->selectedTableId = $this->tableNumberInput;
        }

        // 4. Berikan feedback sukses (menggunakan dispatch browser event bawaan Livewire v3)
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Data transaksi berhasil diterapkan!'
        ]);

        // 5. Tutup modal Scan / Input secara otomatis
        $this->scanInputModalOpen = false;
    }

    public function getFilteredMembersProperty()
    {
        if (! auth()->user()?->can('members.view')) {
            return collect();
        }

        $term = trim($this->memberSearch);

        return Member::query()
            ->when($term !== '', function ($q) use ($term) {
                $q->where(function ($qq) use ($term) {
                    $qq->where('name', 'like', "%{$term}%")
                        ->orWhere('phone', 'like', "%{$term}%");
                });
            })
            ->orderBy('name')
            ->get(['id', 'name', 'phone']);
    }

    public function clearRegularMember(): void
    {
        $this->memberId = null;
        $this->memberSearch = '';
        $this->memberListPage = 1;
        $this->updatedMemberId();
    }

    public function updatedDeliveryCost(): void
    {
        $this->calculatePlatformFee();
    }

    public function updatedOrderFee(): void
    {
        $this->calculatePlatformFee();
    }

    private function calculatePlatformFee(): void
    {
        $delivery = (int) preg_replace('/\D+/', '', (string) ($this->deliveryCost ?? '0'));
        $order = (int) preg_replace('/\D+/', '', (string) ($this->orderFee ?? '0'));

        // Sesuaikan rumus platform fee dengan kebijakan bisnis kamu
        $this->platformFee = $delivery + $order;
    }

    public function openEditTableModal(): void
    {
        $this->editTableModalOpen = true;
    }

    public function applyEditTablePax(): void
    {
        $this->validate([
            'numberOfPax' => 'required|integer|min:1',
        ]);

        // Jika pesanan sudah tersimpan di DB (meja sudah occupied), update langsung pax di transaksinya
        if ($this->editingTransactionId !== null) {
            DB::table('transactions')
                ->where('id', $this->editingTransactionId)
                ->update(['pax' => $this->numberOfPax]);

            $this->dispatch('toast', type: 'success', message: 'Jumlah pax berhasil diperbarui.');
        }

        $this->editTableModalOpen = false;
    }

    public function applyEsbOrderScan(): void
    {
        $orderId = trim($this->esbOrderIdInput);

        if ($orderId === '') {
            $this->addError('esbOrderIdInput', 'Order ID wajib diisi.');
            return;
        }

        // Cari transaksi ESB Order yang sudah PAID berdasarkan kode/external_id
        $trx = Transaction::query()
            ->where(function ($q) use ($orderId) {
                $q->where('code', $orderId)
                    ->orWhere('external_id', $orderId);
            })
            ->where('payment_status', 'paid')
            ->first();

        if (! $trx) {
            $this->addError('esbOrderIdInput', 'Order ID tidak ditemukan atau belum dibayar.');
            return;
        }

        // Muat transaksi ke kasir (sesuaikan dengan logic loadPending kalau diperlukan)
        $this->editingTransactionId = (int) $trx->id;
        $this->orderType = (string) $trx->order_type;
        $this->customerName = (string) $trx->name;
        $this->customerPhone = $trx->phone;

        $this->dispatch('toast', type: 'success', message: 'Order ESB berhasil dimuat.');

        $this->esbOrderIdInput = '';
        $this->scanInputModalOpen = false;
    }

    public function updatedComplimentPercentage(): void
    {
        $pct = (float) ($this->complimentPercentage ?? 0);
        if ($pct > 0) {
            $this->complimentAmount = (string) (int) round($this->total * ($pct / 100));
        }
    }

    public function updatedComplimentAmount(): void
    {
        $amount = (int) preg_replace('/\D+/', '', (string) ($this->complimentAmount ?? '0'));
        if ($this->total > 0 && $amount > 0) {
            $this->complimentPercentage = (string) round(($amount / $this->total) * 100, 2);
        }
    }

    public function getOutstandingAfterComplimentProperty(): int
    {
        $amount = (int) preg_replace('/\D+/', '', (string) ($this->complimentAmount ?? '0'));
        return max(0, $this->total - $amount);
    }

    public function applyCompliment(): void
    {
        $this->validate([
            'complimentNotes' => 'required|string|min:3',
        ], [
            'complimentNotes.required' => 'Compliment Notes wajib diisi.',
            'complimentNotes.min' => 'Notes minimal 3 karakter.',
        ]);

        $amount = (int) preg_replace('/\D+/', '', (string) ($this->complimentAmount ?? '0'));

        if ($amount <= 0) {
            $this->addError('complimentAmount', 'Nominal compliment harus diisi.');
            return;
        }

        // Set paymentMethod jadi compliment, simpan info compliment ke property
        $this->paymentMethod = 'compliment';
        $this->manualDiscountType = 'fixed_amount';
        $this->manualDiscountValue = $amount;
        $this->manualDiscountNote = 'Compliment: ' . $this->complimentNotes;

        $this->recalculateTotals();

        $this->complimentModalOpen = false;

        $this->dispatch('toast', type: 'success', message: 'Compliment berhasil diterapkan.');
    }

    public function openCardPaymentModal(): void
    {
        $this->resetValidation();
        $this->cardAmount = (string) $this->total;
        $this->cardNumber = null;
        $this->cardVerificationCode = null;
        $this->cardBankName = null;
        $this->cardAccountName = null;
        $this->cardSelfOrderId = null;
        $this->cardDetailModalOpen = true;
    }

    public function setCardOutstandingAmount(): void
    {
        $this->cardAmount = (string) $this->total;
    }

    public function applyCardPayment(): void
    {
        $this->validate([
            'cardBankName' => 'required|string|min:2',
            'cardAccountName' => 'required|string|min:2',
        ], [
            'cardBankName.required' => 'Bank name wajib diisi.',
            'cardAccountName.required' => 'Account name wajib diisi.',
        ]);

        $amount = (int) preg_replace('/\D+/', '', (string) ($this->cardAmount ?? '0'));

        if ($amount <= 0) {

            $this->addError('cardAmount', 'Nominal kartu harus lebih dari 0.');
            return;
        }

        // Set payment method jadi card + simpan nominal yang dibayar via cashReceived
        $this->paymentMethod = 'card';
        $this->cashReceived = (string) $amount;

        $this->recalculateTotals();

        $this->cardDetailModalOpen = false;

        $this->dispatch('toast', type: 'success', message: 'Pembayaran Card berhasil diterapkan.');
    }

    public function openOtherCostModal(): void
    {
        $this->resetValidation();
        $this->otherCostNotes = '';
        $this->otherCostModalOpen = true;
    }

    public function applyOtherCost(): void
    {
        $this->validate([
            'otherCostNotes' => 'required|string|min:3|max:100',
        ], [
            'otherCostNotes.required' => 'Notes wajib diisi.',
            'otherCostNotes.min' => 'Notes minimal 3 karakter.',
            'otherCostNotes.max' => 'Notes maksimal 100 karakter.',
        ]);

        $this->paymentMethod = 'other_cost';
        $this->cashReceived = (string) $this->total;
        $this->manualDiscountNote = 'Other Cost: ' . $this->otherCostNotes;

        $this->recalculateTotals();

        $this->otherCostModalOpen = false;

        $this->dispatch('toast', type: 'success', message: 'Other Cost berhasil diterapkan.');
    }

    public function render(): View
    {
        $this->authorize('pos.access');

        return view('livewire.pos.pos-page')->layout('layouts.app', ['title' => $this->title]);
    }
}
