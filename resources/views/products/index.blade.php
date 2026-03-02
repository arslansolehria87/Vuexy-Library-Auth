@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Product List</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="ti tabler-plus me-1"></i> Create Product
                </button>
            </div>
            
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>IMAGE</th>
                            <th>PRODUCT</th>
                            <th>CATEGORY</th>
                            <th>SKU</th>
                            <th>PRICE</th>
                            <th>STOCK</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('uploads/products/'.$product->image) }}" alt="Product" class="rounded" width="50" height="50" style="object-fit: cover;">
                                @else
                                    <div class="avatar avatar-md"><span class="avatar-initial rounded bg-label-secondary">No Pic</span></div>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $product->name }}</td>
                            <td>
                                <span class="d-block text-primary">{{ optional($product->category)->name }}</span>
                                <small class="text-muted">{{ optional($product->subcategory)->name }}</small>
                            </td>
                            <td><span class="badge bg-label-info">{{ $product->sku }}</span></td>
                            <td>Rs. {{ number_format($product->price, 2) }}</td>
                            <td>
                                @if($product->quantity > 10)
                                    <span class="badge bg-label-success">{{ $product->quantity }} in stock</span>
                                @elseif($product->quantity > 0)
                                    <span class="badge bg-label-warning">{{ $product->quantity }} Low Stock</span>
                                @else
                                    <span class="badge bg-label-danger">Out of Stock</span>
                                @endif
                            </td>
                            <td>
                                @if($product->status == 1)
                                    <span class="badge bg-label-success">Active</span>
                                @else
                                    <span class="badge bg-label-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti tabler-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">
                                            <i class="ti tabler-pencil me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item text-danger delete-btn" href="javascript:void(0);" data-id="{{ $product->id }}">
                                            <i class="ti tabler-trash me-1"></i> Delete
                                        </a>
                                        <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Category</label>
                                                    <select name="category_id" class="form-select edit_category_select" data-id="{{ $product->id }}" required>
                                                        @foreach($categories as $cat)
                                                            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Sub Category</label>
                                                    <select name="sub_category_id" id="edit_sub_category_{{ $product->id }}" class="form-select" required>
                                                        @foreach($subcategories->where('category_id', $product->category_id) as $subcat)
                                                            <option value="{{ $subcat->id }}" {{ $product->sub_category_id == $subcat->id ? 'selected' : '' }}>{{ $subcat->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">Product Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Price</label>
                                                    <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Cost</label>
                                                    <input type="number" step="0.01" name="cost" class="form-control" value="{{ $product->cost }}">
                                                </div>
                                            </div>
                                            <div class="row border p-3 mb-3 bg-light rounded">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Current Stock</label>
                                                    <input type="text" class="form-control" value="{{ $product->quantity }}" readonly>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Stock Action</label>
                                                    <select name="stock_action" class="form-select">
                                                        <option value="">No Change</option>
                                                        <option value="add">Add (+)</option>
                                                        <option value="remove">Remove (-)</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Adjust Quantity</label>
                                                    <input type="number" name="adjust_quantity" class="form-control" value="0" min="0">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="form-label">Product Image</label>
                                                    <input class="form-control" type="file" name="image" accept="image/*">
                                                </div>
                                                <div class="col-md-4 mb-3 mt-4">
                                                    <div class="form-check form-switch mt-2">
                                                        <input class="form-check-input" type="checkbox" name="status" value="1" {{ $product->status == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label">Active</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No Products Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Select Category</label>
                            <select name="category_id" id="add_category_id" class="form-select" required>
                                <option value="">Choose Main Category...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Select Sub Category</label>
                            <select name="sub_category_id" id="add_sub_category_id" class="form-select" required>
                                <option value="">Select Category First</option>
                                </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" step="0.01" name="price" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Cost</label>
                            <input type="number" step="0.01" name="cost" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Product Image</label>
                            <input class="form-control" type="file" name="image" accept="image/*">
                        </div>
                        <div class="col-md-4 mb-3 mt-4">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="status" value="1" checked>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Javascript to load Sub Categories dynamically
        const allSubCategories = @json($subcategories);

        // Add Modal Dropdown Logic
        const addCategorySelect = document.getElementById('add_category_id');
        const addSubCategorySelect = document.getElementById('add_sub_category_id');

        if(addCategorySelect){
            addCategorySelect.addEventListener('change', function() {
                let categoryId = this.value;
                addSubCategorySelect.innerHTML = '<option value="">Select Sub Category...</option>';
                
                allSubCategories.forEach(function(sub) {
                    if (sub.category_id == categoryId) {
                        let option = document.createElement('option');
                        option.value = sub.id;
                        option.text = sub.name;
                        addSubCategorySelect.appendChild(option);
                    }
                });
            });
        }

        // Edit Modal Dropdown Logic
        const editCategorySelects = document.querySelectorAll('.edit_category_select');
        editCategorySelects.forEach(select => {
            select.addEventListener('change', function() {
                let categoryId = this.value;
                let productId = this.getAttribute('data-id');
                let subSelect = document.getElementById('edit_sub_category_' + productId);
                
                subSelect.innerHTML = '<option value="">Select Sub Category...</option>';
                allSubCategories.forEach(function(sub) {
                    if (sub.category_id == categoryId) {
                        let option = document.createElement('option');
                        option.value = sub.id;
                        option.text = sub.name;
                        subSelect.appendChild(option);
                    }
                });
            });
        });

        // Delete Alerts
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#7367f0',
                    cancelButtonColor: '#ea5455',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                })
            });
        });

        // Delete Success Alert
        @if(session('delete_success'))
            Swal.fire({
                title: 'Deleted!',
                text: "{{ session('delete_success') }}",
                icon: 'success',
                confirmButtonColor: '#7367f0'
            });
        @endif

        // Success Alert for Add/Edit
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#7367f0',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endsections