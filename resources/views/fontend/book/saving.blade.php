@extends('fontend.layout.main')

@section('content')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12 text-center">

                <h2 class="mb-0">Danh sách sách đã lưu</h2>
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
        <div class="row">
            @foreach ($data as $d)
            <div class="col-lg-3 col-12 mb-4 mb-lg-0">
                <div class="custom-block custom-block-full">
                    <div class="custom-block-image-wrap">
                        <a href="{{route('book.detail', $d->masach)}}">
                            <img src="/img/{{$d->hinhanh}}" class="custom-block-image img-fluid">
                        </a>
                    </div>

                    <div class="custom-block-info">
                        <h6 class="mb-2">
                            <a href="{{route('book.detail', $d->masach)}}" class="text-overflow">
                                {{$d->ten}}
                            </a>
                        </h6>

                        <div class="profile-block">
                            <p class="badge">{{$d->tennganh}}</p>
                            <p class="badge">{{$d->tenloai}}</p>
                            <p class="badge">{{$d->tentt}}</p>
                        </div>
                    </div>

                    <div class="social-share d-flex flex-column ms-auto">
                        @php
                            $flag = false;
                            if (Auth::check()) {
                                if (Session::has('book.save')) {
                                    foreach (Session::get('book.save') as $value) {
                                        if ($value == $d->masach) {
                                            $flag = true;
                                        }
                                    }
                                }
                            }
                        @endphp
                        @if($flag)
                            <a href="{{route('book.unsave', $d->masach)}}" class="badge ms-auto  bg-primary">
                                <i class="bi-bookmark"></i>
                            </a>
                        @else
                            <a href="{{route('book.save', $d->masach)}}" class="badge ms-auto">
                                <i class="bi-bookmark"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        Bạn chưa lưu sách nào
        @endif
    </div>
@endif
@endsection
