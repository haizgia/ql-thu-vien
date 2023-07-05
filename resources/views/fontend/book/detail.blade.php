@extends('fontend.layout.main')

@section('content')
    @if (isset($data))
        <header class="site-header d-flex flex-column justify-content-center align-items-center">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12 text-center">

                        <h2 class="mb-0">Chi tiết sách</h2>
                    </div>

                </div>
            </div>
        </header>


        <section class="mb-5" id="section_2" style="min-height: 400px">
            <div class="container">
                <div class="row justify-content-center">
                    @if (Session::has('warning'))
                        <div class="alert alert-warning" role="alert">
                            {{ Session::get('warning') }}
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="col-lg-10 col-12">

                        <div class="row">
                            <div class="col-lg-3 col-12">
                                <img src="/img/{{ $data->hinhanh }}" class="w-100 rounded" alt="">

                            </div>

                            <div class="col-lg-9 col-12">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-information-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-information" type="button" role="tab"
                                            aria-controls="nav-information" aria-selected="true">
                                            Thông tin sách
                                        </button>
                                        <button class="nav-link" id="nav-decription-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-decription" type="button" role="tab"
                                            aria-controls="nav-decription" aria-selected="false">
                                            Mô tả
                                        </button>
                                        <button class="nav-link" id="nav-comment-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-comment" type="button" role="tab"
                                            aria-controls="nav-comment" aria-selected="false">
                                            Bình luận
                                            (@if (isset($allComment)) {{$allComment->total()}} @endif)
                                        </button>
                                    </div>
                                </nav>
                                <div class="tab-content mt-4" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-information" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <h6 class="mb-2">{{ $data->ten }}</h6>
                                        <p><strong>Tác giả: </strong>{{ $data->tacgia }}</p>
                                        <p><strong>Xuất bản: </strong>{{ $data->nxb }}</p>
                                        <p><strong>Ngành: </strong>{{ $data->tennganh }}</p>
                                        <p><strong>Loại: </strong>{{ $data->tenloai }}</p>
                                        <p><strong>Vị trí: </strong>{{ $data->tenvt }}</p>
                                        <p><strong>Trạng thái: </strong>{{ $data->tentt }}</p>
                                        <p><strong>Số lượng còn lại: </strong>{{ $data->soluong - $data->damuon - $data->damat }}</p>
                                        @if ($flag)
                                            <a href="{{ route('book.unsave', $data->masach) }}"
                                                class="btn btn-secondary rounded-pill px-3 me-2">
                                                <i class="fa fa-star me-1"></i>
                                                Bỏ Lưu
                                            </a>
                                        @else
                                            <a href="{{ route('book.save', $data->masach) }}"
                                                class="btn btn-primary rounded-pill px-3 me-2">
                                                <i class="fa fa-star me-1"></i>
                                                Lưu
                                            </a>
                                        @endif
                                        @if ($data->id == 1)
                                            @if ($flag2)
                                                <a href="{{ route('book.unregisterLend', $flag2) }}"
                                                    class="btn btn-secondary rounded-pill px-3">
                                                    </i><i class="fa fa-trash me-1"></i>
                                                    Huỷ đăng ký mượn
                                                </a>
                                            @else
                                                <a href="{{ route('book.registerLend', $data->masach) }}"
                                                    class="btn btn-primary rounded-pill px-3">
                                                    </i><i class="fa fa-pen me-1"></i>
                                                    Đăng ký mượn
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="nav-decription" role="tabpanel"
                                        aria-labelledby="nav-decription-tab">
                                        {!! $data->mota !!}
                                    </div>
                                    <div class="tab-pane fade" id="nav-comment" role="tabpanel"
                                        aria-labelledby="nav-comment-tab">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                @if (Auth::check())
                                                    <form class="mb-3" method="post" action="{{route('book.comment', $data->masach)}}">
                                                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                                                        <button class="btn btn-primary me-auto float-end mt-2 rounded-end" type="submit">Gửi</button>
                                                        @csrf
                                                    </form>
                                                    @if (isset($userComment) && count($userComment) > 0)
                                                        <h6 class="mt-5">Bình luận của bạn</h6>
                                                        @foreach ($userComment as $u)
                                                            <form action="{{route('book.commentUpdate', [$data->masach, $u->id])}}" method="post">
                                                                <textarea class="form-control mb-2" id="comment" name="comment" rows="2">{{$u['noidung']}}</textarea>
                                                                <label>Lần cuối chỉnh sửa @statusdate($u['updated_at'])</label>
                                                                <div class="d-flex justify-content-end">
                                                                    <button class="btn btn-primary me-2 btn-update" type="submit">Sửa</button>
                                                                    <a href="{{route('book.commentDelete',[$data->masach, $u->id])}}" class="btn btn-danger">Xoá</a>
                                                                </div>
                                                                @csrf
                                                            </form>
                                                        @endforeach
                                                    @endif
                                                @else
                                                    Vui lòng <a href="{{route('login')}}">đăng nhập</a> để có thể bình luận
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                @if (isset($allComment) && count($allComment) > 0)
                                                    @foreach ($allComment as $cm)
                                                    <div class="card mb-3" style="max-width: 540px;">
                                                        <div class="row g-0">
                                                          <div class="col-md-2">
                                                            <span class="rounded-circle p-3 bg-secondary d-inline-block ms-2 mt-2">
                                                                <i class="fa fa-user text-light h4 m-0"></i>
                                                            </span>
                                                          </div>
                                                          <div class="col-md-8">
                                                            <div class="card-body">
                                                              <h5 class="card-title">{{$cm['hoten']}}</h5>
                                                              <p class="card-text">{{$cm['noidung']}}</p>
                                                              <p class="card-text"><small class="text-muted">Lần cuối chỉnh sửa @statusdate($cm['updated_at'])</small></p>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @endif
                                                <div>
                                                    {{$allComment->links('pagination::bootstrap-4')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            </div>
        </section>
    @endif
@endsection

@if (isset($commenttab) && $commenttab)
    <script>
        window.onload = function()
        {
            clickComments();
        };

        function clickComments() {
            document.getElementById("nav-comment-tab").click();
        }
    </script>
@endif
