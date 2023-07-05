@extends('backend.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
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
        <h3>Gia hạn thời gian trả sách</h3>
        <form class="col-lg-6 my-4" method="POST" action="">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="maphieu">Mã số phiếu</label>
                <div class="col-sm-9">
                    <input type="hidden" value="{{old('maphieu') ? old('maphieu'):$data['maphieu']}}" class="form-control" id="maphieu" name="maphieu" />
                    <input type="text" value="{{old('maphieu') ? old('maphieu'):$data['maphieu']}}" class="form-control" disabled />
                </div>
            </div>
            <div class="mb-3">
                <label for="reneweltime" class="form-label">Thời gian gia hạn</label>
                <select id="reneweltime" class="form-select" name="reneweltime">
                  <option value="1">Một ngày</option>
                  <option value="3">Ba ngày</option>
                  <option value="7">Một tuần</option>
                </select>
              </div>
            <button class="btn btn-primary" type="submit" style="float: right">Gia hạn</button>
            @csrf
        </form>
    </div>
</div>
@endsection
