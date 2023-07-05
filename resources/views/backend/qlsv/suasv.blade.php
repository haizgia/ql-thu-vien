@extends('backend.layout.main')

@section('content')
@if ($data)
    <div class="container-xxl flex-grow-1 container-p-y">
        <h3>Chỉnh sửa thông tin sinh viên</h3>
        <form class="row" method="post" action="{{route('sv.update', $data->mssv)}}" enctype="multipart/form-data">
            <div class="col-lg-6">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="msv">Mã số sinh viên</label>
                    <div class="col-sm-9">
                        <input type="text" value="@if(old('msv')) {{old('msv')}} @else {{$data->mssv}} @endif"
                        class="form-control" id="msv" name="msv" disabled/>
                    </div>
                    @error('msv')
                        <div class="text-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="ngaysinh">Ngày sinh</label>
                    <div class="col-sm-9">
                        <input type="date" value="@if(old('ngaysinh')){{old('ngaysinh')}}@else{{$data->ngaysinh}}@endif"
                        class="form-control" id="ngaysinh" name="ngaysinh" />
                    </div>
                    @error('ngaysinh')
                        <div class="text-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row mb-3">
                    <label for="sdt" class="col-md-3 col-form-label">Số điện thoại</label>
                    <div class="col-md-9">
                        <input class="form-control" value="@if(old('sdt')){{old('sdt')}}@else{{$data->sdt}}@endif"
                        type="number" id="sdt"  name="sdt" />
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
                                @if ($data->malop == $item->malop)
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
                        <input type="text" value="@if(old('ten')) {{old('ten')}} @else {{$data->hoten}} @endif"
                        class="form-control" id="ten" name="ten" />
                    </div>
                    @error('ten')
                        <div class="text-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="diachi">Địa chỉ</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="diachi" name="diachi"
                        value="@if(old('diachi')) {{old('diachi')}} @else {{$data->diachi}} @endif" />
                    </div>
                    @error('diachi')
                        <div class="text-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row mb-3">
                    <label for="ngaynhaphoc" class="col-md-3 col-form-label">Ngày nhập học</label>
                    <div class="col-md-9">
                        <input class="form-control" type="date" id="ngaynhaphoc" name="ngaynhaphoc"
                        value="@if(old('ngaynhaphoc')){{old('ngaynhaphoc')}}@else{{$ngaynhaphoc}}@endif" />
                    </div>
                    @error('ngaynhaphoc')
                        <div class="text-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <p class="col-md-3 col-form-label">Giới tính</p>
                <div class="form-check d-inline-block">
                    <input class="form-check-input" type="radio" value="0" name="gioitinh" id="nam" @if($data->gioitinh == 0) checked @endif>
                    <label class="form-check-label" for="nam"> Nam </label>
                </div>
                <div class="form-check d-inline-block">
                    <input class="form-check-input" type="radio" value="1" name="gioitinh" id="nu" @if($data->gioitinh == 1) checked @endif/>
                    <label class="form-check-label" for="nu"> Nữ </label>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary" style="float: right;">Send</button>
                </div>
            </div>
            @csrf
            @method('PATCH')
        </form>
    </div>
@endif
@endsection
