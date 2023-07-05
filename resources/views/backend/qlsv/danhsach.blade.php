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
                    <input value="{{old('ten')}}" type="text" class="form-control" id="ten" name="ten" placeholder="Tìm theo tên sinh viên">
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
    </h3>
    @if (count($data) > 0)
        <table class="table">
            <thead>
            <tr>
                <th>Mssv</th>
                <th>Họ và tên</th>
                <th>Lớp</th>
                <th>Số điện thoại</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data as $item)
                    <tr>
                        <td>{{$item->mssv}}</td>
                        <td>
                            <a href="{{route('sv.detail', $item->mssv)}}">{{$item->hoten}}</a>
                        </td>
                        <td>{{$item->tenlop}}</td>
                        <td>{{$item->sdt}}</td>
                        <td>
                            <form action="{{route('sv.delete', $item->mssv)}}" id="form-delete" method="post">
                                @csrf
                                @method('DELETE')
                                @can("edit users")
                                <a href="{{route('sv.edit', $item->mssv)}}" class="btn btn-sm btn-primary">
                                    <i class="menu-icon tf-icons bx bx-edit"></i>
                                </a>
                                @endcan
                                @can("delete users")
                                <button onclick="return confirm('Bạn có chắc chắn muốn xoá không?')"
                                type="submit" class="btn btn-sm btn-danger">
                                    <i class="menu-icon tf-icons bx bx-trash"></i>
                                </button>
                                @endcan
                            </form>
                            @can("edit permissions-roles")
                                <a href="{{route('permission.supply_role', ['id' => $item->mssv, 'type' => 'sv'])}}" class="mt-2 btn btn-primary">Cấp vai trò</a>
                                <a href="{{route('permission.supply_permissions', ['id' => $item->mssv, 'type' => 'sv'])}}" class="mt-2 btn btn-primary">Cấp quyền</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <td>
                {{$data->links('pagination::bootstrap-4')}}
            </td>

        </table>
    @else
        <h6>Chưa có sinhvien...</h6>
    @endif
</div>
@endsection
