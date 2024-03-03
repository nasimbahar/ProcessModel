<aside class="main-sidebar">

 
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Admin::user()->avatar }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Admin::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('admin.online') }}</a>
            </div>
        </div>

        @if(config('admin.enable_menu_search'))
        <form class="sidebar-form" style="overflow: initial;" onsubmit="return false;">
            <div class="input-group">
                <input type="text" autocomplete="off" class="form-control autocomplete" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                <ul class="dropdown-menu" role="menu" style="min-width: 210px;max-height: 300px;overflow: auto;">
                    @foreach(Admin::menuLinks() as $link)
                    <li>
                        <a href="{{ admin_url($link['uri']) }}"><i class="fa {{ $link['icon'] }}"></i>{{ admin_trans($link['title']) }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </form>
        <!-- /.search form -->
        @endif

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('admin.menu') }}</li>
            <?php if(Admin::user()->is_first_login==1){?>
           <li>
               <a href="{{admin_url('/')}}">
                <i class="fa fa-info"></i>
                 <span>{{ __('admin.aboutus') }}</span>
                </a>
           </li>
             <li>
               <a href="{{admin_url('school/class')}}">
                <i class="fa fa-home"></i>
                 <span>{{ __('admin.classes') }}</span>
                </a>
           </li>
            <li>
               <a href="{{admin_url('school/year')}}">
                <i class="fa fa-calendar"></i>
                 <span>{{ __('admin.years') }}</span>
                </a>
           </li>
            <li>
                <a href="{{admin_url('school/shift')}}">
                    <i class="fa fa-clone"></i>
                    <span>{{ __('admin.shift') }}</span>
                </a>
            </li>
            <li>
                <a href="{{admin_url('school/section')}}">
                    <i class="fa fa-gg"></i>
                    <span>{{ __('admin.section') }}</span>
                </a>
            </li>
            <li>
                <a href="{{admin_url('school/classsection')}}">
                    <i class="fa  fa-gg-circle"></i>
                    <span>{{ __('admin.classsection') }}</span>
                </a>
            </li>

            <li>
               <a href="" onclick='loadstart()'>
                <i class="fa fa-hourglass-start"></i>
                 <span>{{ __('admin.start') }}</span>
                </a>
           </li>


         <?php }else{?>
            @each('admin::partials.menu', Admin::menu(), 'item')
         <?php }?>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>