<div>
    {{-- 1. FILTER: Full Width, Paling Atas --}}
    <div>
        <x-ecommerce.filter :timeFilter="$timeFilter" :orderTimeRange="$orderTimeRange" />
    </div>

    {{-- 2. GRID UTAMA: Di bawah filter --}}
    <div class="grid grid-cols-12 gap-4 overflow-x-hidden md:gap-6">

        <div class="col-span-12 min-w-0 space-y-6 xl:col-span-7">
            <x-ecommerce.ecommerce-metrics :transactions="$transactionsCount" :transactions-delta-percent="$transactionsDeltaPercent" :transactions-delta-up="$transactionsDeltaUp" :revenue-amount="$todayRevenueAmount"
                :grossAmount="$todayGrossAmount" />
            <x-ecommerce.statistics-chart :series="$statisticsSeries" :categories="$statisticsCategories" :from="$statisticsFrom" :to="$statisticsTo" />
            <x-ecommerce.latest-transactions :transactions="$latestTransactions" />
        </div>

        <div class="col-span-12 min-w-0 space-y-6 xl:col-span-5">
            {{-- Audit Potensi Fraud sekarang otomatis berada di bawah Filter --}}
            <x-ecommerce.metric-summary :deletedAmount="$totalDeletedAmount" :voidItemAmount="$totalVoidItemAmount" :voidAmount="$totalVoidAmount" />
            <x-ecommerce.monthly-target :progress-percent="$monthlyTargetProgressPercent" :delta-percent="$monthlyTargetDeltaPercent" :delta-up="$monthlyTargetDeltaUp" :target-amount="$monthlyTargetAmount"
                :revenue-amount="$monthlyRevenueAmount" :today-amount="$todayRevenueAmount" />
            <x-ecommerce.best-selling-products :products="$bestSellingProducts" />
        </div>
    </div>
</div>
