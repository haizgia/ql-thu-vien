@extends('fontend.layout.main')

@section('content')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12 text-center">

                <h2 class="mb-0">Đăng ký mượn sách online</h2>
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
            <div class="row">
                <form class="col-lg-8 offset-lg-2 p-5 border border-primary rounded" method="post" action="{{route('book.lend')}}">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="/img/{{$data->hinhanh}}" class="w-75" maxheight="120" alt="">
                            <input type="hidden" name="masach" value="{{$data->masach}}">
                        </div>
                        <div class="col-lg-8">
                            <h5>{{$data->ten}}</h5>
                            <input type="hidden" name="ngayhen" value="{{$ngayhen}}">
                            <p><strong>*** Lưu ý: </strong>Bạn phải lên thư viện lấy trước ngày {{$ngayhen->day.'-'.$ngayhen->month.'-'.$ngayhen->year}}.</p>
                            <p>Nếu không đăng ký mượn sẽ tự động huỷ</p>
                            <button class="btn btn-primary mt-2 rounded-1" type="submit">Đăng ký</button>
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    @endif
@endsection
