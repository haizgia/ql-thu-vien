@extends('backend.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="card col-lg-6 offset-lg-3">
            <h3 class="card-header">Danh sách vai trò</h3>
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
            @if (Session::has('update'))
                <form class="input-group" method="post" action="{{route('permission.update_role')}}">
                    <input type="text" class="form-control" placeholder="Sửa vai trò" aria-describedby="submit" name="role_update" value="{{Session::get('name')}}">
                    <input type="hidden" class="form-control" name="id" value="{{Session::get('update')}}">
                    <button class="btn btn-primary" type="submit" id="submit" name="submit">Sửa</button>
                    <a class="btn btn-danger" type="submit" id="submit" name="submit">Huỷ</a>
                    @error('role_update')
                        <div class="alert alert-danger w-100">{{ $message }}</div>
                    @enderror
                    @csrf
                </form>
            @endif
            <form class="input-group" method="post" action="{{route('permission.create_role')}}">
                <input type="text" class="form-control" placeholder="Thêm vai trò" aria-describedby="submit" name="role">
                <button class="btn btn-outline-primary" type="submit" id="submit" name="submit">Thêm</button>
                @error('role')
                    <div class="alert alert-danger w-100">{{ $message }}</div>
                @enderror
                @csrf
            </form>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Vai trò</th>
                            <th>Quyền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($role as $key => $r)
                            <tr>
                                <td>{{$r->name}}</td>
                                <td>
                                    @foreach ($r->permissions as $p)
                                        {{$p->name}},
                                    @endforeach
                                </td>
                                <td>
                                    @can("edit permissions-roles")
                                        <a href="{{route('permission.role_update_permissions', $r->name)}}" class="btn btn-warning mb-2">Thay đổi quyền</a>
                                    @endcan
                                    {{-- <a href="{{route('permission.form_update_role',$r->id)}}" class="btn btn-secondary">Sửa tên</a> --}}
                                    @can("delete permissions-roles")
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xoá không?')" href="{{route('permission.delete_role',$r->id)}}" class="btn btn-danger">Xoá</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
