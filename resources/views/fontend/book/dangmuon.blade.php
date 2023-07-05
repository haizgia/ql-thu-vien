@extends('fontend.layout.main')

@section('content')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12 text-center">

                <h2 class="mb-0">Danh sách đang mượn</h2>
            </div>

        </div>
    </div>
</header>
@if (isset($data))
    <div class="container m-5" style="min-height: 700px">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
            </div>
        @endif
        @if (Session::has('err'))
            <div class="alert alert-danger" role="alert">
            {{Session::get('err')}}
            </div>
        @endif
        @if (isset($data) && count($data) > 0)
        <h3 class="text-center mb-4">Danh sách đang mượn</h3>
            <div class="row mb-4">
                <div class="col-lg-2 offset-lg-1">
                    <h6>Hình ảnh</h6>
                </div>
                <div class="col-lg-4">
                    <h6>Tên sách</h6>
                </div>
                <div class="col-lg-2">
                    <h6>Hạn trả</h6>
                </div>
                <div class="col-lg-2">
                    <h6>Trạng thái</h6>
                </div>
                <hr>
            </div>
            @foreach ($data as $d)
                <div class="row mb-2 ">
                    <div class="col-lg-2 offset-lg-1">
                        <img src="/img/{{$d->hinhanh}}" class="w-25" maxheight="120" alt="">
                    </div>
                    <div class="col-lg-4">
                        <a href="{{route('book.detail', $d->masach)}}">
                            <h6>{{$d->ten}}</h6>
                        </a>
                    </div>
                    <div class="col-lg-2">
                        <p>{{$d->ngayhentra}}</p>
                    </div>
                    <div class="col-lg-2">
                        @if ($d->id == 8)
                            <p class="btn btn-danger">{{$d->tentt}}</p>
                        @else
                            <p class="btn btn-primary">{{$d->tentt}}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
        Bạn chưa mượn sách nào
        @endif
    </div>
@endif
@endsection
