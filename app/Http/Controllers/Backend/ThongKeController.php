<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ThongKeController extends Controller
{
    //
    public function index()
    {
        $khoas = DB::table('khoas')->get();
        // dd($khoas);
        return view('backend.thongke.index', compact('khoas'));
    }

    public function result(Request $request)
    {
        $where = "";
        $groupby = "";
        $select = "COUNT(*)  as data";
        $title = "";
        $typeChart = "bar";
        $type = 1;
        $cols = array();

        switch ($request->khoa) {
            case 'all':
                break;
            default:
                $where .= " and k.makhoa =".$request->khoa;
                break;
        }

        switch ($request->type) {
            case 'day':
                $request->from == $request->to ? $where .= " and m.ngaymuon = '$request->to'" :
                $where .= " and m.ngaymuon >= '$request->from' and m.ngaymuon <= '$request->to' ";
                $groupby = "m.ngaymuon";
                $select .= ", m.ngaymuon  as labels";
                break;
            case 'month':
                $from = explode ( "-" , $request->from);
                $to = explode ( "-" , $request->to);
                $request->from == $request->to ? $where .= " and month(m.ngaymuon) = ".$to[1]." and year(m.ngaymuon) = ".$to[0] :
                $where .= " and month(m.ngaymuon) >= ".$from[1]." and year(m.ngaymuon) >= ".$from[0]." and month(m.ngaymuon) <= ".$to[1]." and year(m.ngaymuon) <= ".$to[0];
                $groupby = "m.ngaymuon, year(m.ngaymuon), month(m.ngaymuon)";
                $select .= ", CONCAT(month(m.ngaymuon),'-', year(m.ngaymuon)) as labels";
                break;
            case 'year':
                $request->from == $request->to ? $where .= " and year(m.ngaymuon) = ".$request->to :
                $where .= " and year(m.ngaymuon) >= ".$request->from." and year(m.ngaymuon) <= ".$request->to;
                $groupby = "year(m.ngaymuon)";
                $select .= ", year(m.ngaymuon)  as labels";
                break;
            default:
                break;
        }

// chỉnh group by
        switch ($request->typestatistic) {
            case 'totaluserlendbook':
                $query = "SELECT $select
                FROM muontras m, lops l, nganhs n, khoas k, sinhviens s
                WHERE m.mssv = s.mssv AND l.malop = s.malop AND n.manganh=l.manganh AND k.makhoa=n.makhoa $where
                GROUP BY $groupby";
                $title = "Tổng số sinh viên mượn sách từ $request->from đến $request->to";
                array_push($cols, "Thời gian", "Tổng số");
                break;
            case 'totalborrowedbooks':
                $query = "SELECT $select
                FROM muontras m, nganhs n, khoas k, saches s
                WHERE m.masach = s.masach AND s.manganh = n.manganh AND k.makhoa=n.makhoa $where
                GROUP BY $groupby";
                $title = "Tổng số sách được mượn từ $request->from đến $request->to";
                array_push($cols, "Thời gian", "Tổng số");
                break;
            case 'totallosedbook':
                $query = "SELECT $select
                FROM muontras m, nganhs n, khoas k, saches s
                WHERE m.masach = s.masach AND s.manganh = n.manganh AND m.trangthai =11 AND k.makhoa=n.makhoa $where
                GROUP BY $groupby";
                $title = "Tổng số sách bị mất từ $request->from đến $request->to";
                array_push($cols, "Thời gian", "Tổng số");
                break;
            case 'mostborrowedbooks':
                $query = "SELECT s.masach, c.ten as labels, COUNT(*)  as data
                FROM muontras m, nganhs n, khoas k, saches s, chitietsaches c
                WHERE m.masach = s.masach AND c.masach = s.masach AND s.manganh = n.manganh AND k.makhoa=n.makhoa $where
                GROUP BY s.masach, c.ten order by data desc";
                $typeChart = "doughnut";
                $type = 2;
                $title = "Sách được mượn nhiều nhất từ $request->from đến $request->to";
                array_push($cols, "Mã sách", "Tên sách", "Tổng số lượt mượn");
                break;

            default:
                $query = "";
                break;
        }

        if (strpos(url()->current(), '/ket-qua-bieu-do')) {
            $dataQuery = DB::select($query);
            $data = array();
            if ($request->type == 'day' && $request->typestatistic != 'mostborrowedbooks') {
                foreach ($dataQuery as $item ) {
                    $label = Carbon::parse($item->labels)->format('d-m-Y');
                    $data["$label"] = $item->data;
                }
            }else {
                foreach ($dataQuery as $item ) {
                    $data["$item->labels"] = $item->data;
                }
            }
            // dd($data, $dataQuery);

            return view('backend.thongke.result', compact('typeChart', 'data', 'title'));
        }
        $data = DB::select($query);
        // dd($data);
        if ($request->download) {
            // dd($request->download);
            Pdf::setOption(['defaultFont' => 'Dejavu Sans']);
            $pdf = Pdf::loadView('backend.thongke.pdf', [
                'type' => $type,
                'cols' => $cols,
                'data' => $data,
                'title' => $title
            ]);
            // return $pdf->stream();
            return $pdf->download('thongke.pdf');
        }

        return view('backend.thongke.result2', compact('type', 'data', 'title', 'cols'));
    }
}
