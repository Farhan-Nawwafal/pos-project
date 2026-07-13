<?php

namespace App\Livewire\Promotions;

use App\Models\Promotion;
use App\Models\Cabang;
use Livewire\Component;

class PromotionFormPage extends Component
{
    public ?Promotion $promotion = null; // Menyimpan instance jika mode edit
    public bool $isEdit = false;

    // Form Properties sesuai struktur table promotions
    public $cabang_id = null;
    public $name = '';
    public $type = 'public';
    public $discount_type = 'percentage';
    public $discount_value = 0;
    public $max_discount = null;
    public $min_subtotal = 0;
    public $payment_method = null;
    public $start_date = null;
    public $end_date = null;
    public $is_active = true;

    // Untuk dropdown lists
    public $cabangs = [];

    protected function rules()
    {
        return [
            'cabang_id' => 'nullable|exists:cabangs,id',
            'name' => 'required|string|max:255',
            'type' => 'required|in:public,member',
            'discount_type' => 'required|in:percentage,flat',
            'discount_value' => 'required|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'min_subtotal' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'required|boolean',
        ];
    }

    public function mount(Promotion $promotion = null)
    {
        abort_if(!auth()->user()->can('promotions.manage'), 403);

        $this->cabangs = Cabang::all();

        if ($promotion && $promotion->exists) {
            $this->promotion = $promotion;
            $this->isEdit = true;

            // Isi field input dengan data lama dari database
            $this->cabang_id = $promotion->cabang_id;
            $this->name = $promotion->name;
            $this->type = $promotion->type;
            $this->discount_type = $promotion->discount_type;
            $this->discount_value = $promotion->discount_value;
            $this->max_discount = $promotion->max_discount;
            $this->min_subtotal = $promotion->min_subtotal;
            $this->payment_method = $promotion->payment_method;
            $this->start_date = $promotion->start_date ? $promotion->start_date->format('Y-m-d\TH:i') : null;
            $this->end_date = $promotion->end_date ? $promotion->end_date->format('Y-m-d\TH:i') : null;
            $this->is_active = $promotion->is_active;
        }
    }

    public function save()
    {
        $validatedData = $this->validate();

        // Bersihkan data jika tipe diskon flat (tidak perlu max_discount)
        if ($this->discount_type === 'flat') {
            $validatedData['max_discount'] = null;
        }

        if ($this->isEdit) {
            $this->promotion->update($validatedData);
            session()->flash('success', 'Promosi berhasil diperbarui.');
        } else {
            Promotion::create($validatedData);
            session()->flash('success', 'Promosi baru berhasil dibuat.');
        }

        return $this->redirect(route('promotions.index'), navigate: true);
    }

    public function render()
    {
        return view('components.promotions.promotions-form-page')
            ->layout('layouts.app');
    }
}
