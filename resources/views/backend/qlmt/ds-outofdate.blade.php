@extends('backend.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
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
    <h3>Tìm kiếm</h3>
    <div class="row mb-4">
        <form class="col-lg-6">
            <div class="row">
                <div class="col-lg-8">
                    <input value="{{old('mssv')}}" type="text" class="form-control" id="mssv" name="mssv"
                    placeholder="Tìm theo mã số sinh viên">
                </div>
                <div class="col-lg-4">
                    <button class="btn btn-primary" type="submit">Tìm</button>
                </div>
            </div>
        </form>
        <form class="col-lg-6">
            <div class="row">
                <div class="col-lg-8">
                    <input value="{{old('maphieu')}}" type="text" class="form-control" id="maphieu" name="maphieu" placeholder="Tìm theo mã phiếu">
                </div>
                <div class="col-lg-4">
                    <button class="btn btn-primary" type="submit">Tìm</button>
                </div>
            </div>
        </form>
    </div>

    <h3>
        @if ($title)
            {{$title}}
        @endif
        <a href="{{ route('mt.exportOutOfDate') }}" class="btn btn-primary ms-4">+ Export file</a>
    </h3>
    @if (isset($data) && count($data) > 0)
        <table class="table">
            <thead>
            <tr>
                <th>Mã phiếu</th>
                <th>Mã sách</th>
                <th>Mssv</th>
                <th>Họ và tên</th>
                <th>Sách đang mượn</th>
                <th>Ngày mượn</th>
                <th>Ngày hẹn trả</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data as $item)
                    <tr>
                        <td>{{$item->maphieu}}</td>
                        <td>{{$item->masach}}</td>
                        <td>{{$item->mssv}}</td>
                        <td>
                            <a href="{{route('sv.detail', $item->mssv)}}">{{$item->hoten}}</a>
                        </td>
                        <td>{{$item->ten}}</td>
                        <td>
                            @datetime($item->ngaymuon)
                        </td>
                        <td>
                            @datetime($item->ngayhentra)
                        </td>

                        <td>{{$item->tentt}}@if ($item->id == 8) (@statusdate($item->ngayhentra)) @endif</td>
                        @can("edit lend-return")
                        <td>
                            @if ($item->id == 8)
                                <a href="{{route('mt.returned', $item->maphieu)}}" class="btn btn btn-primary mb-2">
                                    <i class="menu-icon tf-icons bx bx-edit"></i>Đã giải quyết
                                </a>
                                <a href="{{route('mt.violate', $item->maphieu)}}" class="btn btn btn-danger mb-2">
                                    <i class="menu-icon tf-icons bx bx-edit"></i>Vi phạm
                                </a>
                                <a href="{{route('mt.losed', $item->maphieu)}}" class="btn btn btn-danger mb-2">
                                    <i class="menu-icon tf-icons bx bx-edit"></i>Đã mất
                                </a>
                            @elseif ($item->id == 9)
                                <a href="{{route('mt.solved', $item->maphieu)}}" class="btn btn btn-primary mb-2">
                                    <i class="menu-icon tf-icons bx bx-edit"></i>Đã giải quyết
                                </a>
                            @elseif ($item->id == 11)
                                <a href="{{route('mt.refunded', $item->maphieu)}}" class="btn btn btn-primary mb-2">
                                    <i class="menu-icon tf-icons bx bx-edit"></i>Hoàn trả sách
                                </a>
                            @endif
                        </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
            <td>
                {{$data->links('pagination::bootstrap-4')}}
            </td>

        </table>
    @else
        <h6>Không có dữ liệu phù hợp...</h6>
    @endif
</div>
@endsection
