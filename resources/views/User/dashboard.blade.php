@extends('ProjectLayout.master')
@section('header_content')
@endsection
@section('page_content')
@if(auth()->guard('admin')->check() || auth()->guard('vendor')->check())

@else
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <form method="POST" action="{{route('filter')}}" class="form-horizontal" style="width: 100%;">
                {{ csrf_field() }}
                <div class="form-group row">
                    <select name="filter-product" class="col-sm-4 col-form-label" required>
                        <option value="">Select</option>
                        <option value="1" {{$val=='1' ? 'selected':''}}>Product Old to New</option>
                        <option value="2" {{$val=='2' ? 'selected':''}}>Product New to Old</option>
                        <option value="3" {{$val=='3' ? 'selected':''}}>Price Low to High</option>
                        <option value="4" {{$val=='4' ? 'selected':''}}>Price High to Low</option>
                    </select>
                    <div class="col-md-2">
                        <input type="submit" class="btn btn-danger" value="Filter">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">

        </div>
        <div class="row" style="padding-top:20px;">
            <div class="col">
                <label class="relcon-submit-error">
                    @if(Session::has('error'))
                    {{Session::get('error')}}
                    @endif
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-solid">
                    <div class="card-body pb-0">
                        <div class="row d-flex align-items-stretch">
                            @for($i=0;$i<count($list);$i++) <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                <div class="card bg-light">
                                    <div class="card-header text-muted border-bottom-0">
                                        Product - {{$i+1}}
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead"><b>{{$list[$i]['productname']}}</b></h2>
                                                <p class="text-muted text-sm"><b>Description : </b>{{$list[$i]['description']}} </p>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"></i></span>Total Quantity : {{$list[$i]['quantity']}}</li>
                                                    <li class="small"><span class="fa-li"></i></span>Unit Price : {{$list[$i]['price']}}</li>
                                                </ul>
                                            </div>
                                            <div class="col-5 text-center">
                                                <img src="{{asset('storage/'.$list[$i]['image'])}}" alt="" class="img-circle img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="" class="btn btn-sm btn-primary">
                                                <i class="fas fa-user"></i> Rate
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! $link !!}
        </div>
    </div>
</section>
@endif
@endsection