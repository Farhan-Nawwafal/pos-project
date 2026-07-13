<?php

namespace App\Providers;

use App\Helpers\MenuHelper;
use App\Models\DiningTable;
use App\Models\PrinterSource;
use App\Models\Transaction;
use App\Observers\DiningTableObserver;
use App\Observers\TransactionObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event; // Tambahkan ini
use Illuminate\Auth\Events\Login;     // Tambahkan ini
use App\Listeners\CreateShiftOnLogin; // Tambahkan ini

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (!function_exists('generate_qr_code') && file_exists(app_path('helpers.php'))) {
            require_once app_path('helpers.php');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Transaction::observe(TransactionObserver::class);
        DiningTable::observe(DiningTableObserver::class);

        // Gunakan View Composer agar auth()->user() sudah tersedia
        View::composer('*', function ($view) {
            $printerSourcesForJs = [];

            if (Schema::hasTable('printer_sources')) {
                $user = auth()->user();
                $cabangId = $user?->cabang_id;

                // Sekarang $cabangId pasti ada isinya jika user login
                $printerSourcesForJs = \App\Models\PrinterSource::query()
                    ->when($cabangId, fn($q) => $q->where('cabang_id', $cabangId))
                    ->orderBy('name')
                    ->get(['id', 'name', 'type'])
                    ->map(fn($s) => [
                        'id' => (int) $s->id,
                        'name' => (string) $s->name,
                        'type' => (string) $s->type,
                        'role' => "source-{$s->id}" // Tambahkan role biar PrinterManager gak bingung
                    ])
                    ->values()
                    ->toArray();
            }

            $settings = \Illuminate\Support\Facades\DB::table('settings')->first();

            $view->with('appSettings', [
                'rounding_base' => (int) ($settings->rounding_base ?? 0),
            ]);

            $view->with('printerSourcesForJs', $printerSourcesForJs);
        });

        View::composer('layouts.sidebar', function (\Illuminate\View\View $view): void {
            $user = auth()->user();
            $view->with([
                'menuGroups' => \App\Helpers\MenuHelper::getMenuGroups(),
                'currentPath' => request()->path(),
                'canAccessPos' => $user?->can('pos.access') ?? false,
            ]);
        });
        
        Event::listen(
            Login::class,
            CreateShiftOnLogin::class,
        );
    }
}
