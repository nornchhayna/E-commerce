<form action="{{ route('admin.inventory.update', $inventory->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Product</label>
    <select name="product_id" required>
        @foreach ($products as $product)
            <option value="{{ $product->id }}" {{ $product->id == $inventory->product_id ? 'selected' : '' }}>
                {{ $product->name }}
            </option>
        @endforeach
    </select>

    <label>Type</label>
    <select name="type" required>
        @foreach(['adjustment', 'sale', 'purchase', 'return'] as $type)
            <option value="{{ $type }}" {{ $type == $inventory->type ? 'selected' : '' }}>
                {{ ucfirst($type) }}
            </option>
        @endforeach
    </select>

    <label>Quantity Change</label>
    <input type="number" name="quantity_change" value="{{ $inventory->quantity_change }}" required>

    <label>Quantity Before</label>
    <input type="number" name="quantity_before" value="{{ $inventory->quantity_before }}" required>

    <label>Quantity After</label>
    <input type="number" name="quantity_after" value="{{ $inventory->quantity_after }}" required>

    <label>Reason</label>
    <input type="text" name="reason" value="{{ $inventory->reason }}">

    <label>Notes</label>
    <textarea name="notes">{{ $inventory->notes }}</textarea>

    <button type="submit">Update Inventory</button>
</form>