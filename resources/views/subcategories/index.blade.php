@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Sub Category List</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubCategoryModal">
                    <i class="ti tabler-plus me-1"></i> Create Sub Category
                </button>
            </div>
            
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>MAIN CATEGORY</th>
                            <th>SUB CATEGORY</th>
                            <th>SLUG</th>
                            <th>STATUS</th>
                            <th>CREATED AT</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($subcategories as $key => $subcategory)
                        <tr>
                            <td>{{ $subcategories->firstItem() + $key }}</td>
                            <td><span class="badge bg-label-primary">{{ optional($subcategory->category)->name ?? 'N/A' }}</span></td>
                            <td class="fw-bold">{{ $subcategory->name }}</td>
                            <td>{{ $subcategory->slug }}</td>
                            <td>
                                @if($subcategory->status == 1)
                                    <span class="badge bg-label-success">Active</span>
                                @else
                                    <span class="badge bg-label-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $subcategory->created_at->format('M, d, Y') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti tabler-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editSubCategoryModal{{ $subcategory->id }}">
                                            <i class="ti tabler-pencil me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item text-danger delete-btn" href="javascript:void(0);" data-id="{{ $subcategory->id }}">
                                            <i class="ti tabler-trash me-1"></i> Delete
                                        </a>
                                        <form id="delete-form-{{ $subcategory->id }}" action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="editSubCategoryModal{{ $subcategory->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Sub Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label class="form-label">Main Category</label>
                                                    <select name="category_id" class="form-select" required>
                                                        <option value="">Select Category</option>
                                                        @foreach($categories as $cat)
                                                            <option value="{{ $cat->id }}" {{ $subcategory->category_id == $cat->id ? 'selected' : '' }}>
                                                                {{ $cat->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label class="form-label">Sub Category Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $subcategory->name }}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="status" value="1" {{ $subcategory->status == 1 ? 'checked' : '' }}>
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
                            <td colspan="7" class="text-center">No Sub Categories Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <div class="m-0 text-muted">
                    Showing {{ $subcategories->firstItem() ?? 0 }} to {{ $subcategories->lastItem() ?? 0 }} of {{ $subcategories->total() }} entries
                </div>
                <div>
                    {{ $subcategories->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addSubCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Sub Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('subcategories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Select Main Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select a Category...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Sub Category Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Fiction, Laptops, Men's Wear" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" value="1" checked>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Delete Alert
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
@endsection