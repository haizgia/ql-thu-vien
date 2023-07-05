@extends('backend.layout.main')

@section('content')
@if ($data)
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-3 offset-lg-1">
            <img src="/img/{{$data->hinhanh}}" class="w-100 rounded" alt="">
        </div>
        <div class="col-lg-7 bg-light p-5 rounded">
            <h4><strong>{{$data->ten}}</strong></h4>
            <p><strong>Tác giả: </strong>{{$data->tacgia}}</p>
            <p><strong>Xuất bản: </strong>{{$data->nxb}}</p>
            <p><strong>Ngành: </strong>{{$data->tennganh}}</p>
            <p><strong>Loại: </strong>{{$data->tenloai}}</p>
            <p><strong>Vị trí: </strong>{{$data->tenvt}}</p>
            <p><strong>Trạng thái: </strong>{{$data->tentt}}</p>
            <p><strong>Mô tả</strong></p>
                {!!$data->mota!!}
            <div>
                <form action="{{route('sach.delete', $data->masach)}}" id="form-delete" method="post">
                    @csrf
                    @method('DELETE')
                    @can("edit books")
                        <a href="{{route('sach.edit', $data->masach)}}" class="btn btn-primary">
                            Sửa sách <i class="menu-icon tf-icons bx bx-edit"></i>
                        </a>
                    @endcan
                    @can("delete books")
                    <button onclick="return confirm('Bạn có chắc chắn muốn xoá không?')"
                    type="submit" class="btn btn-danger">
                        Xoá sách <i class="menu-icon tf-icons bx bx-trash"></i>
                    </button>
                    {{-- sửa lại thêm sách --}}
                    @endcan
                </form>
            </div>
        </div>
    </div>
</div>
@else
    <div class="alert alert-err" role="alert">Có lỗi xảy ra</div>
@endif
@endsection
