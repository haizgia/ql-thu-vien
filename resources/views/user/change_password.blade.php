@extends('fontend.layout.main')

@section('content')
@if (Session::has('error'))
    <script>
        alert("{{Session::get('error')}}")
    </script>
@endif
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h2 class="mb-0">Thay đổi mật khẩu</h2>
            </div>
        </div>
    </div>
</header>
<div class="container mb-5">
    <div class="row">
        <div class="col-lg-6 offset-lg-3 bg-light py-5 rounded">
            <form method="post" action="">
                <div class="form-floating">
                    <input type="password" name="oldpass" id="oldpass" class="form-control" placeholder="Mật khẩu cũ">

                    <label for="floatingInput">Mật khẩu cũ</label>
                    @error('oldpass')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mt-2">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu mới">

                    <label for="floatingInput">Mật khẩu Mới</label>
                    @error('password')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mt-2">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu">

                    <label for="floatingInput">Xác nhận mật khẩu</label>
                    @error('password_confirmation')
                    <div class="text-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary float-end mt-4">Submit</button>
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
