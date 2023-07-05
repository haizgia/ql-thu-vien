@extends('backend.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
        {{Session::get('error')}}
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
        {{Session::get('success')}}
        </div>
    @endif
    {{-- @if (isset($errors) && $errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            {{$error}}
        @endforeach
        </div>
    @endif --}}
    <h3>Thêm sinh viên</h3>
    <form class="row" method="post" action="{{route('sv.store')}}" enctype="multipart/form-data">
        <div class="col-lg-6">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="mssv">Mã số sinh viên</label>
                <div class="col-sm-9">
                    <input type="text" value="{{old('mssv')}}" class="form-control" id="mssv" name="mssv" />
                </div>
                @error('mssv')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="ngaysinh">Ngày sinh</label>
                <div class="col-sm-9">
                    <input type="date" value="{{old('ngaysinh')}}" class="form-control" id="ngaysinh" name="ngaysinh" />
                </div>
                @error('ngaysinh')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mb-3">
                <label for="sdt" class="col-md-3 col-form-label">Số điện thoại</label>
                <div class="col-md-9">
                    <input class="form-control" value="{{old('sdt')}}" type="text" id="sdt"  name="sdt" />
                </div>
                @error('sdt')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="malop" class="form-label">Chọn Lớp</label>
                <select class="form-select" id="malop" name="malop">
                    @foreach ($lop as $item)
                        <option
                            @if (old('malop') == $item->malop)
                                {{"selected"}}
                            @endif
                            value="{{$item->malop}}">{{$item->tenlop}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="ten">Tên sinh viên</label>
                <div class="col-sm-9">
                    <input type="text" value="{{old('ten')}}" class="form-control" id="ten" name="ten" />
                </div>
                @error('ten')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="diachi">Địa chỉ</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="diachi" name="diachi" value="{{old('diachi')}}" />
                </div>
                @error('diachi')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mb-3">
                <label for="ngaynhaphoc" class="col-md-3 col-form-label">Ngày nhập học</label>
                <div class="col-md-9">
                    <input class="form-control" type="date" id="ngaynhaphoc" name="ngaynhaphoc" value="{{old('ngaynhaphoc')}}" />
                </div>
                @error('ngaynhaphoc')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <p class="col-md-3 col-form-label">Giới tính</p>
            <div class="form-check d-inline-block">
                <input class="form-check-input" type="radio" value="0" name="gioitinh" checked id="nam" />
                <label class="form-check-label" for="nam"> Nam </label>
            </div>
            <div class="form-check d-inline-block">
                <input class="form-check-input" type="radio" value="1" name="gioitinh" id="nu" />
                <label class="form-check-label" for="nu"> Nữ </label>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary" style="float: right;">Send</button>
            </div>
        </div>
        @csrf
    </form>
    <form action="{{route('sv.import')}}" method="POST" enctype="multipart/form-data" class="row">
        @csrf
        <div class="col-lg-6">
            <label for="user_file" class="form-label">Thêm sinh viên bằng file excel</label>
            <input id="user-file" type="file" name="user_file" accept=".xlsx, .xls, .csv, .ods" class="form-control">
            @error('user_file')
                <div class="text-danger" role="alert">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-info mt-4">Import</button>
        </div>
    </form>
    @if (session()->has('failures'))
        <table class="table table-danger mt-4">
            <tr>
                <td>Row</td>
                <td>Attribute</td>
                <td>Errors</td>
                <td>Value</td>
            </tr>
            @foreach (session()->get('failures') as $val)
                <tr>
                    <td>{{ $val->row() }}</td>
                    <td>{{ $val->attribute() }}</td>
                    <td>
                        <ul>
                            @foreach ($val->errors() as $e)
                                <li>
                                    {{$e}}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $val->values()[$val->attribute()] }}</td>
                </tr>
            @endforeach
        </table>
    @endif
</div>
@endsection
