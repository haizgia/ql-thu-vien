@extends('backend.layout.main')

@section('content')
<div>
    <div class="mt-5 ms-5">
        <a class="btn btn-primary" href="{{ route('thongke.index')}}">Trở về</a>
    </div>
        @if (count($data) == 0)
            <h3 class="m-5">Không có dữ liệu phù hợp</h3>
        @else
            <div class="m-5">
                <canvas id="myChart"></canvas>
            </div>
            @can('export statistic')
                <button class="btn btn-primary m-auto float-end me-5" onclick="downloadPDF()">Download</button>
            @endcan

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://parall.ax/parallax/js/jspdf.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
            <script>
                const ctx = document.getElementById('myChart');
                const title = @json($title);
                const data = @json($data);
                const typeChart = @json($typeChart);
                var labels = Object.keys(data);
                var values = Object.values(data);
                // console.log(labels, values);
                // window.jsPDF = window.jspdf.jsPDF;
                const bgColor = {
                    id: 'bgColor',
                    beforeDraw: (chart, options) => {
                        const {ctx, width, height} = chart
                        ctx.fillStyle = 'white'
                        ctx.fillRect(0,0,width,height)
                        ctx.restore()
                    }
                }
                new Chart(ctx, {
                    type: typeChart,
                    data: {
                        labels: labels,
                        datasets: [{
                            label: title,
                            data: values,
                            borderWidth: 1,
                            maxBarThickness: 32,
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                    plugins: [bgColor]
                });

                function downloadPDF() {
                    console.log("vo");
                    const canvasImage = ctx.toDataURL('image/jpeg', 1.0)
                    let pdf = new jsPDF();
                    pdf.setFontSize(20)
                    pdf.addImage(canvasImage, 'JPEG', 15,15,185,150)
                    pdf.save("mychart.pdf")
                }
            </script>
        @endif
</div>
@endsection
