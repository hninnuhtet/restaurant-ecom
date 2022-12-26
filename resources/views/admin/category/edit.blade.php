@extends('admin.layout')
@section('content')


<div class="content-wrapper">
    <div class="content-header">
        
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{route('admin.category.update', ['id' => $data->id ])}}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-5">
                    <div class="card">
                        <div class="card-header">
                            Edit Category
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div> <br>
                            @endif
                            @if(Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{session('success')}}
                                </div> <br>
                            @endif

                            <div class="form-group">
                                <label>Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{$data->name}}">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{route('admin.category.index')}}" class="btn btn-danger m-3">Cancel</a>
                    </div>
                </div>                
            </form>  
        </div>
    </section>
</div>
  

@endsection