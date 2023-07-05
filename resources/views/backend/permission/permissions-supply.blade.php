@extends('backend.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="card col-lg-10 offset-lg-1">
            <h3 class="card-header">Cấp quyền</h3>

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

            <form class="card-body" method="post" action="{{route('permission.supply_permissions_post')}}">
                <input type="hidden" name="type" value="{{$type}}">
                <div class="row">
                    <div class="col-lg-6">Mã số: {{$data['mssv']}}</div>
                    <div class="col-lg-6">Họ tên: {{$data['hoten']}}</div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-3">
                        <h6 class="bg-primary m-0 p-2 rounded-1">Book</h6>
                        @foreach ($book as $p)
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="hidden" name="id" value="{{$data['mssv']}}">
                                <input class="form-check-input" type="checkbox" name="permissions[]" id="{{$p->id}}" value="{{$p->name}}"
                                @foreach ($permissionsOfuser as $pu)
                                    @if ($p->name == $pu->name)
                                        checked disabled
                                    @endif
                                @endforeach
                                @foreach ($getDirectPermissions as $pd)
                                    @if ($p->name == $pd->name)
                                        checked
                                    @endif
                                @endforeach
                                @if (!auth()->user()->hasRole('Super-Admin'))
                                    @foreach ($arr as $a)
                                        @if ($a == $p->name)
                                        disabled
                                        @endif
                                    @endforeach
                                @endif
                                >
                                <label class="form-check-label" for="{{$p->id}}">{{$p->name}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-3">
                        <h6 class="bg-primary m-0 p-2 rounded-1">User</h6>
                        @foreach ($user as $p)
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="hidden" name="id" value="{{$data['mssv']}}">
                                <input class="form-check-input" type="checkbox" name="permissions[]" id="{{$p->id}}" value="{{$p->name}}"
                                @foreach ($permissionsOfuser as $pu)
                                    @if ($p->name == $pu->name)
                                        checked disabled
                                    @endif
                                @endforeach
                                @foreach ($getDirectPermissions as $pd)
                                    @if ($p->name == $pd->name)
                                        checked
                                    @endif
                                @endforeach
                                @if (!auth()->user()->hasRole('Super-Admin'))
                                    @foreach ($arr as $a)
                                        @if ($a == $p->name)
                                        disabled
                                        @endif
                                    @endforeach
                                @endif
                                >
                                <label class="form-check-label" for="{{$p->id}}">{{$p->name}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-3">
                        <h6 class="bg-primary m-0 p-2 rounded-1">Lend-return Book</h6>
                        @foreach ($lr as $p)
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="hidden" name="id" value="{{$data['mssv']}}">
                                <input class="form-check-input" type="checkbox" name="permissions[]" id="{{$p->id}}" value="{{$p->name}}"
                                @foreach ($permissionsOfuser as $pu)
                                    @if ($p->name == $pu->name)
                                        checked disabled
                                    @endif
                                @endforeach
                                @foreach ($getDirectPermissions as $pd)
                                    @if ($p->name == $pd->name)
                                        checked
                                    @endif
                                @endforeach
                                @if (!auth()->user()->hasRole('Super-Admin'))
                                    @foreach ($arr as $a)
                                        @if ($a == $p->name)
                                        disabled
                                        @endif
                                    @endforeach
                                @endif
                                >
                                <label class="form-check-label" for="{{$p->id}}">{{$p->name}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-3">
                        <h6 class="bg-primary m-0 p-2 rounded-1">Permission</h6>
                        @foreach ($pr as $p)
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="hidden" name="id" value="{{$data['mssv']}}">
                                <input class="form-check-input" type="checkbox" name="permissions[]" id="{{$p->id}}" value="{{$p->name}}"
                                @foreach ($permissionsOfuser as $pu)
                                    @if ($p->name == $pu->name)
                                        checked disabled
                                    @endif
                                @endforeach
                                @foreach ($getDirectPermissions as $pd)
                                    @if ($p->name == $pd->name)
                                        checked
                                    @endif
                                @endforeach
                                @if (!auth()->user()->hasRole('Super-Admin'))
                                    @foreach ($arr as $a)
                                        @if ($a == $p->name)
                                        disabled
                                        @endif
                                    @endforeach
                                @endif
                                >
                                <label class="form-check-label" for="{{$p->id}}">{{$p->name}}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-3 mt-4">
                        <h6 class="bg-primary m-0 p-2 rounded-1">Statistic</h6>
                        @foreach ($statistic as $p)
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="hidden" name="id" value="{{$data['mssv']}}">
                                <input class="form-check-input" type="checkbox" name="permissions[]" id="{{$p->id}}" value="{{$p->name}}"
                                @foreach ($permissionsOfuser as $pu)
                                    @if ($p->name == $pu->name)
                                        checked disabled
                                    @endif
                                @endforeach
                                @foreach ($getDirectPermissions as $pd)
                                    @if ($p->name == $pd->name)
                                        checked
                                    @endif
                                @endforeach
                                @if (!auth()->user()->hasRole('Super-Admin'))
                                    @foreach ($arr as $a)
                                        @if ($a == $p->name)
                                        disabled
                                        @endif
                                    @endforeach
                                @endif
                                >
                                <label class="form-check-label" for="{{$p->id}}">{{$p->name}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
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
