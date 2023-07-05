@extends('backend.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="card col-lg-8 offset-lg-2">
            <h3 class="card-header">Cấp vai trò</h3>

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

            <form class="card-body" method="post" action="{{route('permission.supply_role_post')}}">
                <input type="hidden" name="type" value="{{$type}}">
                <div class="row">
                    <div class="col-lg-6">Mã số: {{$data['mssv']}}</div>
                    <div class="col-lg-6">Họ tên: {{$data['hoten']}}</div>
                </div>
                @foreach ($role as $r)
                    <div class="form-check form-check-inline mt-3">
                        <input class="form-check-input" type="hidden" name="id" value="{{$data['mssv']}}">
                        <input class="form-check-input" type="radio" name="role" id="{{$r->id}}" value="{{$r->name}}"
                        @if ($r->name == $roleOfuser)
                            checked
                        @endif
                        >
                        <label class="form-check-label" for="{{$r->id}}">{{$r->name}}</label>
                    </div>
                @endforeach
                @error('role')
                    <div class="alert alert-danger w-100">{{ $message }}</div>
                @enderror
                <br>
                <div class="d-flex mt-4">
                    <a href="{{route('permission.supply_role_and_permissions')}}" class="btn btn-primary">Back</a>
                    <button class="btn btn-primary ms-auto" type="submit" name="submit">Submit</button>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
