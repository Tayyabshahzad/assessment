@extends('tasks.layouts.master')
@section('title','Index')
@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Tasks</h1>
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


        @foreach($tasks as $task)
        <div class=" mb-4 box-shadow col-lg-3">
            <div class="card-header">
            <h5 class="my-0 font-weight-normal text-center"> {{ $task->name }}  | <span class="badge badge-info">{{ $task->priority }} </span></h5>
            </div>
            <div class="card-body">

             <p>
                {{ $task->description }}
             </p>
             <h6>Categories:</h6>

        <ol class="list-unstyled mt-3 mb-4">
            @foreach ($task->categories as $category)
                <li> {{ $category->name }} </li>
            @endforeach
        </ol>

            </div>
        </div>
      @endforeach
    </div>
    {{ $tasks->links('vendor.pagination.bootstrap-4') }}
  </div>

  @role('admin')
        <div class="container">
        <h1>Task Management</h1>
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Task Name:</label>
                <input type="text" name="name" id="name" class="form-control"  value="{{ old('name') }}"  >
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="priority">Priority:</label>
                <input type="number" name="priority" id="priority" class="form-control" value="{{ old('priority') }}"   min="1"  >
            </div>
            <div class="form-group">
                <label for="categories">Categories:</label>
                <select name="categories[]" id="categories" class="form-control" multiple  >
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Task</button>
        </form>
    </div>
    @endrole

@endsection
