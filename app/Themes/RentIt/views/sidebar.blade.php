<!-- widget search  sidebar  -->
@if( app('BaseCms')->dynamicSidebar($sidebar ?? 'rentit-sidebar'))
    @dynamic_sidebar($sidebar ?? 'rentit-sidebar')
@endif

