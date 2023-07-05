@if (session('isnotadmin'))
    <script>
        alert('{{ session('isnotadmin') }}')
    </script>
@endif
@if(session('error'))
    <script>
        alert('{{ session('error') }}')
    </script>
@endif
@if(session('success'))
    <script>
        alert('{{ session('success') }}')
    </script>
@endif

@extends('fontend.layout.main')

@section('content')
<section class="hero-section">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <div class="text-center mb-5 pb-2">
                    <h1 class="text-white">Đọc sách mỗi ngày</h1>

                    <p class="text-white">Đọc sách ta đọc cả đời.</p>
                    <p class="text-white">Kiến thức tích lũy lâu dần thành quen</p>
                </div>

                <div class="owl-carousel owl-theme">
                    @if (isset($data))
                        @foreach ($data as $d)
                        <div class="owl-carousel-info-wrap item">
                            <img src="/img/{{$d->hinhanh}}"
                                class="owl-carousel-image img-fluid" alt="" style="height: 450px">

                            <div class="owl-carousel-info">
                                <h6 class="mb-2">
                                    <a href="{{route('book.detail', $d->masach)}}" class="text-overflow">
                                        {{$d->ten}}
                                    </a>
                                </h6>

                                <span class="badge">{{$d->tentt}}</span>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

<section class="trending-podcast-section section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h5 class="section-title">Sách hay nhiều người mượn</h5>
                </div>
            </div>

            @if (isset($data2) && count($data2)>0)
                @foreach ($data2 as $d)
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

                            <div class="profile-block ">
                                <p class="badge">{{$d->tennganh}}</p>
                                <p class="badge">{{$d->tenloai}}</p>
                                <p class="badge">{{$d->tentt}}</p>
                            </div>
                        </div>

                        <div class="social-share d-flex flex-column ms-auto">
                            @php
                                $flag = false;
                                if (count($listsave) > 0) {
                                    foreach ($listsave as $value) {
                                        if ($value['masach'] == $d->masach) {
                                            $flag = true;
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
            @endif
        </div>
        <div class="row mt-5    ">

            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h5 class="section-title">Sách được đề cử</h5>
                </div>
            </div>

            @if (isset($data3) && count($data3)>0)
                @foreach ($data3 as $d)
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

                            <div class="profile-block ">
                                <p class="badge">{{$d->tennganh}}</p>
                                <p class="badge">{{$d->tenloai}}</p>
                                <p class="badge">{{$d->tentt}}</p>
                            </div>
                        </div>

                        <div class="social-share d-flex flex-column ms-auto">
                            @php
                                $flag = false;
                                if (count($listsave) > 0) {
                                    foreach ($listsave as $value) {
                                        if ($value['masach'] == $d->masach) {
                                            $flag = true;
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
            @endif

            <div class="col-lg-2 offset-lg-5 text-center mt-4">
                <a href="{{route('recommend')}}" class="btn btn-primary">Xem thêm</a>
            </div>
        </div>
    </div>
</section>
@endsection
