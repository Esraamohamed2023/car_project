<!DOCTYPE html>
<html lang="en">
    @include('admin.includes.head')

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                @include('admin.includes.sidebar')
                @include('admin.includes.topbar')
    
    
                
    
                <!-- page content -->
               @yield('pageContent')
                <!-- /page content -->
    
                @include('admin.includes.footer')
            </div>
        </div>
    
    @include('admin.includes.footerjs')
    
    </body>
    </html>
    