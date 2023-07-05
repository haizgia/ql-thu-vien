@extends('backend.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h3>Cập nhập sách</h3>
    <form class="row" method="post" action="{{route('sach.update', $data->masach)}}" enctype="multipart/form-data">
        @method('PATCH')
        <div class="col-lg-6">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="ten">Tên sách</label>
                <div class="col-sm-10">
                    <input type="text" value="@if(old('ten')) {{old('ten')}} @else {{$data->ten}} @endif" class="form-control" id="ten" name="ten" />
                </div>
                @error('ten')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="mota">Mô tả sách</label>
                <div class="col-sm-10">
                    <textarea id="mota" name="mota" class="form-control">@if(old('mota')) {{old('mota')}} @else {{$data->mota}} @endif</textarea>
                </div>
                @error('mota')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mb-3">
                <label for="index" class="col-md-2 col-form-label">Chỉ mục</label>
                <div class="col-md-10">
                    <input class="form-control" value="@if(old('index')){{old('index')}}@else{{$data->index}}@endif" type="number" id="index"  name="index" min="0"/>
                </div>
                @error('index')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="mavt" class="form-label">Chọn vị trí</label>
                <select class="form-select" id="mavt" name="mavt">
                    @foreach ($vt as $item)
                        <option
                            @if ($data->mavt == $item->mavt)
                                {{"selected"}}
                            @endif
                            value="@if(old('mavt')) {{old('mavt')}} @else {{$item->mavt}} @endif">{{$item->tenvt}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="maloai" class="form-label">Chọn loại sách</label>
                <select class="form-select" id="maloai" name="maloai">
                    @foreach ($loai as $item)
                        <option
                        @if ($data->maloai == $item->maloai)
                            {{"selected"}}
                        @endif
                        value="@if(old('maloai')) {{old('maloai')}} @else {{$item->maloai}} @endif">{{$item->tenloai}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="hinhanh" class="form-label">Chọn hình ảnh</label>
                <input class="form-control" type="file" id="hinhanh" name="hinhanh"/>
                <input type="hidden" name="hinhanhcu" value="@if(old('hinhanhcu')){{old('hinhanhcu')}}@else{{$data->hinhanh}}@endif">
                <img src="/img/{{$data->hinhanh}}" width="100" alt="">
                @error('hinhanh')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="tacgia">Tác giả</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tacgia" name="tacgia" value="@if(old('tacgia')) {{old('tacgia')}} @else {{$data->tacgia}} @endif" />
                </div>
                @error('tacgia')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="nxb">Nhà xuất bản</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nxb" name="nxb" value="@if(old('nxb')) {{old('nxb')}} @else {{$data->nxb}} @endif" />
                </div>
                @error('nxb')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div class="row mb-3">
                <label for="soluong" class="col-md-2 col-form-label">Số lượng sách</label>
                <div class="col-md-10">
                    <input min="0" class="form-control" type="number" id="soluong" name="soluong" value="@if(old('soluong')){{old('soluong')}}@else{{$data->soluong}}@endif" />
                </div>
                @error('soluong')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="link-pdf" class="form-label">Link PDF</label>
                <textarea class="form-control" id="link-pdf" rows="4" name="link-pdf">
                    @if(old('link-pdf')){{old('link-pdf')}}@else{{$data['link-pdf']}}@endif
                </textarea>
            </div>
            <p class="col-form-label mt-3">Hiển thị</p>
            <div class="form-check d-inline-block">
                <input class="form-check-input" type="radio" value="true" name="display" checked id="true" />
                <label class="form-check-label" for="true"> Hiện </label>
            </div>
            <div class="form-check d-inline-block">
                <input class="form-check-input" type="radio" value="false" name="display" id="false" />
                <label class="form-check-label" for="false"> Ẩn </label>
            </div>

            <p class="col-form-label mt-3">Tình trạng</p>
            <div class="form-check d-inline-block">
                <input class="form-check-input" type="radio" value="1" name="tinhtrang" id="1"
                @if ($data->tinhtrang == 1)
                            {{"checked"}}
                @endif/>
                <label class="form-check-label" for="1"> Được mượn về </label>
            </div>
            <div class="form-check d-inline-block">
                <input class="form-check-input" type="radio" value="2" name="tinhtrang" id="2"
                @if ($data->tinhtrang == 2)
                            {{"checked"}}
                @endif/>
                <label class="form-check-label" for="2"> Đọc tại chỗ </label>
            </div>
            {{-- <div class="form-check d-inline-block">
                <input class="form-check-input" type="radio" value="0" name="tinhtrang" id="0"
                @if ($data->tinhtrang == 3)
                            {{"checked"}}
                @endif/>
                <label class="form-check-label" for="0"> Hết sách </label>
            </div> --}}
            <div class="mb-3 mt-2">
                <label for="manganh" class="form-label">Chọn ngành</label>
                <select class="form-select" name="manganh">
                    @foreach ($nganh as $item)
                        <option
                        @if ($item->manganh == $data['manganh'])
                            {{"selected"}}
                        @endif
                        value="{{$item->manganh}}">{{$item->tennganh}}</option>
                    @endforeach
                </select>
                @error('manganh')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary" style="float: right;">Send</button>
            </div>
        </div>
        @csrf
    </form>
</div>
@endsection
@section('js')
    <script>
        $('#mota').summernote({
            placeholder: 'Nhập mô tả sách',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endsection
