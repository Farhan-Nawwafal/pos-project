# POS Grid Fix (15 Items Fixed + Horizontal Slider)

**Status**: ⏳ Planning

## Problems Identified
```
CURRENT: 
- Grid: 2-5 cols responsive = scrolls down >15 items
- Container: no height limit = page scrolls

REQUIRED:
- Fixed 15 items visible
- Horizontal slider w/ numbering + L/R arrows next to "Dine In"
- POS main content: `overflow-hidden` no scroll
```

## Plan
### 1. Fix Container (POS Section)
```
lg:col-span-8 → fixed `max-h-[calc(100vh-200px)] overflow-hidden`
```

### 2. Slider Structure
```
- Wrapper: `flex overflow-x-auto snap-x snap-mandatory scrollbar-hide gap-3 pb-4`
- Container: `grid grid-cols-[repeat(auto-fit,minmax(0,156px))] min-w-max grid-flow-col`
- Arrows + Pagination: Above grid, next to Dine In button
```

### 3. Alpine.js Slider Logic
```
data: {
  currentSlide: 0,
  slidesPerView: 5, // ~15 items / 3 rows
  totalSlides: Math.ceil(productCards.length / 15),
  nextSlide() { ... },
  prevSlide() { ... }
}
```

### 4. CSS Tweaks
```
- Card: `min-w-[140px] h-[120px]` (smaller)
- No scroll: `overscroll-contain` + snap
```

## Files to Edit
1. `resources/views/livewire/pos/pos-page.blade.php` (main)
2. Add slider Alpine to `<head>` or inline
3. Optional: `app/Livewire/Pos/PosPage.php` chunk products

**Ready to implement? Approve plan!**

