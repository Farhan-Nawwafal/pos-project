# Fix Livewire DOM Morphing Error (Table Click)

## Root Cause
Error: `Cannot read properties of null (reading 'before')` at `Block.appendChild` — This occurs during Livewire v3 DOM morphing when `wire:key` values change dynamically, causing the morph algorithm to lose track of elements.

## Fixes Needed

### 1. Fix `wire:key` on Table Buttons
**File:** `resources/views/livewire/pos/pos-page.blade.php`
- **Line:** ~55 (the table grid loop)
- **Change:** `wire:key="table-item-{{ $t['id'] }}-{{ $status }}"` → `wire:key="table-item-{{ $t['id'] }}"`
- **Reason:** The dynamic `$status` suffix causes the key to change on re-render, triggering the morph error

### 2. Fix `wire:key` on Cart Items
**File:** `resources/views/livewire/pos/pos-page.blade.php`
- **Line:** ~127 (cart items loop in view-mode-menu)
- **Change:** `wire:key="cart-item-{{ $idx }}"` → `wire:key="cart-item-{{ $item['variant_id'] ?? $idx }}"`
- **Reason:** Index-based keys shift when items are removed, confusing the morph algorithm

### 3. Fix `wire:key` on Split Bill Items
**File:** `resources/views/livewire/pos/pos-page.blade.php`
- **Line:** ~2750 (split bill items loop)
- **Change:** Add stable `wire:key` based on variant_id + bill index

### 4. Fix `x-data` Conditional on Table Buttons
**File:** `resources/views/livewire/pos/pos-page.blade.php`
- **Line:** ~55 
- **Change:** Move `x-data` to a wrapper element or use `x-init` to prevent Alpine from conflicting with Livewire's morphing

