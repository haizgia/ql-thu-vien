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
        <form class="card p-4 col-lg-6 mb-4 offset-lg-3" method="POST" action="">
            <h3>Hình thức vi phạm</h3>
            <div class="row">
                <div class="col-lg-6">Mã số phiếu:</div>
                <div class="col-lg-6">{{$data['maphieu']}}</div>
            </div>
            <div class="row">
                <div class="col-lg-6">Mã sinh viên:</div>
                <div class="col-lg-6">{{$data['mssv']}}</div>
            </div>
            <div class="row">
                <div class="col-lg-6">Mã sách:</div>
                <div class="col-lg-6">{{$data['masach']}}</div>
            </div>
            <div class="mb-3">
                <label for="ndvipham" class="form-label">Nội dung vi phạm</label>
                <textarea class="form-control" id="ndvipham" name="ndvipham" rows="2"></textarea>
            </div>
            <div class="mb-3">
                <label for="htxuphat" class="form-label">Hình thức xử phạt</label>
                <textarea class="form-control" id="htxuphat" name="htxuphat" rows="2"></textarea>
            </div>
            <div class="mb-3">
                <label for="trangthai" class="form-label">Trạng thái</label>
                <select id="trangthai" name="trangthai" class="form-select">
                  <option value="9">Chưa giải quyết</option>
                  <option value="10">Đã giải quyết</option>
                </select>
              </div>
            <button class="btn btn-primary" type="submit" style="float: right">Submit</button>
            @csrf
        </form>
    </div>
</div>
@endsection
