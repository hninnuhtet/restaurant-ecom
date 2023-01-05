@extends('admin.layout')
@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif

    <div class="content-wrapper">
        <div class="card shadow mt-2">
            {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Orders History</h6>
        </div> --}}
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-5">Orders History -- <b><span id="total_records"></span></b></div>
                    <div class="col-md-5">
                        <div class="input-group input-daterange">
                            <input type="text" name="from_date" id="from_date" readonly class="form-control" />
                            <div class="input-group-addon mx-3 mt-1">to</div>
                            <input type="text" name="to_date" id="to_date" readonly class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
                        <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
                    </div>
                </div>
            </div>

            <section class="content">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Code</th>
                            <th>Ordered Time</th>
                            <th>Action</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{ csrf_field() }}
                        {{-- @php $total = 0 @endphp
                        @if ($orders)
                            @foreach ($orders as $order)
                                @php $total += $order->total_price  @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->order_code }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ $order->customer->phone }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.orderHistory.show', ['id' => $order->id]) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        <a onclick="return confirm('Are you sure to delete this data?')"
                                            href="{{ route('admin.orderHistory.delete', ['id' => $order->id]) }}"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                    <td>{{ $order->total_price }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td>{{ $total }}</td>
                            </tr>
                        @endif --}}
                    </tbody>
                </table>
            </section>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            var date = new Date();

            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            var _token = $('input[name="_token"]').val();

            fetch_data();

            function fetch_data(from_date = '', to_date = '') {
                $.ajax({
                    url: "{{ route('admin.orderHistory.history.fetch_data') }}",
                    method: "POST",
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        _token: _token
                    },
                    dataType: "json",
                    success: function(data) {
                        var output = '';
                        $('#total_records').text(data.length);
                        for (var count = 0; count < data.length; count++) {
                            let id = data[count].id;
                            output += `<tr>
                                    <td>${count}</td>
                                    <td>${data[count].order_code}</td>
                                    <td>${data[count].created_at}</td>
                                    <td>
                                        <a href="/admin/orderHistory/show/${id}"
                                            class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        <a onclick="return confirm('Are you sure to delete this data?')"
                                            href="/admin/orderHistory/delete/${id}"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>                                    
                                    <td>${data[count].total_price}</td>
                                </tr>`;                    
                            }
                        $('tbody').html(output);
                    }
                })
            }

            $('#filter').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if (from_date != '' && to_date != '') {
                    fetch_data(from_date, to_date);
                } else {
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function() {
                $('#from_date').val('');
                $('#to_date').val('');
                fetch_data();
            });


        });
    </script>
@endsection
