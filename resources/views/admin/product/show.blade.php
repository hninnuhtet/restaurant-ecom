@extends('admin.layout')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        
    </div>

    <section class="content">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Product
                    <a href="{{route('admin.product.index')}}" class="float-right btn btn-success btn-sm">View All</a>
                </h6>
            </div>
            <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{$data->name}}</td>
                        </tr>                   
                        <tr>
                            <th>Price</th>
                            <td>{{$data->price}}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{$data->category->name}}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{$data->description}}</td>
                        </tr>
                        <tr>
                            <th>Photo</th>
                            <td><img width="200" src="{{asset($data->gallery)}}" alt=""></td>
                        </tr>                        
                    </table>
            </div>
        </div>
    </section>
</div>
  

@endsection