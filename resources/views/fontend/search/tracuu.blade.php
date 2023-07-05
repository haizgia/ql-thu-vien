@extends('fontend.layout.main')

@section('content')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h2 class="mb-0">Tra cứu</h2>
            </div>
        </div>
    </div>
</header>
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-3">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <a class="btn text-light" href="{{route('search.tracuu')}}">
                              Tra cứu chung
                            </a>
                        </div>
                    </div>
                    <div class="card">
                      <div class="card-header bg-primary">
                        <a class="btn text-light" data-bs-toggle="collapse" href="#collapseOne">
                          Tra cứu theo loại tài liệu
                        </a>
                      </div>
                      <div id="collapseOne" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @if (isset($loai))
                                    @foreach ($loai as $l)
                                    <li class="list-group-item">
                                        <a href="{{route('search.tracuu', ['type'=>'loai', 'id'=>$l->maloai])}}">{{$l->tenloai}}</a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-primary">
                            <a class="btn text-light" data-bs-toggle="collapse" href="#collapseTwo">
                              Tra cứu theo Ngành
                            </a>
                        </div>
                      <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @if (isset($nganh))
                                    @foreach ($nganh as $n)
                                    <li class="list-group-item">
                                        <a href="{{route('search.tracuu', ['type'=>'nganh', 'id'=>$n->manganh])}}">{{$n->tennganh}}</a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <div class="section-title-wrap mb-4">
                    <h4 class="section-title bg-primary text-light">{{$title}}</h4>
                </div>
                <form class="row" method="">
                    <input type="hidden" value="{{isset($type) ? $type : ''}}" name="type">
                    <input type="hidden" value="{{isset($id) ? $id : ''}}" name="id">
                    <div class="form-group mb-2 col-lg-6">
                        <label for="key">
                            <strong>Từ khoá tìm kiếm: </strong>
                        </label>
                        <input type="text" value="{{isset($key) ? $key : ''}}" class="form-control" id="key" placeholder="Từ khoá" name="key">
                    </div>
                    <div class="form-group mb-2 col-lg-6">
                        <strong>Tìm theo: </strong>
                        <select class="form-control" id="timtheo" name="timtheo">
                            @foreach ($timtheo as $t)
                                <option value="{{$t['value']}}" @if (isset($tt) && $tt == $t['value']) selected @endif>
                                    {{ $t['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <strong>Sắp xếp: </strong>
                        <div class="form-group">
                            <select class="form-control" id="sapxep" name="sapxep">
                                @foreach ($sapxep as $k=>$s)
                                    <option value="{{$s['value']}}"  @if (isset($sx) && $sx == $s['value']) selected @endif>
                                        {{ $s['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <strong>Hiển thị: </strong>
                        <div class="form-group">
                            <select class="form-control" id="hienthi" name="hienthi">
                                @foreach ($hienthi as $h)
                                    <option value="{{$h}}"  @if (isset($ht) && $ht == $h) selected @endif>
                                        {{ $h }}
                                    </option>
                                @endforeach
                            </select>
                          </div>
                    </div>
                    <button class="btn btn-primary w-25 m-auto mt-2" name="submit" type="submit">Tìm kiếm</button>
                </form>
                @if (isset($data))
                    @if (count($data) > 0)
                        <div class="row mt-4">
                            @foreach ($data as $item)
                                <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                                    <div class="custom-block custom-block-overlay">
                                        <a href="{{route('book.detail', ['id' => $item->masach])}}" class="custom-block-image-wrap">
                                            <img src="/img/{{ $item->hinhanh }}" class="custom-block-image img-fluid" alt="">
                                        </a>

                                        <div class="custom-block-info custom-block-overlay-info">
                                            <p class="mb-1">
                                                <a href="{{route('book.detail', ['id' => $item->masach])}}" class="text-overflow text-dark ">
                                                    <strong>{{$item->ten}}</strong>
                                                </a>
                                            </p>

                                            <p class="badge mb-0">{{$item->tentt}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            {{$data->links('pagination::bootstrap-4')}}
                        </div>
                    @else
                        <p class="mt-4">Không có sách phù hợp</p>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
