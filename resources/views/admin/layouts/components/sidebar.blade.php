<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="{{ currentSelectedURL('admin.dashboard') }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-gauge"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview">
                        @canany([
                            'config',
                            'create config',
                            'edit config',
                            'delete config',
                            'logo edit',
                            'favicon
                            edit',
                            ])
                            <a href="#">
                                <i class="fa-solid fa-gear"></i>
                                <span>Website Setting</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                        @endcan
                        <ul class="treeview-menu">
                            @can('favicon edit')
                                <li class="{{ currentSelectedURL('admin.config.favicon') }}">
                                    <a href="{{ route('admin.config.favicon') }}">
                                        <i class="fa-regular fa-circle-dot"></i>
                                        Favicon</a>
                                </li>
                            @endcan
                            @can('logo edit')
                                <li class="{{ currentSelectedURL('admin.config.logo') }}">
                                    <a href="{{ route('admin.config.logo') }}">
                                        <i class="fa-regular fa-circle-dot"></i>
                                        Logo</a>
                                </li>
                            @endcan
                            @can('edit config')
                                <li class="{{ currentSelectedURL('admin.config.settings') }}">
                                    <a href="{{ route('admin.config.settings') }}">
                                        <i class="fa-regular fa-circle-dot"></i>
                                        Config</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-solid fa-image"></i>
                            <span>Banner Management</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ currentSelectedURL('banner.create') }}">
                                <a href="{{ route('banner.create') }}">
                                    <i class="fa-regular fa-circle-dot"></i> Add Banner</a>
                            </li>
                            <li class="{{ currentSelectedURL('banner.index') }}">
                                <a href="{{ route('banner.index') }}">
                                    <i class="fa-regular fa-circle-dot"></i> Banner List</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-solid fa-address-book"></i>
                            <span>Inquiry Section</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ \Request::query('inquiry') == 'newsletter' ? 'active' : '' }}">
                                <a href="{{ route('inquiry.index', ['inquiry' => 'newsletter']) }}"><i
                                        class="fa-regular fa-circle-dot"></i> Newsletter
                                    Inquiries</a>
                            </li>
                            <li class="{{ \Request::query('inquiry') == 'contact' ? 'active' : '' }}">
                                <a href="{{ route('inquiry.index', ['inquiry' => 'contact']) }}"><i
                                        class="fa-regular fa-circle-dot"></i> Contact Inquiries</a>
                            </li>
                        </ul>
                    </li>

                    <li class="header">Content Management System</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-solid fa-sheet-plastic"></i>
                            <span>Pages</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('create page')
                                <li class="{{ currentSelectedURL('page.create') }}">
                                    <a href="{{ route('page.create') }}">
                                        <i class="fa-regular fa-circle-dot"></i>
                                        Add Page</a>
                                </li>
                            @endcan
                            @can('page')
                                <li class="{{ currentSelectedURL('page.index') }}">
                                    <a href="{{ route('page.index') }}">
                                        <i class="fa-regular fa-circle-dot"></i>
                                        Page</a>
                                </li>
                            @endcan
                        </ul>
                    </li>

                    @foreach ($laravelAdminMenus->menus as $section)
                        @if ($section->items)
                            <li class="header">{{ $section->section }}</li>
                            @foreach ($section->items as $menu)
                                <li class="treeview">
                                    <a href="#">
                                        {!! $menu->icon !!}

                                        <span>{{ $menu->title }}</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">

                                        <li
                                            class="{{ Request::is('admin' . $menu->url . '/create') ? 'active' : '' }}">
                                            <a href="{{ url('/admin' . $menu->url . '/create') }}"><i
                                                    class="icon-Commit"><span class="path1"></span><span
                                                        class="path2"></span></i>Add {{ $menu->title }}</a>
                                        </li>
                                        <li class="{{ Request::is('admin' . $menu->url) ? 'active' : '' }}">
                                            <a href="{{ url('/admin' . $menu->url) }}"><i class="icon-Commit"><span
                                                        class="path1"></span><span
                                                        class="path2"></span></i>{{ $menu->title }} List</a>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                    @role('super admin')
                        <li class="header">Roles</li>
                        <li class="treeview">
                            <a href="#">
                                <i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
                                <span>Roles</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                @can('create role')
                                    <li class="{{ currentSelectedURL('roles.create') }}">
                                        <a href="{{ route('roles.create') }}"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Add Roles</a>
                                    </li>
                                @endcan
                                @can('role')
                                    <li class="{{ currentSelectedURL('roles.index') }}">
                                        <a href="{{ route('roles.index') }}"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Roles List</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="header">Permissions</li>
                        <li class="treeview">
                            <a href="#">
                                <i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
                                <span>Permissions</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                @can('create permission')
                                    <li class="{{ currentSelectedURL('permissions.create') }}">
                                        <a href="{{ route('permissions.create') }}"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Add Permission</a>
                                    </li>
                                @endcan
                                @can('permission')
                                    <li class="{{ currentSelectedURL('permissions.index') }}">
                                        <a href="{{ route('permissions.index') }}"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Permission List</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endrole

                    <li class="header">Ecommerce</li>
                    <li class="treeview">

                        @canany(['attribute', 'create attribute', 'edit attribute'])
                            <a href="#">
                                <i class="fa-solid fa-list"></i>
                                <span>Attribute Management</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                        @endcanany



                        <ul class="treeview-menu">
                            @can('create attribute')
                                <li class="{{ Request::is('admin/attribute/create') ? 'active' : '' }}">
                                    <a href="{{ url('admin/attribute/create') }}">
                                        <i class="fa-regular fa-circle-dot"></i>
                                        Add Attribute</a>
                                </li>
                            @endcan
                            @can('attribute')
                                <li class="{{ Request::is('admin/attribute') ? 'active' : '' }}">
                                    <a href="{{ url('admin/attribute') }}">
                                        <i class="fa-regular fa-circle-dot"></i>
                                        Attribute List</a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                    <li class="treeview">

                        @canany(['category', 'create category', 'edit category'])
                            <a href="#">
                                <i class="fa-solid fa-box"></i>
                                <span>Category Management</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                        @endcanany



                        <ul class="treeview-menu">
                            @can('create category')
                                <li class="{{ currentSelectedURL('category.create') }}">
                                    <a href="{{ route('category.create') }}">
                                        <i class="fa-regular fa-circle-dot"></i>
                                        Add Category</a>
                                </li>
                            @endcan
                            @can('category')
                                <li class="{{ currentSelectedURL('category.index') }}">
                                    <a href="{{ route('category.index') }}">
                                        <i class="fa-regular fa-circle-dot"></i>
                                        Category List</a>
                                </li>
                            @endcan

                        </ul>
                    </li>

                    <li class="treeview">
                        @canany(['user', 'create user', 'edit user'])
                            <a href="#">
                                <i class="fa-solid fa-user"></i>
                                <span>User</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                        @endcan
                        <ul class="treeview-menu">
                            @can('create user')
                                <li class="{{ currentSelectedURL('customer.create') }}">
                                    <a href="{{ route('customer.create') }}">
                                        <i class="fa-regular fa-circle-dot"></i>
                                        Add User</a>
                                </li>
                            @endcan
                            @can('user')
                                <li class="{{ currentSelectedURL('customer.index') }}">
                                    <a href="{{ route('customer.index') }}">
                                        <i class="fa-regular fa-circle-dot"></i>
                                        User List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            @canany([
                                'order',
                                'delete order',
                                'product',
                                'create product',
                                'edit product',
                                'delete
                                product',
                                ])
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span>Online Store</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            @endcan
                        </a>
                        <ul class="treeview-menu">
                            @can('product')
                                <li class="{{ currentSelectedURL('product.index') }}"><a
                                        href="{{ route('product.index') }}">
                                        <i class="fa-regular fa-circle-dot"></i> Products</a></li>
                            @endcan
                            @can('create product')
                                <li class="{{ currentSelectedURL('product.create') }}"><a
                                        href="{{ route('product.create') }}">
                                        <i class="fa-regular fa-circle-dot"></i>
                                        Products Add</a>
                                </li>
                            @endcan
                            <li class="{{ currentSelectedURL('order.index') }}"><a
                                    href="{{ route('order.index') }}">
                                    <i class="fa-regular fa-circle-dot"></i>Orders List</a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</aside>
