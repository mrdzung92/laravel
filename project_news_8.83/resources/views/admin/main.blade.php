<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.elements.head')
</head>

<body class="nav-sm">
    <div class="container body">
        <div class="main_container">
            @include('admin.elements.sidebar')
            <!-- top navigation -->
            <div class="top_nav">
                @include('admin.elements.top_nav')
            </div>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main">
                @yield('content')
            </div>
            <!-- /page content -->
            <!-- footer -->

            @include('admin.elements.footer')
            <!-- /footer -->
        </div>
    </div>
    @include('admin.elements.script')
</body>

</html>
