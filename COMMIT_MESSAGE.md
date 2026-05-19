🌿 PANDUAN KOLABORASI & MANAJEMEN GIT
====================================

Biar kodenya rapi, nggak saling timpa, dan riwayat revisinya konsisten, kita wajib pakai aturan main di bawah ini.


🌿 1. Aturan Penamaan Branch
----------------------------
Format Standar: [tipe]/[deskripsi-singkat]

Tipe Pengerjaan:
- **feat**: Menambah fitur baru (misal: bikin komponen Livewire baru, integrasi Midtrans).
- **fix**: Memperbaiki bug, error, atau validasi yang bocor.
- **chore**: Tugas setup environment, update package Composer/NPM, atau perapian struktur kode.
- **docs**: Update dokumentasi, komentar kode, atau file README.md.
- **lib**: Khusus untuk pengembangan, update, atau perbaikan pada internal library (seperti *Activity Log library*).

Contoh Penamaan:
- `feat/midtrans-payment`
- `feat/livewire-activity-log-ui`
- `fix/cabang-migration-order`
- `lib/fix/activity-log-cleanup`
- `chore/update-laravel-12`


🔄 2. Alur GitFlow (Keluar-Masuk Kode)
--------------------------------------
Biar kode di server produksi tetap aman dan riwayat commit nggak berantakan, ini alur integrasi kita:

1) main / master:
   Ini branch SUCI. Cuma berisi kode yang 100% stabil, bebas error, dan siap dideploy ke produksi. JANGAN PERNAH push langsung ke branch ini!

2) dev:
   Ini branch integrasi utama kita. Semua hasil kerja fitur, perbaikan bug, dan library bakal kumpul dan dites di sini terlebih dahulu.

Alur Kerja Harian:
- **Langkah 1**: Selalu tarik kode terbaru dari `dev` sebelum mulai bekerja (`git checkout dev` -> `git pull origin dev`).
- **Langkah 2**: Bikin branch baru dari `dev` sesuai format di atas (misal: `git checkout -b feat/activity-log`).
- **Langkah 3**: Mulai ngoding dan lakukan commit secara berkala dengan pesan yang jelas.
- **Langkah 4**: Jika fitur sudah selesai dan dites lokal berjalan lancar, push branch tersebut ke repositori (`git push origin feat/activity-log`).
- **Langkah 5**: Buka Pull Request (PR) di GitHub/GitLab untuk digabungkan balik ke branch `dev`. Lakukan *code review* bareng partner sebelum di-merge.

Tipe Pengerjaan:
- **feat**: Menambah fitur atau fungsionalitas baru yang sebelumnya belum ada di aplikasi.
  * *Digunakan untuk*: Membuat halaman baru, komponen Livewire baru, integrasi API pihak ketiga (Midtrans, Pusher), atau menambahkan skema tabel baru di database.
  * *Contoh*: `feat/livewire-pos-cashier`, `feat/midtrans-callback`

- **fix**: Memperbaiki bug, error, celah keamanan, atau malfungsi pada kode yang sudah ada.
  * *Digunakan untuk*: Memperbaiki query SQL yang lambat, membetulkan urutan migrasi tabel (seperti case tabel cabangs kemarin), mengatasi *state* Livewire yang tidak me-refresh, atau memperbaiki validasi form yang jebol.
  * *Contoh*: `fix/cabang-migration-order`, `fix/auth-session-timeout`

- **chore**: Tugas-tugas administratif, pemeliharaan repositori, pembersihan kode, atau konfigurasi perkakas (*tools*). Tugas ini sama sekali tidak mengubah kode fitur aplikasi ke pengguna akhir.
  * *Digunakan untuk*: Mengatur file `.env.example`, memperbarui file `.gitignore`, merapikan indentasi kode (*formatting*), atau memperbarui dependensi via Composer dan NPM.
  * *Contoh*: `chore/update-tailwind-config`, `chore/cleanup-unused-views`

- **lib**: Pengembangan, perbaikan, atau penyesuaian khusus pada *internal library* atau package buatan sendiri yang diintegrasikan ke dalam proyek.
  * *Digunakan untuk*: Memperbarui fungsionalitas utama pada *Activity Log library*, memperbaiki mekanisme *auto-cleanup* log, atau mengoptimalkan helper bawaan library tersebut.
  * *Contoh*: `lib/activity-log-helper`, `lib/fix-log-retention`

- **docs**: Segala bentuk pemutakhiran, penambahan, atau perbaikan dokumentasi proyek tanpa mengubah baris kode aplikasi tunggal pun.
  * *Digunakan untuk*: Memperbarui file `README.md`, menulis panduan API, menambahkan komentar dokumentasi (*docblocks* seperti `/** ... */`) pada *Controller* atau *Model*, atau mencatat changelog rilis.
  * *Contoh*: `docs/update-gitflow-guide`, `docs/api-payment-spec`
