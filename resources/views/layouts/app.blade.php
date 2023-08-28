<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Black Dashboard') }}</title>
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('black') }}/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset('black') }}/img/favicon.png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ asset('black') }}/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('black') }}/css/datatables.css">
  <link href="{{ asset('black') }}/css/black-dashboard.min.css" rel="stylesheet" />
  <link href="{{ asset('black') }}/css/theme.css" rel="stylesheet" />
  {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"> --}}
  <link href="{{ asset('black') }}/css/bootstrap-datetimepicker.css" rel="stylesheet" />
  {{-- <link href="{{ asset('black') }}/css/bootstrap-datepicker.css" rel="stylesheet" /> --}}
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link href="{{ asset('black') }}/css/jquery-ui.css" rel="stylesheet" />
  <link href="{{ asset('black') }}/css/black-dashboard.css" rel="stylesheet" />
  {{-- <link rel="stylesheet" href="{{ asset('black') }}/css/.css"> --}}
  {{-- FLATPCIKR CSS --}}
  <link href="{{ asset('black') }}/css/flatpickr.css" rel="stylesheet" />
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}
  @yield('css')

  <script type="text/javascript" src="{{ asset('black')}}/js/core/jquery.min.js"></script>
  <script src="{{ asset('black') }}/js/core/jquery-ui.js"></script>
  {{-- FLATPICKR JS --}}
  {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
  <script src="{{ asset('black') }}/js/core/flatpickr.js"></script>
  {{-- <script src="https://cdn.tiny.cloud/1/a1vgs8g6u1fmcfk31f7fvhwos68st4gc5xtd1jeevwymezqt/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
  <script src="https://cdn.tiny.cloud/1/yr79upgpo8mcx4wu65hwhcfom3jqju7d7x8r24yvmwg3xyt6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  {{-- <script type="text/javascript" src="{{ asset('black')}}/js/tinymce/tinymce.min.js"></script> --}}

  <script type="text/javascript" src="{{ asset('black') }}/js/core/datatables.js"></script>
  <!-- MomentJs -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
  {{-- Numeric Format CDN --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="{{ asset('black') }}/js/core/popper.min.js"></script>
  <script src="{{ asset('black') }}/js/core/bootstrap.min.js"></script>
  <script src="{{ asset('black') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('black') }}/js/plugins/bootstrap-notify.js"></script>
  <!-- Datatables -->
  <script src="{{ asset('black') }}/js/core/datatables.js"></script>
  <script src="{{ asset('black') }}//js/core/buttons.bootstrap.js"></script>
  
  <script src="{{ asset('black') }}/js/black-dashboard.js"></script>
  <script src="{{ asset('black') }}/js/theme.js"></script>
  <!-- Sweet Alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Datepicker & Datetimepicker -->
  {{-- <script src="{{ asset('black') }}/vendor/dtpicker/js/bootstrap-datetimepicker.min.js"></script> --}}
  {{-- <script src="{{ asset('black') }}/js/bootstrap-datepicker.js"></script> --}}
  {{-- <script src="{{ asset('black') }}/js/bootstrap-datetimepicker.js"></script> --}}
  
  
</head>
<body class="{{ $class ?? '' }}">
  @auth()
  <div class="wrapper">
    @include('layouts.navbars.sidebar')
    <div class="main-panel">
      @include('layouts.navbars.navbar')

      <div class="content">
        @yield('content')
      </div>

      @include('layouts.footer')
    </div>
    @stack('js')
    @yield('javascript')
  </div>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
  @else
  @include('layouts.navbars.navbar')
  <div class="wrapper wrapper-full-page">
    <div class="full-page {{ $contentClass ?? '' }}">
      <div class="content">
        <div class="container">
          @yield('content')
        </div>
      </div>
      @include('layouts.footer')
    </div>
  </div>
  @endauth
  {{-- <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
      </a>
      <ul class="dropdown-menu">
        <li class="header-title"> Sidebar Background</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger background-color">
            <div class="badge-colors text-center">
              <span class="badge filter badge-primary active" data-color="primary"></span>
              <span class="badge filter badge-info" data-color="blue"></span>
              <span class="badge filter badge-success" data-color="green"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="button-container">
          <a href="https://www.creative-tim.com/product/black-dashboard-laravel" target="_blank" class="btn btn-primary btn-block btn-round">Download Now</a>
          <a href="https://demos.creative-tim.com/black-dashboard/docs/1.0/getting-started/introduction.html" target="_blank" class="btn btn-default btn-block btn-round">
            Documentation
          </a>
          <a href="https://www.creative-tim.com/product/black-dashboard-pro-laravel" target="_blank" class="btn btn-danger btn-block btn-round">
            Upgrade to PRO
          </a>
        </li>
        <li class="header-title">Thank you for 95 shares!</li>
        <li class="button-container text-center">
          <button id="twitter" class="btn btn-round btn-info"><i class="fab fa-twitter"></i> &middot; 45</button>
          <button id="facebook" class="btn btn-round btn-info"><i class="fab fa-facebook-f"></i> &middot; 50</button>
          <br>
          <br>
          <a class="github-button" href="https://github.com/creativetimofficial/black-dashboard-laravel" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star ntkme/github-buttons on GitHub">Star</a>
        </li>
      </ul>
    </div>
  </div> --}}
  <!-- Data Tables JS -->

  <script>
  $(document).ready(function() {
    $().ready(function() {
      $sidebar = $('.sidebar');
      $navbar = $('.navbar');
      $main_panel = $('.main-panel');

      $full_page = $('.full-page');

      $sidebar_responsive = $('body > .navbar-collapse');
      sidebar_mini_active = true;
      white_color = false;

      window_width = $(window).width();

      fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

      $('.fixed-plugin a').click(function(event) {
        if ($(this).hasClass('switch-trigger')) {
          if (event.stopPropagation) {
            event.stopPropagation();
          } else if (window.event) {
            window.event.cancelBubble = true;
          }
        }
      });

      $('.fixed-plugin .background-color span').click(function() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('color');

        if ($sidebar.length != 0) {
          $sidebar.attr('data', new_color);
        }

        if ($main_panel.length != 0) {
          $main_panel.attr('data', new_color);
        }

        if ($full_page.length != 0) {
          $full_page.attr('filter-color', new_color);
        }

        if ($sidebar_responsive.length != 0) {
          $sidebar_responsive.attr('data', new_color);
        }
      });

      $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
        var $btn = $(this);

        if (sidebar_mini_active == true) {
          $('body').removeClass('sidebar-mini');
          sidebar_mini_active = false;
          blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
        } else {
          $('body').addClass('sidebar-mini');
          sidebar_mini_active = true;
          blackDashboard.showSidebarMessage('Sidebar mini activated...');
        }

        // we simulate the window Resize so the charts will get updated in realtime.
        var simulateWindowResize = setInterval(function() {
          window.dispatchEvent(new Event('resize'));
        }, 180);

        // we stop the simulation of Window Resize after the animations are completed
        setTimeout(function() {
          clearInterval(simulateWindowResize);
        }, 1000);
      });

      $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
        var $btn = $(this);

        if (white_color == true) {
          $('body').addClass('change-background');
          setTimeout(function() {
            $('body').removeClass('change-background');
            $('body').removeClass('white-content');
          }, 900);
          white_color = false;
        } else {
          $('body').addClass('change-background');
          setTimeout(function() {
            $('body').removeClass('change-background');
            $('body').addClass('white-content');
          }, 900);

          white_color = true;
        }
      });
    });
  });
  </script>

</body>
</html>
