@extends('backend.layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <form class="row" action="" id="form-statistic">
        <h3>Thống kê</h3>
        <div class="col-lg-2">
            <label for="khoa" class="form-label">Chọn khoa</label>
            <select id="khoa" name="khoa" class="form-select">
              <option value="all">Tất cả</option>
              @if (isset($khoas) && count($khoas) > 0)
                @foreach ($khoas as $k)
                <option value="{{ $k->makhoa }}">{{ $k->tenkhoa }}</option>
                @endforeach
              @endif
            </select>
        </div>
        <div class="col-lg-2">
            <label for="type" class="form-label">Chọn thời gian</label>
            <select id="type" name="type" class="form-select">
                <option value="day">Ngày</option>
                <option value="month">Tháng</option>
                <option value="year">Năm</option>
            </select>
        </div>
        <div class="col-lg-4 row" id="show">
            <div class="col-lg-6">
                <label for="from" class="form-label">Từ</label>
                <input class="form-control" type="date" value="{{date('Y-m-d')}}" id="from" name="from">
            </div>
            <div class="col-lg-6">
                <label for="to" class="form-label">Đến</label>
                <input class="form-control" type="date" value="{{date('Y-m-d')}}" id="to" name="to">
            </div>
        </div>
        <div class="col-lg-4">
            <label for="typestatistic" class="form-label">Chọn thống kê</label>
            <select id="typestatistic" name="typestatistic" class="form-select">
                <option value="totaluserlendbook">Tổng số sinh viên mượn sách</option>
                <option value="totalborrowedbooks">Tổng số sách được mượn</option>
                <option value="totallosedbook">Tổng số sách bị mất</option>
                <option value="mostborrowedbooks">Sách được mượn nhiều nhất</option>
            </select>
        </div>
    </form>
    <div class="row">
        <div class="col-lg-12 d-flex flex-row-reverse">
            <a href="/admin/thong-ke/ket-qua-bieu-do" class="btn btn-primary mt-4 me-4" type="submit" id="btnsubmit">Thống kê theo biểu đồ</a>
            <a href="/admin/thong-ke/ket-qua-table" class="btn btn-primary mt-4 me-4" type="submit" id="btnsubmittable">Thống kê theo dạng bảng</a>
        </div>
    </div>
</div>

<script>
    var today = new Date();
    var month = today.getMonth() < 9 ? "0"+(today.getMonth()+1) : (today.getMonth()+1);
    var date = today.getDate() <= 9 ? "0"+today.getDate() : today.getDate();
    var datefull = today.getFullYear()+'-'+month+'-'+ date;

    const wrap = document.getElementById("show")

    document.getElementById("type").addEventListener("change", function(e) {
        switch (this.value) {
            case "month":
                wrap.innerHTML = textshow("month", `${today.getFullYear()}-${month}`);
                break;
            case "year":
                wrap.innerHTML = textshow("year", `${today.getFullYear()}`);
                break;
            case "day":
                wrap.innerHTML = textshow("date", `${datefull}`);
                break;

            default:
                break;
        }
    })

    function textshow(type, value) {
        return `
            <div class="col-lg-6">
                <label for="from" class="form-label">Từ</label>
                <input class="form-control" type="${type}" value="${value}" id="from" name="from">
            </div>
            <div class="col-lg-6">
                <label for="to" class="form-label">Đến</label>
                <input class="form-control" type="${type}" value="${value}" id="to" name="to">
            </div>
        `
    }

    $('#btnsubmit').click(function(ev) {
        ev.preventDefault();
        var href = $(this).attr('href');
        $('form#form-statistic').attr('action', href);
        $('form#form-statistic').submit();
    })
    $('#btnsubmittable').click(function(ev) {
        ev.preventDefault();
        var href = $(this).attr('href');
        $('form#form-statistic').attr('action', href);
        $('form#form-statistic').submit();
    })
</script>
@endsection

