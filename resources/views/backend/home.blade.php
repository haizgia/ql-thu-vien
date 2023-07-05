@extends('backend.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <h3>Thống kê</h3>
        <div class="col-lg-4">
            <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">Tổng số Độc giả</h5>
                  <p class="card-text">{{ $users }}</p>
                  <a href="{{ route('sv.index')}}" class="btn btn-primary">Xem danh sách</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">Tổng số sách</h5>
                  <p class="card-text">{{ $books }}</p>
                  <a href="{{ route('sach.index')}}" class="btn btn-primary">Xem danh sách</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">Tổng số sách đang mượn</h5>
                  <p class="card-text">{{ $lending }}</p>
                  <a href="{{ route('mt.list_lending')}}" class="btn btn-primary">Xem danh sách</a>
                </div>
            </div>
        </div>
        {{-- <a href="javascript:void(0)" class="btn btn-primary w-25 m-auto">Xem thêm</a> --}}
    </div>
    <div class="row">
        <h3>Tìm kiếm</h3>
        <div class="col-lg-6">
            <form class="card mb-3" action="{{ route('sach.index')}}">
                <div class="card-body">
                  <h5 class="card-title">Tìm sách</h5>
                  <p class="card-text">
                      <input type="search" id="masach" name="masach" class="form-control" placeholder="Nhập mã sách">
                  </p>
                  <button type="submit" class="btn btn-primary">Tìm</button>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <form class="card mb-3" action="{{ route('sv.index')}}">
                <div class="card-body">
                  <h5 class="card-title">Tìm sinh viên</h5>
                  <p class="card-text">
                      <input type="search" id="mssv" name="mssv" class="form-control" placeholder="Nhập mã sinh viên">
                  </p>
                  <button type="submit" class="btn btn-primary">Tìm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
