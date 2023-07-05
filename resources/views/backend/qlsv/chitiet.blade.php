@extends('backend.layout.main')

@section('content')
@if ($data)
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row bg-light p-5 rounded">
        <div class="col-lg-3">
            <img src="/img/user.png" class="w-100 rounded" alt="">
        </div>
        <div class="col-lg-8 offset-lg-1">
            <h5 class="text-primary">Mssv: {{$data->mssv}}</h5>
            <h5 class="text-primary">Họ tên: {{$data->hoten}}</h5>
            <h5 class="text-primary">Ngày sinh: {{$data->ngaysinh}}</h5>
            <h5 class="text-primary">Giới tính: {{$data->gioitinh == 0 ? 'Nam' : 'Nữ'}}</h5>
            <h5 class="text-primary">Lớp: {{$data->tenlop}}</h5>
            <h5 class="text-primary">Số điện thoại: {{$data->sdt}}</h5>
            <h5 class="text-primary">Địa chỉ: {{$data->diachi}}</h5>
            <form action="{{route('sv.delete', $data->mssv)}}" id="form-delete" method="post" class="mt-4">
                @csrf
                @method('DELETE')
                @can("edit users")
                <a href="{{route('sv.edit', $data->mssv)}}" class="btn btn-primary me-2">
                    Sửa <i class="menu-icon tf-icons bx bx-edit"></i>
                </a>
                @endcan
                @can("delete users")
                <button onclick="return confirm('Bạn có chắc chắn muốn xoá không?')"
                type="submit" class="btn btn-danger">
                    Xoá <i class="menu-icon tf-icons bx bx-trash"></i>
                </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@else
    <div class="alert alert-err" role="alert">Có lỗi xảy ra</div>
@endif
@endsection
