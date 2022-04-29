<section id="<?php echo $id; ?>" class="page-section no-padding  pb-module-section">

    <div class="container full-width">

        <!-- Google map -->
        <div class="google-map">
            <div id="map-canvas"></div>

        </div>
        <!-- /Google map -->

    </div>
    <script type="text/javascript">
        var
            mapObject,
            markers = [],
            markersData =  <?php echo $markersData ?? ''  ?>


        }
        ;


        function initialize_map() {


            loadScript("/rentit/js/infobox.js", after_load);

        }

        function after_load() {
            var global_scrollwheel = false;
            var markerClusterer = null;
            var markerCLuster;
            var Clusterer;

            initialize_new2();
        }

        function loadScript(src, callback) {
            var s,
                r,
                t;
            r = false;
            s = document.createElement('script');
            s.type = 'text/javascript';
            s.src = src;
            s.onload = s.onreadystatechange = function () {
                ////console.log( this.readyState ); //uncomment this line to see which ready states are called.
                if (!r && (!this.readyState || this.readyState == 'complete')) {
                    r = true;
                    callback();
                }
            };
            t = document.getElementsByTagName('script')[0];
            t.parentNode.insertBefore(s, t);

        }
    </script>
</section>