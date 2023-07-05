@extends('backend.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <form class="col-lg-6 offset-lg-3 bg-light py-5" method="POST" action="">
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
            <h3 class="text-center">Phiếu Mượn Sách</h3>
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
                <label class="col-sm-3 col-form-label" for="masach">Mã số sách</label>
                <div class="col-sm-9">
                    <input type="text" value="{{old('masach')}}" class="form-control" id="masach" name="masach" />
                </div>
                @error('masach')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-primary" style="float: right;">Mượn sách</button>
            @csrf
        </form>
    </div>
</div>
@endsection
