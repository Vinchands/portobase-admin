@extends('layouts.index')

@php

use Illuminate\Support\Facades\DB;

$projectsCount = DB::table('projects')->count();

@endphp

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
<div class="row">
  <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ $projectsCount }}</h3>
        <p>Projects</p>
      </div>
      <div class="icon">
        <i class="fas fa-folder-open"></i>
      </div>
      <a href="#" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
</script>
@endsection
