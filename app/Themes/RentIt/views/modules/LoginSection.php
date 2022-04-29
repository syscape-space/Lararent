<section id="<?php echo $id ?? 0 ?>" class="page-section color  pb-module-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="block-title edit"><span>Login</span></h3>
				<?php if ( !Auth::id() ) { ?>
                    <form action="<?php echo route( 'login' ); ?>" method="POST" class="form-login rentit-form-login">
						<?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12 hello-text-wrap">
                                <span class="hello-text text-thin edit">Hello, welcome to your account</span>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <a class="btn btn-theme btn-block btn-icon-left facebook edit" href="<?php  echo $f_link ?? '' ?>"><i
                                            class="fa fa-facebook"></i>Sign in with Facebook</a>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <a class="btn btn-theme btn-block btn-icon-left twitter edit" href="<?php  echo $t_link ?? '' ?>"><i
                                            class="fa fa-twitter"></i>Sign in with Twitter</a>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group edit"><input name="login" class="form-control" type="text" required
                                                                    placeholder="login"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group edit"><input name="password" class="form-control" type="password" required
                                                                    placeholder="Your password"></div>
                            </div>
                            <div class="col-md-12 col-lg-6 edit">
                                <div class="checkbox">
                                    <label><input name="remember" type="checkbox"> Remember me</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 text-right-lg">
                                <a class="forgot-password edit" href="#">forgot password?</a>
                            </div>
                            <div class="col-md-6">
                                <button  type="submit" class="btn btn-theme btn-block btn-theme-dark edit" href="#">Login</button>
                            </div>
                        </div>
                    </form>
				<?php } else { ?>
                    <div class="col-md-12 hello-text-wrap">
                        <span class="hello-text text-thin edit">Hello <?php echo Auth::user()->name ?? ''; ?>, welcome to your account</span>
                    </div>
				<?php } ?>
            </div>
            <div class="col-sm-6">
                <h3 class="block-title edit"><span>Create New Account</span></h3>
                <form action="#" class="create-account">
                    <div class="row">
                        <div class="col-md-12 hello-text-wrap">
                            <span class="hello-text text-thin edit">Create Your Account</span>
                        </div>
                        <div class="col-md-12">
                            <h3 class="block-title edit">Signup Today and You'll be able to</h3>
                            <ul class="list-check edit">
                                <li class="edit">Online Order Status</li>
                                <li class="edit">See Ready Hot Deals</li>
                                <li class="edit">Love List</li>
                                <li class="edit">Sign up to receive exclusive news and private sales</li>
                                <li class="edit">Quick Buy Stuffs</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-block btn-theme btn-theme-dark btn-create edit" href="#">Create
                                Account</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>