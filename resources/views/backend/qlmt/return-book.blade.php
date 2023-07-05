@extends('backend.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">
            {{Session::get('error')}}
            </div>
        @endif
        <h3>Trả sách</h3>
        <form class="col-lg-6 mb-4" method="POST" action="">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="maphieu">Mã số phiếu</label>
                <div class="col-sm-9">
                    <input type="text" value="{{old('maphieu')}}" class="form-control" id="maphieu" name="maphieu" />
                </div>
                @error('maphieu')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-primary" type="submit" style="float: right">Tìm</button>
            @csrf
        </form>
        @if($data == 'test')
            <p>Vui lòng điền mã phiếu</p>
        @elseif ($data !== null)
            <div class="col-lg-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Mã phiếu</th>
                        <th>Mssv</th>
                        {{-- <th>Họ và tên</th> --}}
                        <th>Sách đang mượn</th>
                        <th>Ngày mượn</th>
                        <th>Hạn trả</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>{{$data->maphieu}}</td>
                            <td>{{$data->mssv}}</td>
                            {{-- <td>
                                <a href="{{route('sv.detail', $data->mssv)}}">{{$data->hoten}}</a>
                            </td> --}}
                            <td>{{$data->ten}}</td>
                            <td>
                                @datetime($data->ngaymuon)
                            </td>
                            <td>
                                @datetime($data->ngayhentra)
                            </td>
                            <td>{{$data->tentt}}</td>
                            <td>
                                @if ($data->id == 6)
                                    <a href="{{route('mt.returned', $data->maphieu)}}" class="btn btn btn-primary mb-2">
                                        <i class="menu-icon tf-icons bx bx-edit"></i>Đã trả
                                    </a>
                                    <a href="{{route('mt.returned', $data->maphieu)}}" class="btn btn btn-danger">
                                        <i class="menu-icon tf-icons bx bx-edit"></i>Vi phạm
                                    </a>
                                @elseif ($data->id == 8)
                                    <a href="{{route('mt.returned', $data->maphieu)}}" class="btn btn btn-primary mb-2">
                                        <i class="menu-icon tf-icons bx bx-edit"></i>Đã trả
                                    </a>
                                    <a href="{{route('mt.returned', $data->maphieu)}}" class="btn btn btn-primary mb-2">
                                        <i class="menu-icon tf-icons bx bx-edit"></i>Gia hạn
                                    </a>
                                    <a href="{{route('mt.returned', $data->maphieu)}}" class="btn btn btn-danger">
                                        <i class="menu-icon tf-icons bx bx-edit"></i>Vi phạm
                                    </a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <p>Mã phiếu không tồn tại</p>
        @endif
    </div>
</div>
@endsection
