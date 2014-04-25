
    <!-- Highlights Wrapper -->
<div class="wrapper wrapper-style3">
    <div class="container">
        <div class="row">
            <div class="12u">

                <!-- Highlights -->
                <div id="highlights">
                    <div>
                        <?php echo $result; ?>
				<form action='<?php echo site_url(); ?>login/login_user' method="post" name="login_form" class="login_form form-3">
				    <p class="clearfix">
                                        <input type="hidden" name="domain" value="mem" />
                                        <input type="hidden" name="ip" value="127.0.0.1" />
				        <input type="text" name="email" id="username" placeholder="Email">
				    </p>
				    <p class="clearfix">
				        <input type="password" name="password" id="password" placeholder="Password"> 
				    </p>
				    <p>
				        <input type="submit" name="submit" value="Sign in">
                                        <span>Not a member? Join <a href="<?php echo site_url(); ?>register.php">here</a>.</span>
				    </p>       
				</form>
                    </div>
                </div>
                <!-- /Highlights -->

            </div>
        </div>
    </div>
</div>
<!-- /Highlights Wrapper -->