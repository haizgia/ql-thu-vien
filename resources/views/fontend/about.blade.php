@extends('fontend.layout.main')

@section('content')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h2 class="mb-0">Giới thiệu</h2>
            </div>
        </div>
    </div>
</header>
<div class="container mb-5">
    <div class="row">
        <div class="col-lg-6">
            <img src="/front2/images/Library-stacks-700px.jpg" class="w-100 rounded" alt="">
        </div>
        <div class="col-lg-6">
            <p>Thư viện Cao đẳng Công nghệ thông tin Tp.HCM đặt tại tầng 5 khu B</p>
            <p>Với thiết kế ......</p>
        </div>
        <div class="col-lg-12 mt-4 col-md-12 mb-4 img-fluid " style="color:#000000">
            <p style=" font-weight:bold">1. Chức năng:</p>
            <p>•	Thư viện có chức năng quản lý và khai thác vốn tư liệu phục vụ hoạt động đào tạo và NCKH của Trường.</p>
            <p style=" font-weight:bold">2. Nhiệm vụ:</p>
            <p>•	Quản lý hoạt động của thư viện, xây dựng kế hoạch phát triển, bổ sung, trao đổi các loại hình tài tiệu.</p>
            <p>•	Tạo điều kiện cho CB-GV-NV, SVHS Trường khai thác</p>
            <p>•	Thu nhận các ấn phẩm do Trường xuất bản.</p>
            <p>•	Xây dựng hệ thống tra cứu tìm tin</p>
            <p>•	Hướng dẫn cho bạn đọc khai thác hiệu quả tài nguyên thông tin khoa học.</p>
            <p>•	Tham gia các hoạt động về nghiệp vụ với hệ thống Thư viện cả nước.</p>
            <p style=" font-weight:bold">3. Thành tựu: </p>
            <p>•	Tổ chức: có 06 cán bộ có trình độ chuyên môn và đội ngũ sinh viên tham gia công tác thư viện.</p>
            <p>•	Cơ sở vật chất, thiết bị và hạ tầng thông tin được trang bị đồng bộ, phù hợp các giải pháp hiện đại.</p>
            <p>•	Hệ thống các phòng chức năng như phòng đọc, phòng máy chiếu, phòng giảng viên và kho sách được kết nối liên hoàn. </p>
            <p>•	Hệ thống Wifi phủ sóng khắp khuôn viên trường.</p>
            <p>•	Tài nguyên thông tin:</p>
            <p>o	Sách và giáo trình: 45.000 cuốn.</p>
            <p>o	Sách điện tử: 70.000 cuốn.</p>
            <p>o	Luận văn, luận án: 8.000 cuốn.</p>
            <p>o	Đề tài nghiên cứu khoa học: 450 nhan đề.</p>
            <p>o	Báo, tạp chí tiếng Việt: 100 loại.</p>
            <p>o	3 cơ sở dữ liệu trực tuyến (Proquest,Pringer link, IEEE) và các cơ sở liệu khác</p>
            <p>o	Hệ thống cơ sở dữ liệu Liên Kết Nguồn Lực Thông Tin TP.HCM: <a href="http://www.stinet.gov.vn">http://www.stinet.gov.vn</a></p>
            <p class="mb-5 text-center">
                <img src="../Image/post/lien ket.png" alt="Image" class="img-fluid">
            </p>
            <p>Những sản phẩm thông tin thư viện</p>
            <p>o	Thông báo sách mới;</p>
            <p>o	Những bài trích báo, tạp chí chuyên ngành mới nhất;</p>
            <p>o	Những bộ sưu tập tài liệu chuyên ngành (bao gồm toàn văn);</p>
            <p>o	Giáo trình, bài giảng điện tử;</p>
            <p>o	Tài liệu đa phương tiện;</p>
            <p>o	Cổng thông tin điện tử Thư viện: <a href="http://lib.hutech.edu.vn">http://lib.hutech.edu.vn</a></p>
            <p>o	Facebook: http://www.facebook.com/libhutech</p>
            <p>o	App Libhutech trên Store Apple và Google Play</p>
            <p style=" font-weight:bold">4. Các chuẩn nghiệp vụ:</p>
            <p>•	Sử dụng bảng phân loại Dewey 23;</p>
            <p>•	Khổ mẫu biên mục MARC21;</p>
            <p>•	Quy tắc mô tả tài liệu AACR2;</p>
            <p>•	Phần mềm quản lý thư viện điện tử Library Information Systems.</p>
            <p style=" font-weight:bold">5. Đối tượng phục vụ:</p>
            <p>•	Cán bộ, giảng viên;</p>
            <p>•	Học viên cao học, nghiên cứu sinh;</p>
            <p>•	Sinh viên, học sinh và người dùng các cơ sở đào tạo, nghiên cứu khác có nhu cầu sử dụng thư viện.</p>
            <p style=" font-weight:bold">6. Các dịch vụ thông tin và lịch hoạt động thư viện:</p>
            <p>•	Đọc tại chỗ, mượn về nhà;</p>
            <p>•	Sao chụp, in ấn  tài liệu, dịch vụ tham khảo;</p>
            <p>•	Tải tài liệu và đọc trực tuyến (bằng máy tính và thiết bị di động) </p>
            <p>	Lịch hoạt động:</p>
             <p>•	Cơ sở Điện Biên Phủ</p>
            <p>o	Thứ hai: Từ 9 giờ sáng đến 19 giờ</p>
            <p>o	Thứ ba đến thứ sáu: Từ 8 giờ sáng đến 19 giờ</p>
            <p>o	Thứ bảy: Từ 8 giờ sáng đến 11 giờ 30 phút</p>
            <p>o	Chủ nhật: Nghỉ</p>
            <p>•	Cơ sở khu Công nghệ cao</p>
            <p>o	Thứ hai đến thứ sáu: Từ 8 giờ sáng đến 16 giờ 15 phút</p>
            <p>o	Thứ bảy: Từ 8 giờ sáng đến 11 giờ 15 phút</p>
             <p>o	Chủ nhật: Nghỉ</p>
            <p style=" font-weight:bold">7. Quan hệ công tác:</p>
            <p>•	Thư viện  HUTECH là thành viên của Liên hiệp Thư viện đại học và cao đẳng khu vực phía Nam.</p>
            <p>•	Có quan hệ hợp tác với các cơ quan nghiên cứu, đào tạo và hoạt động trong lĩnh vực thông tin thư viện.</p>
            <p style=" font-weight:bold">8. Cơ cấu tổ chức và đội ngũ cán bộ</p>
            <p>•	Giám đốc thư viện:</p>
            <p>o	Ông. Hoàng Ngọc Tuấn</p>
            <p>•	Cán bộ nhân viên</p>
            <p>o	Bà Trần Thị Thu Nga, </p>
            <p>o	Ông Hoàng Ngọc Tỵ, </p>
            <p>o	Bà. Nguyễn Hạ Thư, </p>
            <p>o	Ông Châu Nguyễn Anh Quốc, </p>
            <p>o	Bà Hồ Thị Triều </p>
            <p>o	Và đội ngũ cộng tác viên là sinh viên đang học các ngành của nhà trường làm bán thời gian tại thư viện.</p>
            <p style=" font-weight:bold">9. Địa chỉ liên hệ:</p>
            <p><i class="fa fa-map-marker" style="font-size:20px"></i> 12 Trịnh Đình Thảo, phường Hòa Thạnh,
                quận Tân Phú, Thành phố Hồ Chí Minh</p>
            <p>•    Vị trí Thư viện: Tầng 5(Khu B)</p>
            <p> <i class="fa fa-phone" style="font-size:20px"></i> (028) 397 349 83 - (028) 386 050 03 <span class="icon-envelope-o mr-2"></span> tt.thuvien@itc.edu.vn</p>
        </div>
    </div>
</div>
@endsection
