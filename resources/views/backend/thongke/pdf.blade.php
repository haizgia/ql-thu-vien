<h3>{{ $title }}</h3>
@if (count($data) > 0)
    @if ($type == 1)
        <table class="table table-bordered mt-4 bg-light p-4 rounded">
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
    @else
        <table class="table table-bordered mt-4 bg-light p-4 rounded">
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
    @endif
@endif

<style>
    body {
        font-family:DejaVu Sans;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table td, table th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    table tr:nth-child(even){background-color: #f2f2f2;}

    table tr:hover {background-color: #ddd;}

    table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
</style>
