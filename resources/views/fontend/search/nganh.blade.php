@extends('fontend.layout.main')

@section('content')
<div class="container m-5">
    <div class="row">
        @if (!isset($data))
            @foreach ($nganh as $n)
                <div class="col-lg-3">
                    <a href="{{route('search.nganh', ['id' => $n->manganh])}}">
                        <i class="fa fa-arrow-right text-primary me-2"></i>
                        {{$n->tennganh}}
                    </a>
                </div>
            @endforeach
        @else
            <div class="col-lg-3">
                @foreach ($nganh as $n)
                    <a class="btn btn-link d-block w-100 @if ($n->manganh == $getMajors['manganh']) btn-primary @endif"
                        href="{{route('search.nganh', ['id' => $n->manganh])}}" style="text-align: left">
                        <i class="fa fa-arrow-right text-primary me-2"></i>
                        {{$n->tennganh}}
                    </a>
                @endforeach
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="d-inline-block">{{$title}}</h5>
                    </div>
                    <div class="col-lg-6">
                        <form class="position-relative mx-auto border" style="max-width: 400px;">
                            <input class="form-control border-0 w-100 py-2 ps-4 pe-5" type="text" placeholder="Tìm kiếm" name="ten">
                            <button class="btn btn-primary py-2 position-absolute top-0 end-0 px-4" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                @if (count($data) > 0)
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
                    Hiện chưa có sách
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
