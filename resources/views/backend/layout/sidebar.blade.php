<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <div class="logo text-center">
        <img src="/front2/images/logo.png" alt="" class="my-4">
        <p class="">Quản lý thư viện ITC</p>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @php $url = 'http://127.0.0.1:8000/admin' @endphp
      <!-- Dashboard -->
      <li class="menu-item @php echo url()->current() == "$url" ? 'active' : '';@endphp">
        <a href="/admin" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Trang chủ</div>
        </a>
      </li>

      <!-- Layouts -->
<!-- Quản lý mượn-trả sách -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Quản lý mượn - trả sách</span></li>
      <!-- Forms -->
      @can("read lend-return")
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-list-ul"></i>
          <div data-i18n="Form Elements">Danh sách</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item  @php echo url()->current() == $url.'/ql-mt/ds-dk-online' ? 'active' : '';@endphp">
            <a href="{{route('mt.list_online')}}" class="menu-link">
              <div data-i18n="Basic Inputs">Đăng ký mượn online</div>
            </a>
          </li>
          <li class="menu-item  @php echo url()->current() == $url.'/ql-mt/ds-muon' ? 'active' : '';@endphp">
            <a href="{{route('mt.list_lending')}}" class="menu-link">
              <div data-i18n="Input groups">Đang mượn</div>
            </a>
          </li>
          <li class="menu-item  @php echo url()->current() == $url.'/ql-mt/ds-qua-han-va-vi-pham' ? 'active' : '';@endphp">
            <a href="/admin/ql-mt/ds-qua-han-va-vi-pham" class="menu-link">
              <div data-i18n="Input groups">Quá hạn và vi phạm</div>
            </a>
          </li>
          {{-- <li class="menu-item  @php echo url()->current() == $url.'/ql-mt/ds-vi-pham' ? 'active' : '';@endphp">
            <a href="/admin/ql-mt/ds-vi-pham" class="menu-link">
              <div data-i18n="Input groups">Vi phạm</div>
            </a>
          </li> --}}
        </ul>
      </li>
      @endcan
      @can("create lend-return")
      <li class="menu-item  @php echo url()->current() == $url.'/ql-mt/muon-sach' ? 'active' : '';@endphp">
        <a href="/admin/ql-mt/muon-sach" class="menu-link">
          <i class="menu-icon tf-icons bx bx-book-heart"></i>
          <div data-i18n="Tables">Mượn sách</div>
        </a>
      </li>
      @endcan
      @can("edit lend-return")
      <li class="menu-item  @php echo url()->current() == $url.'/ql-mt/tra-sach' ? 'active' : '';@endphp">
        <a href="/admin/ql-mt/tra-sach" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-book-heart"></i>
          <div data-i18n="Tables">Trả sách</div>
        </a>
      </li>
      {{-- <li class="menu-item  @php echo url()->current() == $url.'/ql-mt/sua-thong-tin' ? 'active' : '';@endphp">
        <a href="/admin/ql-mt/sua-thong-tin" class="menu-link">
          <i class="menu-icon tf-icons bx bx-edit"></i>
          <div data-i18n="Tables">Sửa thông tin mượn sách</div>
        </a>
      </li> --}}
      @endcan
      {{-- Quản lý sách --}}
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Quản lý sách</span>
      </li>
      @can("read books")
        <li class="menu-item @php echo url()->current() == $url.'/ql-sach/danhsach' ? 'active' : '';@endphp">
            <a href="{{route('sach.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-list-ul"></i>
            <div data-i18n="Basic">Danh sách</div>
            </a>
        </li>
      @endcan
      @can("create books")
        <li class="menu-item  @php echo url()->current() == $url.'/ql-sach/them' ? 'active' : '';@endphp">
            <a href="{{route('sach.create')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-book-add"></i>
            <div data-i18n="Basic">Thêm</div>
            </a>
        </li>
      @endcan
      @can("delete books")
        <li class="menu-item  @php echo url()->current() == $url.'/ql-sach/delete' ? 'active' : '';@endphp">
            <a href="{{route('sach.deleteMulti')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-trash"></i>
            <div data-i18n="Basic">Xoá</div>
            </a>
        </li>
        <li class="menu-item  @php echo url()->current() == $url.'/ql-sach/restore' ? 'active' : '';@endphp">
            <a href="{{route('sach.restore')}}" class="menu-link">
            <i class='menu-icon tf-icons bx bx-refresh'></i>
            <div data-i18n="Basic">Khôi phục</div>
            </a>
        </li>
      @endcan
      <!-- Quản lý độc giả -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Quản lý độc giả</span></li>
      <!-- Cards -->
      @can("read users")
      <li class="menu-item  @php echo url()->current() == $url.'/ql-sv/danhsach' ? 'active' : '';@endphp">
        <a href="{{route('sv.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-list-ul"></i>
          <div data-i18n="Basic">Danh sách</div>
        </a>
      </li>
      @endcan
      @can("create users")
      <li class="menu-item  @php echo url()->current() == $url.'/ql-sv/them' ? 'active' : '';@endphp">
        <a href="{{route('sv.create')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-book-add"></i>
          <div data-i18n="Boxicons">Thêm</div>
        </a>
      </li>
      @endcan
      @can("delete users")
      <li class="menu-item  @php echo url()->current() == $url.'/ql-sv/delete' ? 'active' : '';@endphp">
        <a href="{{route('sv.deleteMulti')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-trash"></i>
          <div data-i18n="Boxicons">Xoá</div>
        </a>
      </li>
      @endcan
      {{-- <li class="menu-item  @php echo url()->current() == $url.'/ql-sach/danhsach' ? 'active' : '';@endphp">
        <a href="{{route('sv.restore')}}" class="menu-link">
          <i class='menu-icon tf-icons bx bx-refresh'></i>
          <div data-i18n="Basic">Khôi phục</div>
        </a>
      </li> --}}

      {{-- Phân quyền --}}
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Phân quyền</span></li>

        @can("read permissions-roles")
        <li class="menu-item  @php echo url()->current() == $url.'/permission/role' ? 'active' : '';@endphp">
            <a href="/admin/permission/role" class="menu-link">
            <i class="menu-icon tf-icons bx bx-book"></i>
            <div data-i18n="Basic">Vai trò</div>
            </a>
        </li>

        <li class="menu-item  @php echo url()->current() == $url.'/permission/permissions' ? 'active' : '';@endphp">
            <a href="/admin/permission/permissions"
            class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Boxicons">Quyền hạn</div>
            </a>
        </li>
        @endcan
        @can("edit permissions-roles")
        <li class="menu-item  @php echo strstr(url()->current(), $url.'/permission/supply') > 0  ? 'active' : '';@endphp">
            <a href="/admin/permission/supply-role-and-permissions" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Boxicons">Cấp vai trò và quyền</div>
            </a>
        </li>
        @endcan
        {{-- <li class="menu-item  @php echo url()->current() == $url.'/permission/supply-permissions' ? 'active' : '';@endphp">
            <a href="/admin/permission/supply-permissions" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Boxicons">Cấp quyền</div>
            </a>
        </li> --}}

      {{-- Thống kê --}}
        @can("read statistic")
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Thống kê</span></li>
        <li class="menu-item  @php echo strstr(url()->current(), $url.'/thong-ke') > 0 ? 'active' : '';@endphp">
            <a href="/admin/thong-ke" class="menu-link">
            <i class="menu-icon tf-icons bx bx-book"></i>
            <div data-i18n="Basic">Thống kê</div>
            </a>
        </li>
        @endcan

      <li class="menu-header small text-uppercase">
        <a href="/logout" class="btn rounded-pill btn-primary">Đăng xuất</a>
      </li>
    </ul>



  </aside>
