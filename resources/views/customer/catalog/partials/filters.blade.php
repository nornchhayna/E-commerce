<!-- resources/views/customer/catalog/partials/_filters.blade.php -->
<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0">Filters</h5>
    </div>
    <div class="card-body">
        <form method="GET" id="catalog-filters">
            <!-- Price Range -->
            <div class="mb-4">
                <h6 class="mb-3">Price Range</h6>
                <div class="row g-2">
                    <div class="col">
                        <input type="number" name="min_price" class="form-control form-control-sm" 
                               placeholder="Min" value="{{ request('min_price') }}">
                    </div>
                    <div class="col">
                        <input type="number" name="max_price" class="form-control form-control-sm" 
                               placeholder="Max" value="{{ request('max_price') }}">
                    </div>
                </div>
            </div>
            
            <!-- Categories -->
            @if($categories->isNotEmpty())
            <div class="mb-4">
                <h6 class="mb-3">Categories</h6>
                <div class="nav flex-column">
                    @foreach($categories as $category)
                    <label class="d-flex align-items-center mb-2">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                               class="me-2" {{ in_array($category->id, (array)request('categories', [])) ? 'checked' : '' }}>
                        {{ $category->name }}
                        <span class="text-muted ms-auto">({{ $category->products_count }})</span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endif
            
            <!-- Availability -->
            <div class="mb-4">
                <h6 class="mb-3">Availability</h6>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="in_stock" id="filter-in-stock"
                           value="1" {{ request('in_stock') ? 'checked' : '' }}>
                    <label class="form-check-label" for="filter-in-stock">
                        In Stock Only
                    </label>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary btn-sm w-100">Apply Filters</button>
            @if(request()->hasAny(['min_price', 'max_price', 'categories', 'in_stock']))
                <a href="{{ url()->current() }}" class="btn btn-link btn-sm w-100 mt-2">Clear All</a>
            @endif
        </form>
    </div>
</div>