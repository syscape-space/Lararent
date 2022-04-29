<footer class="footer">


    @if(!isset($hide_widgets) || $hide_widgets == false )
        <div class="footer-widgets">
            <div class="container">
                <div class="row">

                    <!-- widget search -->
                    @if( app('BaseCms')->dynamicSidebar('rentit-footer-sidebar'))
                        @dynamic_sidebar('rentit-footer-sidebar')
                    @endif


                </div>
            </div>
        </div>
    @endif

    <div class="footer-meta">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <p class="btn-row text-center">

						<?php
						if(get_theme_mod( 'footer_enable_social_buttons', true )){
						$all_arr = get_theme_mod( 'footer_social_buttons' );
						$new_arr = [];
						if ( $all_arr['url'] ?? false ) {
						foreach ( $all_arr['url'] as $k => $v ) {
						?>
                        <a target="_blank" href="{{ $all_arr['url'][$k] ?? '' }}"
                           class="btn btn-theme btn-icon-left {{ $all_arr['type'][$k] ?? '' }}">
                            <i class="fa {{ $all_arr['icon'][$k] ?? '' }}"></i>{{ $all_arr['text'][$k] ?? '' }}
                        </a>

						<?php

						}
						}
						}
						?>

                    </p>
                    <div class="copyright">
                        {{get_theme_mod('footer_copyright', '©'.  date('Y', time()) . '  Rent It — An One Page Rental Car Theme made with passion by jThemes Studio')}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
