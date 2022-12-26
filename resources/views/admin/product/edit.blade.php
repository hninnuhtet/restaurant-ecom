@extends('admin.layout')
@section('content')


<div class="content-wrapper">
    <div class="content-header">
        
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{route('admin.product.update', ['id' => $data->id ])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-5">
                    <div class="card">
                        <div class="card-header">
                            Edit Product
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

                            <div class="form-group">
                                <label>Category<span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control">
                                    <option value="0">--- Select ---</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    <option @if($data->category_id==$category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            

                            <div class="form-group">
                                <label>Price<span class="text-danger">*</span></label>
                                <input type="text" name="price" class="form-control" value="{{$data->price}}">
                            </div>

                            <div class="form-group">
                                <label>Description<span class="text-danger">*</span></label>
                                <input type="text" name="description" class="form-control" value="{{$data->description}}">
                            </div>

                            <div class="form-group" >
                                <label>Photo<span class="text-danger">*</span></label>                                
                                <input type="file" name="photo">
                                <img width="100" src="{{asset($data->gallery)}}" alt=" ">                                
                            </div>


                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{route('admin.product.index')}}" class="btn btn-danger m-3">Cancel</a>
                    </div>
                </div>                
            </form>  
        </div>
    </section>
</div>
  

@endsection