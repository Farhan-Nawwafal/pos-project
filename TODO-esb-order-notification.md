# TODO - ESB Order Notification tampil transaksi terakhir

## Step 1: Pastikan Livewire component terpasang
- Cek `resources/views/layouts/app.blade.php`: saat ini pakai `@include('livewire.transactions.esb-order-modal')`.
- Pastikan itu benar memuat Livewire component `App\Livewire\Transaction\EsbOrderModal` (bisa jadi harus diganti ke `@livewire(....)` bila perlu).

## Step 2: Ambil data transaksi terakhir
- Edit `app/Livewire/Transactions/EsbOrderModal.php`:
  - Tambahkan properti `protected int $latestLimit = 10;` (opsional).
  - Implementasi `mount()` atau `hydrate()` untuk isi `$transactions`.
  - Query transaksi terakhir ESB: kemungkinan pakai `channel` dan/atau `payment_status`.
  - Mapping field untuk blade: `code`, `customer`, `total`, `payment_status`.

## Step 3: Refresh saat klik tombol
- Edit `resources/views/layouts/app-header.blade.php` atau implementasi event:
  - saat klik tombol ESB, trigger reload Livewire (mis. event Livewire `dispatch` / method call).
  - atau minimal panggil `loadLatest()` saat modal open.

## Step 4: Sesuaikan mapping status
- Pastikan nilai `payment_status` yang dikirim sesuai match logic di blade modal:
  - `paid`, `pending`, dan default.

## Step 5: Testing
- Klik “ESB Order Notification” → modal terisi transaksi terbaru.
- Cek tidak error saat data kosong.

