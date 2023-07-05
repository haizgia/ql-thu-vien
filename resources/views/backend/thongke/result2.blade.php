@extends('backend.layout.main')

@section('content')
    <div class="container">
        <div class="mt-5">
            <a class="btn btn-primary" href="{{ route('thongke.index') }}">Trở về</a>
        </div>
        @if (count($data) == 0)
            <h3 class="m-5">Không có dữ liệu phù hợp</h3>
        @else
            <h5 class="text-center">{{ $title }}</h5>
            @if ($type == 1)
                <table id="myTable" class="table table-bordered mt-4 bg-light p-4 rounded">
                    <thead>
                        <tr>
                            @foreach ($cols as $c)
                            <th>{{$c}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    {{ $item->labels }}
                                </td>
                                <td>
                                    {{ $item->data }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @can('export statistic')
                    <a class="btn btn-primary m-auto float-end" href="{{ url()->full().'&download=true' }}">Download</a>
                @endcan
            @else
                <table id="myTable" class="table table-bordered mt-4 bg-light p-4 rounded">
                    <thead>
                        <tr>
                            @foreach ($cols as $c)
                            <th>{{$c}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    {{ $item->masach }}
                                </td>
                                <td>
                                    {{ $item->labels }}
                                </td>
                                <td>
                                    {{ $item->data }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @can('export statistic')
                    <a class="btn btn-primary m-auto float-end" href="{{ url()->full().'&download=true' }}">Download</a>
                @endcan
            @endif
        @endif
    </div>
@endsection
