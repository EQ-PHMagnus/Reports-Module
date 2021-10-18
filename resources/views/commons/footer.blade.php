<!-- Footer -->
    <footer class="site-footer">
        <div class="site-footer-legal">© {{date('Y')}} <a href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">PHMagnus</a></div>
    </footer>
    <!-- Core  -->
    <script src="{{asset('global/vendor/babel-external-helpers/babel-external-helpers.js')}}"></script>
    <script src="{{asset('global/vendor/jquery/jquery.js')}}"></script>
    <script src="{{asset('global/vendor/popper-js/umd/popper.min.js')}}"></script>
    <script src="{{asset('global/vendor/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('global/vendor/axios/axios.min.js')}}"></script>
    <script src="{{asset('global/vendor/animsition/animsition.js')}}"></script>
    <script src="{{asset('global/vendor/mousewheel/jquery.mousewheel.js')}}"></script>
    <script src="{{asset('global/vendor/asscrollbar/jquery-asScrollbar.js')}}"></script>
    <script src="{{asset('global/vendor/asscrollable/jquery-asScrollable.js')}}"></script>

    <!-- Plugins -->
    <script src="{{asset('global/vendor/jquery-mmenu/jquery.mmenu.min.all.js')}}"></script>
    <script src="{{asset('global/vendor/switchery/switchery.js')}}"></script>
    <script src="{{asset('global/vendor/intro-js/intro.js')}}"></script>
    <script src="{{asset('global/vendor/screenfull/screenfull.js')}}"></script>
    <script src="{{asset('global/vendor/slidepanel/jquery-slidePanel.js')}}"></script>
    <script src="{{asset('global/vendor/skycons/skycons.js')}}"></script>
    <script src="{{asset('global/vendor/aspieprogress/jquery-asPieProgress.min.js')}}"></script>
    <script src="{{asset('global/vendor/jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{asset('global/vendor/jvectormap/maps/jquery-jvectormap-au-mill-en.js')}}"></script>
    <script src="{{asset('global/vendor/matchheight/jquery.matchHeight-min.js')}}"></script>
    <script src="{{asset('global/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>

    <!-- Scripts -->
    <script src="{{asset('global/js/Component.js')}}"></script>
    <script src="{{asset('global/js/Plugin.js')}}"></script>
    <script src="{{asset('global/js/Base.js')}}"></script>
    <script src="{{asset('global/js/Config.js')}}"></script>

    <script src="{{asset('assets/js/Section/Menubar.js')}}"></script>
    <script src="{{asset('assets/js/Section/Sidebar.js')}}"></script>
    <script src="{{asset('assets/js/Section/PageAside.js')}}"></script>
    <script src="{{asset('assets/js/Section/GridMenu.js')}}"></script>

    <script src="{{asset('assets/vendor/bootstrap-table/bootstrap-table.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-table/extensions/mobile/bootstrap-table-mobile.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('app/js/action.js')}}"></script>
    <script src="{{asset('app/js/filter.js')}}"></script>
    <script src="{{asset('app/js/util.js')}}"></script>
    <script src="{{asset('app/js/config.js')}}"></script>

    <!-- Config -->
    <script src="{{asset('global/js/config/colors.js')}}"></script>
    <script src="{{asset('assets/js/config/tour.js')}}"></script>
    <script>
        Config.set('assets', '../assets');
    </script>

    <!-- Page -->
    <script src="{{asset('assets/js/Site.js')}}"></script>
    <script src="{{asset('global/js/Plugin/asscrollable.js')}}"></script>
    <script src="{{asset('global/js/Plugin/slidepanel.js')}}"></script>
    <script src="{{asset('global/js/Plugin/switchery.js')}}"></script>
    <script src="{{asset('global/js/Plugin/matchheight.js')}}"></script>
    <script src="{{asset('global/js/Plugin/jvectormap.js')}}"></script>


    <script src="{{asset('custom_assets/js/commons.js')}}"></script>
   <script>
    (function(document, window, $){
        'use strict';

        var Site = window.Site;
        
        $(document).ready(function(){
            Site.run();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            $('.btn-destroy-model').click(destroyModel);
            $('.btn-export').click(exportTable);
        });
      })(document, window, jQuery);

    </script>
@stack('scripts')
</body>

</html>