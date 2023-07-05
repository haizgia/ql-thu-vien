{{-- <!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>Thư viện</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav m-auto p-4 p-lg-0">
            <a href="/" class="nav-item nav-link active">Trang chủ</a>
            <a href="/about" class="nav-item nav-link">Giới thiệu</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Tra cứu</a>
                <div class="dropdown-menu fade-down m-0">
                    <a href="{{route('search.ten')}}" class="dropdown-item">Tìm theo tên</a>
                    <a href="{{route('search.nganh')}}" class="dropdown-item">Tài liệu theo ngành</a>
                    <a href="{{route('search.danhmuc')}}" class="dropdown-item">Tài liệu theo danh mục</a>
                </div>
            </div>
            <a href="contact.html" class="nav-item nav-link">Chỉ dẫn</a>
            @if (Auth::check())
                <div class="nav-item dropdown m-auto">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class='fa fa-user'></i>
                    </a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="{{route('book.listLendBook')}}" class="dropdown-item">Đăng ký mượn</a>
                        <a href="{{route('book.lending')}}" class="dropdown-item">Đang mượn</a>
                        <a href="{{route('logout')}}" class="dropdown-item">Đăng xuất</a>
                    </div>
                </div>
            @endif
        </div>
        <div class="navbar-nav p-4 p-lg-0">
            @if (!Auth::check())
                <a href="{{route('login')}}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">
                    Đăng nhập<i class="fa fa-arrow-right ms-3"></i>
                </a>
            @endif
        </div>
    </div>
</nav>
<!-- Navbar End --> --}}

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand me-lg-5 me-0" href="{{route('home')}}">
            <img src="/front2/images/logo.png" class="logo-image img-fluid rounded-circle" alt="templatemo pod talk">
        </a>

        <form action="{{ route('search.tracuu') }}"
            method="get" class="custom-form search-form flex-fill me-3" role="search">
            <div class="input-group input-group-lg">
                <input name="key" type="text" class="form-control" id="key" name="key" placeholder="Tìm sách"
                    aria-label="Search">
                <input type="hidden" value="ten" name="timtheo">
                <input type="hidden" value="chitietsaches.created_at,desc" name="sapxep">
                <input type="hidden" value="6" name="hienthi">
                <button type="submit" class="form-control" id="submit" name="submit">
                    <i class="bi-search"></i>
                </button>
            </div>
        </form>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @php $url = 'http://127.0.0.1:8000' @endphp

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-lg-auto">
                <li class="nav-item">
                    <a class="nav-link @php echo url()->current() == $url ? 'active' : '';@endphp" href="{{route('home')}}">Trang chủ</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @php echo url()->current() == $url.'/about' ? 'active' : '';@endphp" href="{{route('about')}}">Giới thiệu</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @php echo url()->current() == $url.'/search/tracuu' ? 'active' : '';@endphp" href="{{route('search.tracuu')}}">Tra cứu</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='fa fa-user'></i>
                            {{ Auth::user()->id}}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                            <li>
                                <a href="{{route('book.listSave')}}" class="dropdown-item">Sách đã lưu</a>
                            </li>
                            <li>
                                <a href="{{route('book.listLendBook')}}" class="dropdown-item">Đăng ký mượn</a>
                            </li>
                            <li>
                                <a href="{{route('book.lending')}}" class="dropdown-item">Đang mượn</a>
                            </li>
                            <li>
                                <a href="{{route('change_password')}}" class="dropdown-item">Đổi mật khẩu</a>
                            </li>
                            <li>
                                <a href="{{route('logout')}}" class="dropdown-item">Đăng xuất</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            @if (!Auth::check())
                <div class="ms-4">
                    <a href="{{route('login')}}" class="btn custom-btn custom-border-btn smoothscroll">Đăng nhập</a>
                </div>
            @endif
        </div>
    </div>
</nav>
