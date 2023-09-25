@extends('includes.app')

@php
    
 $GLOBALS['CurrentUser']= auth()->user(); 
@endphp

@section('content')




@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session()->has('success'))
<div class="alert alert-success">
    @if(is_array(session('success')))
    <ul>
        @foreach (session('success') as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
    @else
    {{ session('success') }}
    @endif
</div>
@endif


<div class="card mb-4 shadow">
    <div class="card-header py-3 bg-techbot-dark">
        <nav class="navbar navbar-dark justify-content-center">
            <a class="navbar-brand text-light"> Import products </a>
        </nav>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("products.excelImportStore") }}" enctype="multipart/form-data" class="d-flex flex-column align-items-center">
            @csrf
            <div class="row w-100">
                <div class="col-12 col-md-4 form-group mx-auto text-center">
                    <label for="name">Excel <span style="color: red">*</span></label>
                    <input type="file" class="form-control" id="name" name="file" accept=".xlsx, .xls" required>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-info btn-md mt-3">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>



@endsection