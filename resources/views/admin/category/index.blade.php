@extends('admin.layout')
@section('content')

@if (Session::has('success'))
<div class="alert alert-success text-center">
    <p>{{ Session::get('success') }}</p>
</div>
@endif

<div class="content-wrapper">
    <section class="content">
        <div class="card shadow mt-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Categories
                    <a href="{{ route('admin.category.create') }}" class="btn btn-primary float-sm-right">
                        +Add
                    </a>                    
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered mx-3" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>                    
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($data)
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>                                    
                                    <td>{{$item->name}}</td>
                                    <td>
                                        {{-- <a href="{{route('admin.category.show', ['id' => $item->id])}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a> --}}
                                        <a href="{{route('admin.category.edit', ['id' => $item->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        <a onclick="return confirm('Are you sure to delete this data?')" href="{{route('admin.category.delete', ['id' => $item->id])}}" 
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>



@endsection