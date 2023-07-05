@extends('fontend.layout.main')

@section('content')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12 text-center">

                <h2 class="mb-0">Danh sách đăng kí mượn</h2>
            </div>

        </div>
    </div>
</header>
@if (isset($data))
    <div class="container m-5" >
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
            <div class="row mb-4">
                <div class="col-lg-2">
                    <h6>Hình ảnh</h6>
                </div>
                <div class="col-lg-4">
                    <h6>Tên sách</h6>
                </div>
                <div class="col-lg-2">
                    <h6>Hạn hẹn lấy</h6>
                </div>
                <div class="col-lg-2">
                    <h6>Trạng thái</h6>
                </div>
                <hr>
            </div>
            @foreach ($data as $d)
                <div class="row mb-2">
                    <div class="col-lg-2">
                        <img src="/img/{{$d->hinhanh}}" class="w-25" maxheight="120" alt="">
                    </div>
                    <div class="col-lg-4">
                        <a href="{{route('book.detail', $d->masach)}}">
                            {{$d->ten}}
                        </a>
                    </div>
                    <div class="col-lg-2">
                        <p>{{$d->ngayhen}}</p>
                    </div>
                    <div class="col-lg-2">
                        <p class="btn btn-primary">{{$d->tentt}}</p>
                    </div>
                    @if ($d->id == 3)
                        <div class="col-lg-2">
                            <a href="{{route('book.unregisterLend', $d->madk)}}" class="btn btn-danger rounded-pill px-3">
                                Huỷ đăng ký
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        @else
        Bạn chưa đăng ký mượn sách nào
        @endif
    </div>
@endif
@endsection
