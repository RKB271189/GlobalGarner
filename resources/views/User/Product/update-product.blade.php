@extends('ProjectLayout.master')
@section('header_content')
@endsection
@section('page_content')
<section class="content">
    <div class="container-fluid">
        <div class="row padding-10px-top">
            <div class="offset-md-1 col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Enter Product Details</h3>
                    </div>
                    <form method="POST" action="{{route('product.update',$product['id'])}}" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input name="productname" value="{{old('productname',$product['productname'])}}" type="text" class="form-control " placeholder="Enter Product Name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-10">
                                    <input name="price" value="{{old('price',$product['price'])}}" type="text" class="form-control " placeholder="Enter Price" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input name="description" value="{{old('description',$product['description'])}}" type="text" class="form-control" placeholder="Enter Product Description" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input name="image" type="file" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input name="quantity" value="{{old('quantity',$product['quantity'])}}" type="text" class="form-control" placeholder="Enter Total Quantity" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Discount</label>
                                <div class="col-sm-10">
                                    <input name="discount" value="{{old('discount',$product['discount'])}}" type="text" class="form-control" placeholder="Enter Discount" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-10">
                                    <label class="text-danger">
                                        <small class="font-weight-bold">
                                            <a class="text-danger">
                                                @if($errors->has('productname'))
                                                {{$errors->first('productname')}}
                                                @elseif($errors->has('description'))
                                                {{$errors->first('description')}}
                                                @elseif($errors->has('image'))
                                                {{$errors->first('image')}}
                                                @elseif($errors->has('quantity'))
                                                {{$errors->first('quantity')}}
                                                @elseif($errors->has('discount'))
                                                {{$errors->first('discount')}}
                                                @elseif(Session::has('message'))
                                                {{Session::get('message')}}
                                                @else
                                                @endif
                                            </a>
                                        </small>
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-danger btn-block float-right" value="Update">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection