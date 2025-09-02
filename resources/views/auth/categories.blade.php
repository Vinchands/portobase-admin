@extends('layouts.index')

@section('title', 'Categories')

@section('head')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
  <div class="card">
    <div class="card-header pb-1">
      <h4>New Category</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Name (e.g. Web App)" required>
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Add</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="card">
    <div class="card-body table-responsive">
      <table id="category-table" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Created at</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @if ($categories->count() > 0)
            @foreach ($categories as $category)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->created_at }}</td>
                <td>
                  <button class="btn btn-sm btn-warning" data-id="{{ $category->id }}">
                    <i class="fas fa-pencil-alt"></i>
                  </button>
                  <button class="btn btn-sm btn-danger" onclick="showDeleteModal('{{ $category->id }}', '{{ $category->name }}')">
                    <i class="fas fa-trash"></i>
                  </button>
                  <form id="category-{{ $category->id }}" action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post" class="d-none">
                    @csrf
                    @method('DELETE')
                  </form>
                </td>
              </tr>
            @endforeach
          @else 
            <tr class="text-center">
              <td colspan="4">No item.</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script type="text/javascript">
    
    @session('success')
      Swal.fire({
        title: 'Success',
        text: '{{ $value }}',
        icon: 'success'
      })
    @endsession
    
    function showDeleteModal(id, name) {
      const deleteForm = document.getElementById(`category-${id}`)
      Swal.fire({
        title: 'Warning',
        text: `Are you sure want to delete '${name}'? This action cannot be undone.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Yes',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          deleteForm.submit()
        }
      })
    }
    
    $(() => {
      $('#category-table').DataTable({
        columns: [{ width: '10%' }, null, null, { width: '10%' }],
      })
    })
  </script>
@endsection
