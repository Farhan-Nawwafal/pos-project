<?php

namespace App\Providers;

use App\Helpers\MenuHelper;
use App\Models\DiningTable;
use App\Models\Transaction;
use App\Observers\DiningTableObserver;
use App\Observers\TransactionObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (! function_exists('generate_qr_code') && file_exists(app_path('helpers.php'))) {
            require_once app_path('helpers.php');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Register Observers
        Transaction::observe(TransactionObserver::class);
        DiningTable::observe(DiningTableObserver::class);

        // 2. Global View Composer (Tersedia di semua view)
        View::composer('*', function ($view) {
            $printerSourcesForJs = [];

            if (Schema::hasTable('printer_sources')) {
                $user = auth()->user();
                $cabangId = $user?->cabang_id;

                $printerSourcesForJs = \App\Models\PrinterSource::query()
                    ->when($cabangId, fn($q) => $q->where('cabang_id', $cabangId))
                    ->orderBy('name')
                    ->get(['id', 'name', 'type'])
                    ->map(fn($s) => [
                        'id' => (int) $s->id,
                        'name' => (string) $s->name,
                        'type' => (string) $s->type,
                        'role' => "source-{$s->id}"
                    ])
                    ->values()
                    ->toArray();
            }

            $settings = DB::table('settings')->first();

            $view->with('appSettings', [
                'rounding_base' => (int) ($settings->rounding_base ?? 0),
            ]);

            $view->with('printerSourcesForJs', $printerSourcesForJs);
        });

        // 3. Sidebar View Composer
        View::composer('layouts.sidebar', function ($view): void {
            $user = auth()->user();
            $view->with([
                'menuGroups' => MenuHelper::getMenuGroups(),
                'currentPath' => request()->path(),
                'canAccessPos' => $user?->can('pos.access') ?? false,
            ]);
        });
    }
}