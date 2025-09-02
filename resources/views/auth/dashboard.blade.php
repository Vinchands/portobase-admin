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
  <div class="row">
    @foreach ($stats as $stat)
      <div class="col-6 col-md-3">
        <div class="small-box {{ $stat['colorClass'] }}">
          <div class="inner">
            <h3>{{ $stat['count'] }}</h3>
            <p>{{ $stat['name'] }}</p>
          </div>
          <div class="icon">
            <i class="{{ $stat['iconClass'] }}"></i>
          </div>
          <!--
          <a href="#" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
          -->
        </div>
      </div>
    @endforeach
  </div>
@endsection
