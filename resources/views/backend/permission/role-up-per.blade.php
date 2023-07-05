@extends('backend.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="card col-lg-12">
            <h3 class="card-header">Các quyền của vai trò {{$name}}</h3>
            <div class="card-body">
                <div class="demo-inline-spacing mt-3">
                    <form class="list-group" method="post" action="{{route('permission.role_update_permissions_post')}}">
                        <input type="hidden" value="{{$name}}" name="name">
                        <div class="row">
                            <div class="col-lg-3">
                                <h6 class="bg-primary m-0 p-2 rounded-1">Book</h6>
                                @foreach ($book as $b)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="{{ $b->name }}" name="per[]"
                                        @foreach ($per as $p)
                                            @if ($b->name == $p)
                                                checked
                                            @endif
                                        @endforeach
                                        >
                                        {{$b->name}}
                                    </label>
                                @endforeach
                            </div>
                            <div class="col-lg-3">
                                <h6 class="bg-primary m-0 p-2 rounded-1">User</h6>
                                @foreach ($user as $u)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="{{ $u->name }}" name="per[]"
                                        @foreach ($per as $p)
                                            @if ($u->name == $p)
                                                checked
                                            @endif
                                        @endforeach
                                        >
                                        {{$u->name}}
                                    </label>
                                @endforeach
                            </div>
                            <div class="col-lg-3">
                                <h6 class="bg-primary m-0 p-2 rounded-1">Lend-return Book</h6>
                                @foreach ($lr as $l)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="{{ $l->name }}" name="per[]"
                                        @foreach ($per as $p)
                                            @if ($l->name == $p)
                                                checked
                                            @endif
                                        @endforeach
                                        >
                                        {{$l->name}}
                                    </label>
                                @endforeach
                            </div>
                            <div class="col-lg-3">
                                <h6 class="bg-primary m-0 p-2 rounded-1">Permission</h6>
                                @foreach ($pr as $pr)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="{{ $pr->name }}" name="per[]"
                                        @foreach ($per as $p)
                                            @if ($pr->name == $p)
                                                checked
                                            @endif
                                        @endforeach
                                        >
                                        {{$pr->name}}
                                    </label>
                                @endforeach
                            </div>
                            <div class="col-lg-3 mt-4">
                                <h6 class="bg-primary m-0 p-2 rounded-1">Statistic</h6>
                                @foreach ($statistic as $st)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="{{ $st->name }}" name="per[]"
                                        @foreach ($per as $p)
                                            @if ($st->name == $p)
                                                checked
                                            @endif
                                        @endforeach
                                        >
                                        {{$st->name}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <button class="btn btn-primary w-25 m-auto mt-4" type="submit" name="submit">Sửa</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
