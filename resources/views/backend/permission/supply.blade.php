@extends('backend.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if (isset($form))
        <div class="row mb-4">
            <form class="col-lg-6">
                <h3>Tìm kiếm</h3>
                <div class="row">
                    <div class="col-lg-8">
                        <input value="{{old('ms')}}" type="text" class="form-control" id="ms" name="ms"
                        placeholder="Tìm theo mã số">
                        @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                            {{Session::get('error')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-primary" type="submit">Tìm</button>
                    </div>
                </div>
            </form>
        </div>
    @endif
    @if (isset($datasv) && count($datasv) > 0)
        <table class="table">
            <h3>Danh sách sinh viên</h3>
            <thead>
            <tr>
                <th>Mã số sinh viên</th>
                <th>Họ và tên</th>
                <th>Vai trò</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($datasv as $sv)
                    <tr>
                        <td>{{$sv->mssv}}</td>
                        <td>{{$sv->hoten}}</td>
                        <td>{{$user::find($sv->mssv)->roles->pluck('name') == '[]' ?
                            '' : $user::find($sv->mssv)->roles->pluck('name')[0]}}</td>
                        <td>
                            <a href="{{route('permission.supply_role', ['id' => $sv->mssv, 'type' => 'sv'])}}" class="btn btn-primary">Cấp vai trò</a>
                            <a href="{{route('permission.supply_permissions', ['id' => $sv->mssv, 'type' => 'sv'])}}" class="btn btn-primary">Cấp quyền</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <td>
                {{$datasv->links('pagination::bootstrap-4')}}
            </td>

        </table>
    @elseif ($form)
        <h6>Không tìm thấy sinh viên phù hợp...</h6>
    @endif
    {{-- @if (isset($datanv) && count($datanv) > 0)
        <table class="table">
            <h3>Danh sách nhân viên</h3>
            <thead>
            <tr>
                <th>Mã số nhân viên</th>
                <th>Họ và tên</th>
                <th>Vai trò</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($datanv as $nv)
                    <tr>
                        <td>{{$nv->mssv}}</td>
                        <td>{{$nv->hoten}}</td>
                        <td>{{$user::find($nv->mssv)->roles->pluck('name') == '[]' ?
                        '' : $user::find($nv->mssv)->roles->pluck('name')[0]}}</td>
                        <td>
                            <a href="{{route('permission.supply_role', ['id' => $nv->mssv, 'type' => 'nv'])}}" class="btn btn-primary">Cấp vai trò</a>
                            <a href="{{route('permission.supply_permissions', ['id' => $nv->mssv, 'type' => 'nv'])}}" class="btn btn-primary">Cấp quyền</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <td>
                {{$datanv->links('pagination::bootstrap-4')}}
            </td>

        </table>
    @elseif ($form)
        <h6>Không tìm thấy nhân viên viên phù hợp...</h6>
    @endif --}}
</div>
@endsection
