@extends('layouts.index')

@section('title', 'Dashboard')

@section('content')
  @session('welcome')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <span>{{ $value }}</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endsession
@endsection

@section('scripts')
<script type="text/javascript">
</script>
@endsection
