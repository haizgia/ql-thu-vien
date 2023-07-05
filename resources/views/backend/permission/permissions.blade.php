@extends('backend.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="card col-lg-6 offset-lg-3">
            <h3 class="card-header">Danh sách các quyền</h3>
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
                <form class="input-group" method="post" action="{{route('permission.update_permissions')}}">
                    <input type="text" class="form-control" placeholder="Sửa tên quyền" aria-describedby="submit"
                    name="permissions_update" value="{{Session::get('name')}}">
                    <input type="hidden" class="form-control" name="id" value="{{Session::get('update')}}">
                    <button class="rounded btn btn-primary" type="submit" id="submit" name="submit">Sửa</button>
                    <a class="rounded btn btn-danger" href="/admin/permission/permissions">Huỷ</a>
                    @error('permissions_update')
                        <div class="alert alert-danger w-100">{{ $message }}</div>
                    @enderror
                    @csrf
                </form>
            @else
            <form class="input-group" method="post" action="{{route('permission.create_permissions')}}">
                <input type="text" class="form-control" placeholder="Thêm quyền" aria-describedby="submit" name="permissions">
                <button class="btn btn-outline-primary rounded" type="submit" id="submit" name="submit">Thêm</button>
                @error('permissions')
                    <div class="alert alert-danger w-100">{{ $message }}</div>
                @enderror
                @csrf
            </form>
            @endif
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Quyền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($permissions as $key => $p)
                            <tr>
                                <td>{{$p->name}}</td>
                                <td>
                                    @can("edit permissions-roles")
                                    <a href="{{route('permission.form_update_permissions',$p->id)}}" class="btn btn-primary">Sửa tên</a>
                                    @endcan
                                    @can("delete permissions-roles")
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xoá không?')" href="{{route('permission.delete_permissions',$p->id)}}" class="btn btn-danger">Xoá</a>
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
