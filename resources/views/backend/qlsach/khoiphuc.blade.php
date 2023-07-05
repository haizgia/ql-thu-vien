@extends('backend.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
        {{Session::get('success')}}
        </div>
    @endif
    @if (Session::has('err'))
        <div class="alert alert-err" role="alert">
        {{Session::get('err')}}
        </div>
    @endif
    <h3>Tìm kiếm</h3>
    <div class="row mb-4">
        <form action="" class="col-lg-6">
            <div class="row">
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="masach" name="masach" placeholder="Tìm theo mã sách">
                </div>
                <div class="col-lg-4">
                    <button class="btn btn-primary" type="submit">Tìm</button>
                </div>
            </div>
        </form>
        <form class="col-lg-6">
            <div class="row">
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="ten" name="ten" placeholder="Tìm theo tên">
                </div>
                <div class="col-lg-4">
                    <button class="btn btn-primary" type="submit">Tìm</button>
                </div>
            </div>
        </form>
    </div>

    <h3>
        @if ($title)
            {{$title}}
        @endif
    </h3>
    @if (count($data) > 0)
    <form action="" method="post" id="form-multi">
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>Hình ảnh</th>
                <th>Mã sách</th>
                <th>Tên sách</th>
                <th>Ngành</th>
                <th>Vị trí</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data as $item)
                    <tr>
                        <td>
                            <input type="checkbox" name="ids[]" id="ids" value="{{$item->masach}}">
                        </td>
                        <td>
                            <a href="{{route('sach.detail', $item->masach)}}">
                                <img src="/img/{{$item->hinhanh}}" width="70" alt="">
                            </a>
                        </td>
                        <td>{{$item->masach}}</td>
                        <td>
                            <a href="{{route('sach.detail', $item->masach)}}">{{$item->ten}}</a>
                        </td>
                        <td>{{$item->tennganh}}</td>
                        <td>{{$item->tenvt}}</td>
                        <td>

                            <a href="{{route('sach.restore', $item->masach)}}" class="btn btn-primary">
                                Khôi phục <i class="menu-icon tf-icons bx bx-refresh"></i>
                            </a>
                            <a href="{{route('sach.destroy', $item->masach)}}" class="btn btn-danger" id='btndestroy'>
                                Xoá vĩnh viễn <i class="menu-icon tf-icons bx bx-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <td>
                {{$data->links('pagination::bootstrap-4')}}
            </td>
        </table>
        <a href="{{route('sach.destroy_multi')}}" class="btn btn-danger"
        type="submit" id="btn-destroy">Xoá vĩnh viễn</a>
        <a href="{{route('sach.restore_multi')}}" class="btn btn-info"
        type="submit" id="btn-restore">Khôi phục</a>
        @csrf
    </form>
        <form id="form-destroy" method="post">
            @csrf
            @method('DELETE')
        </form>
    @else
        <h6>Chưa có sách...</h6>
    @endif
</div>
@endsection
@section('js')
    <script>
        $('#btndestroy').click(function(ev) {
            ev.preventDefault();
            var href = $(this).attr('href');
            $('form#form-destroy').attr('action', href);
            if (confirm('Bạn có chắc chắn muốn xoá vĩnh viễn không?')) {
                $('form#form-destroy').submit();
            }
        })

        $('#btn-destroy').click(function(ev) {
            ev.preventDefault();
            var href = $(this).attr('href');
            $('form#form-multi').attr('action', href);
            if (confirm('Bạn có chắc chắn muốn xoá vĩnh viễn không?')) {
                $('form#form-multi').submit();
            }
        })

        $('#btn-restore').click(function(ev) {
            ev.preventDefault();
            var href = $(this).attr('href');
            $('form#form-multi').attr('action', href);
            if (confirm('Bạn có chắc chắn muốn khôi phục không?')) {
                $('form#form-multi').submit();
            }
        })
    </script>
@endsection
