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
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h2 class="mb-0">{{$title}}</h2>
            </div>
        </div>
    </div>
</header>

<section class="trending-podcast-section section-padding">
    <div class="container">
        <div class="row">
            @if (isset($data) && count($data)>0)
                @foreach ($data as $d)
                <div class="col-lg-3 col-12 mb-4">
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
        <div class="row mt-4">
            <div class="col-lg-6 offset-lg-3">
                {{$data->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>
</section>
@endsection
