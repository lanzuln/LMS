
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('admin.dashboard')}}" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li class="menu-label">UI Elements</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-cart"></i>
                </div>
                <div class="menu-title">Category Manage</div>
            </a>
            <ul class="mm-collapse">
                <li> <a href="{{route('category.index')}}"><i class="bx bx-radio-circle"></i>All Category</a>
                </li>
                <li> <a href="{{route('category.create')}}"><i class="bx bx-radio-circle"></i>New Category</a>
                </li>
            </ul>
        </li>

    </ul>
    <!--end navigation-->
</div>
