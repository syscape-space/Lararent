<section id="<?php echo $id ?? 0 ?>" class="page-section with-sidebar sub-page pb-module-section">
    <div class="container">
        <div class="row">
            <!-- SIDEBAR -->
            <aside class="col-md-3 sidebar" id="sidebar">

                <!-- widget search -->
				<?php
				if ( app( 'BaseCms' )->dynamicSidebar( 'rentit-single-page' ) ):
					echo app( 'BaseCms' )->dynamicSidebar( 'rentit-single-page' );
				endif;

				?>


            </aside>
            <!-- /SIDEBAR -->

            <!-- CONTENT -->
            <div class="col-md-9 content  " id="content">

                <!-- FAQ -->
                <div class="panel-group accordion  " id="accordion" role="tablist" aria-multiselectable="true">
                    <!-- faq1 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading1">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"
                                   aria-expanded="true" aria-controls="collapse1">
                                    <span class="dot"></span> How can ı dorp the rental car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in" role="tabpanel"
                             aria-labelledby="heading1">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq1 -->
                    <!-- faq2 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading2">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2"
                                   aria-expanded="false" aria-controls="collapse2">
                                    <span class="dot"></span> Where can I rent a car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq2 -->
                    <!-- faq3 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading3">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3"
                                   aria-expanded="false" aria-controls="collapse3">
                                    <span class="dot"></span> If I crash a car. What happens?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq3 -->
                    <!-- faq4 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading4">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4"
                                   aria-expanded="false" aria-controls="collapse4">
                                    <span class="dot"></span> How can ı dorp the rental car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq4 -->
                    <!-- faq5 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading5">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5"
                                   aria-expanded="false" aria-controls="collapse5">
                                    <span class="dot"></span> Where can I rent a car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq5 -->
                    <!-- faq6 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading6">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6"
                                   aria-expanded="false" aria-controls="collapse6">
                                    <span class="dot"></span> If I crash a car. What happens?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading6">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq6 -->
                    <!-- faq7 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading7">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse7"
                                   aria-expanded="false" aria-controls="collapse7">
                                    <span class="dot"></span> How can ı dorp the rental car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading7">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq7 -->
                    <!-- faq8 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading8">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse8"
                                   aria-expanded="false" aria-controls="collapse8">
                                    <span class="dot"></span> Where can I rent a car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq8 -->
                    <!-- faq9 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading9">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse9"
                                   aria-expanded="false" aria-controls="collapse9">
                                    <span class="dot"></span> If I crash a car. What happens?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading9">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq9 -->
                    <!-- faq10 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading10">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse10"
                                   aria-expanded="false" aria-controls="collapse10">
                                    <span class="dot"></span> How can ı dorp the rental car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse10" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading10">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq10 -->
                    <!-- faq11 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading11">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse11"
                                   aria-expanded="false" aria-controls="collapse11">
                                    <span class="dot"></span> Where can I rent a car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse11" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading11">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq11 -->
                    <!-- faq12 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading12">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse12"
                                   aria-expanded="false" aria-controls="collapse12">
                                    <span class="dot"></span> If I crash a car. What happens?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse12" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading12">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq12 -->
                    <!-- faq13 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading13">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse13"
                                   aria-expanded="false" aria-controls="collapse13">
                                    <span class="dot"></span> How can ı dorp the rental car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse13" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading13">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq13 -->
                    <!-- faq14 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading14">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse14"
                                   aria-expanded="false" aria-controls="collapse14">
                                    <span class="dot"></span> Where can I rent a car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse14" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading14">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq14 -->
                    <!-- faq15 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading15">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse15"
                                   aria-expanded="false" aria-controls="collapse15">
                                    <span class="dot"></span> If I crash a car. What happens?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse15" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading15">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq15 -->
                    <!-- faq16 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading16">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse16"
                                   aria-expanded="false" aria-controls="collapse16">
                                    <span class="dot"></span> How can ı dorp the rental car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse16" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading16">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq16 -->
                    <!-- faq17 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading17">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse17"
                                   aria-expanded="false" aria-controls="collapse17">
                                    <span class="dot"></span> If I crash a car. What happens?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse17" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading17">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq17 -->
                    <!-- faq18 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading18">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse18"
                                   aria-expanded="false" aria-controls="collapse18">
                                    <span class="dot"></span> How can ı dorp the rental car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse18" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading81">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq18 -->
                    <!-- faq19 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading19">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse19"
                                   aria-expanded="false" aria-controls="collapse19">
                                    <span class="dot"></span> Where can I rent a car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse19" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading19">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq19 -->

                </div>
                <!-- /FAQ -->

            </div>
            <!-- /CONTENT -->

        </div>
    </div>
</section>