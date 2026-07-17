<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use App\Models\TransactionEvent;
use App\Models\TransactionItem;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CancelTableDetailPage extends Component
{
    public Transaction $transaction;

    public string $title = 'Detail Cancel Table';

    public function mount(Transaction $transaction): void
    {
        $this->authorize('transactions.view');

        abort_unless(
            $transaction->payment_status === 'void' &&
                $transaction->voided_at !== null &&
                $transaction->void_reason !== null,
            404
        );

        $this->transaction = $transaction->load([
            'diningTable:id,table_number',
            'cashier:id,name',
            'transactionItems.product:id,name',
            'transactionItems.variant:id,name',
        ]);
    }

    protected function getCancelEvent(): ?TransactionEvent
    {
        return TransactionEvent::query()
            ->where('transaction_id', $this->transaction->id)
            ->where('action', 'cancel_table')
            ->with('actor:id,name')
            ->first();
    }

    protected function getItems(): array
    {
        return $this->transaction->transactionItems
            ->whereNull('parent_transaction_item_id')
            ->map(fn(TransactionItem $item) => [
                'name'     => $item->product?->name ?? 'Produk',
                'variant'  => $item->variant?->name ?? null,
                'qty'      => (int) $item->quantity,
                'price'    => (int) $item->price,
                'subtotal' => (int) ($item->quantity * $item->price),
            ])
            ->values()
            ->all();
    }

    public function render(): View
    {
        $event      = $this->getCancelEvent();
        $eventMeta  = $event ? (array) $event->meta : [];

        $cashierName = $event?->actor?->name
            ?? $this->transaction->cashier?->name
            ?? '-';

        $approvedBy = $eventMeta['approved_by_name'] ?? '-';

        return view('livewire.transactions.cancel-table-detail-page', [
            'transaction' => $this->transaction,
            'cashierName' => $cashierName,
            'approvedBy'  => $approvedBy,
            'items'       => $this->getItems(),
        ])->layout('layouts.app', ['title' => $this->title]);
    }
}
