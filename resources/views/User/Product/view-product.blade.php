@extends('ProjectLayout.master')
@section('page_content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    <!--Header not necessary-->
                </h1>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-11">
            <label class="text-danger">
                @if(Session::has('message'))
                {{Session::get('message')}}
                @endif
            </label>
        </div>
        <div class="col-1">
            <!-- <input type="submit" class="btn btn-danger btn-block" value="SAVE"> -->
        </div>
    </div>
    <div class="row padding-div-xs">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Product Detail</h3>
                </div>
                <div class="card-body">
                    <table id="table1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                @if(auth()->guard('vendor')->check())
                                <th>Action</th>
                                @else
                                <th>Vendor</th>
                                @endif
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Create Date</th>
                                <th>Quantity</th>
                                <th>Discount</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(auth()->guard('vendor')->check())
                            @foreach($product as $value)
                            @foreach($value['product'] as $val)
                            <tr>
                                <td>
                                    <a href="{{route('product.show',[$val['id']])}}" class="btn btn-xs btn-app editable-icon">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                                <td>{{$val['productname']}}</td>
                                <td>{{$val['price']}}</td>
                                <td>{{$val['description']}}</td>
                                <td>{{$val['createdate']}}</td>
                                <td>{{$val['quantity']}}</td>
                                <td>{{$val['discount']}}</td>
                                <td>
                                    <div class="filtr-item col-md-4" data-category="1" data-sort="Receipt">
                                        <a href="{{asset('storage/'.$val['image'])}}" data-toggle="lightbox" data-title="{{$val['productname']}}">
                                            <img src="{{asset('storage/'.$val['image'])}}" class="img-fluid mb-2" alt="Product" />
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                            @else
                            @foreach($product as $val)
                            <tr>
                                <td>{{$val['vendor']['name']}}</td>
                                <td>{{$val['productname']}}</td>
                                <td>{{$val['price']}}</td>
                                <td>{{$val['description']}}</td>
                                <td>{{$val['createdate']}}</td>
                                <td>{{$val['quantity']}}</td>
                                <td>{{$val['discount']}}</td>
                                <td>
                                    <div class="filtr-item col-md-4" data-category="1" data-sort="Receipt">
                                        <a href="{{asset('storage/'.$val['image'])}}" data-toggle="lightbox" data-title="{{$val['productname']}}">
                                            <img src="{{asset('storage/'.$val['image'])}}" class="img-fluid mb-2" alt="Product" />
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </form>
</section>
<script>
    $(function() {
        $("#table1").DataTable({
            "paging": false,
            "responsive": true,
            "autoWidth": false,
        });
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

        $('.filter-container').filterizr({
            gutterPixels: 3
        });
        $('.btn[data-filter]').on('click', function() {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
@endsection