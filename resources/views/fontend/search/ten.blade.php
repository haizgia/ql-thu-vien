@extends('fontend.layout.main')

@section('content')
<div class="container m-5">
    <div class="row">
        <h3 class="text-center mb-5">Tìm kiếm sách</h3>
        <div class="col-lg-6">
            <form action="">
                <div class="row">
                    <div class="col-lg-3 m-auto text-right">
                        <label for="ten">Nhập tên sách</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" name="ten" id="ten" class="form-control rounded-pill">
                    </div>
                </div>
                <button class="btn btn-primary px-4 float-right mt-4 rounded-pill" type="submit">Tìm</button>
            </form>
        </div>
    </div>
    @if (count($data) > 0)
        <h3 class="text-center my-5">{{$title}}</h3>
        @foreach ($data as $key=>$item)
            <hr >
            <div class="row">
                <div class="col-lg-2">
                    <img src="/img/{{$item->hinhanh}}" class="w-100" maxheight="120" alt="">
                </div>
                <div class="col-lg-10">
                    <a href="{{route('book.detail', $item->masach)}}">
                        <h5>{{$item->ten}}</h5>
                    </a>
                    <p>Tác giả: {{$item->tacgia}}</p>
                    <p>Nhà xuất bản: {{$item->nxb}}</p>
                </div>
            </div>
        @endforeach

        <div class="row">
            {{$data->links('pagination::bootstrap-4')}}
        </div>
    @else
        <p>...</p>
    @endif
</div>
@endsection
