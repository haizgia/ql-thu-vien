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
        <h3>Sửa thông tin mượn</h3>
        <form class="col-lg-6 mb-4" method="POST" action="">

            <button class="btn btn-primary" type="submit" style="float: right">Tìm</button>
            @csrf
        </form>
    </div>
</div>
@endsection
