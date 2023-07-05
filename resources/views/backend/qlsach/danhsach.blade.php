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
        <form action="" class="col-lg-6">
            <div class="row">
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="masach" name="masach" placeholder="Tìm theo mã sách">
                </div>
                <div class="col-lg-4">
                    <button class="btn btn-primary" type="submit">Tìm</button>
                </div>
            </div>
        </form>
        <form class="col-lg-6">
            <div class="row">
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="ten" name="ten" placeholder="Tìm theo tên">
                </div>
                <div class="col-lg-4">
                    <button class="btn btn-primary" type="submit">Tìm</button>
                </div>
            </div>
        </form>
    </div>

    <h3 class="d-inline-block">
        @if ($title)
            {{$title}}
        @endif
    </h3>
    <a href="{{route('sach.create')}}" class="ms-5 btn btn-primary">Thêm sách +</a>
    @if (count($data) > 0)
        <table class="table">
            <thead>
            <tr>
                <th>Hình ảnh</th>
                <th>Mã sách</th>
                <th>Thông tin</th>
                <th>Ngành</th>
                <th>Loại</th>
                <th>Vị trí</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data as $item)
                    <tr>
                        <td>
                            <a href="{{route('sach.detail', $item->masach)}}">
                                <img src="/img/{{$item->hinhanh}}" width="70" alt="">
                            </a>
                        </td>
                        <td>{{$item->masach}}</td>
                        <td>
                            <a href="{{route('sach.detail', $item->masach)}}">{{$item->ten}}</a>
                            <p class="my-2">- Tác giả: {{$item->tacgia}}</p>
                            <p>- NXB: {{$item->nxb}}</p>
                        </td>
                        <td>{{$item->tennganh}}</td>
                        <td>{{$item->tenloai}}</td>
                        <td>{{$item->tenvt}}</td>
                        <td>{{$item->tentt}}</td>
                        <td>
                            <form action="{{route('sach.delete', $item->masach)}}" id="form-delete" method="post">
                                @csrf
                                @method('DELETE')
                                @can("edit books")
                                    <a href="{{route('sach.edit', $item->masach)}}" class="btn btn-sm btn-primary">
                                        <i class="menu-icon tf-icons bx bx-edit"></i>
                                    </a>
                                @endcan
                                @can("delete books")
                                <button onclick="return confirm('Bạn có chắc chắn muốn xoá không?')"
                                type="submit" class="btn btn-sm btn-danger">
                                    <i class="menu-icon tf-icons bx bx-trash"></i>
                                </button>
                                {{-- sửa lại thêm sách --}}
                                @endcan
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <td>
                {{$data->links('pagination::bootstrap-4')}}
            </td>

        </table>
    @else
        <h6>Chưa có sách...</h6>
    @endif
</div>
@endsection
