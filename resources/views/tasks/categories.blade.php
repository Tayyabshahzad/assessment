@extends('tasks.layouts.master')
@section('title','Index')
@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Categories</h1>
    </div>


  <div class="container">

    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{  $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif


    <div class="card-deck mb-3   row">
        @foreach($categories as $category)
            <div class=" mb-4 box-shadow col-lg-3">
                <div class="card-header">
                <h5 class="my-0 font-weight-normal text-center"> {{ $category->name }}  | <span class="badge badge-info">{{ $category->id }} </span></h5>
                </div>
            </div>
      @endforeach
    </div>

  </div>






</div>

@endsection
