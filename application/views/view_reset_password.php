
    <!-- Highlights Wrapper -->
<div class="wrapper wrapper-style3">
    <div class="container">
        <div class="row">
            <div class="12u">

                <!-- Highlights -->
                <div id="highlights">
                    <div>
                        <?php echo $result; ?>
				<form action='<?php echo site_url(); ?>login/reset_password' method="post" name="reset_password_form" class="login_form form-3">
				    <p class="clearfix">
                                        <input type="hidden" name="domain" value="mem" />
                                        <input type="hidden" name="ip" value="127.0.0.1" />
				        <input type="text" name="email" id="username" placeholder="Email">
				    </p>
				    <p>
				        <input type="submit" name="submit" value="Reset My Password">
                                        <span>Not a member? Join <a href="<?php echo site_url(); ?>registration">here</a>.</span>
				    </p>       
				</form>
                        <?php 
                        echo validation_errors("<p class='errors'>");
                        if (isset($error)){
                            echo "<p class='error'>" . $error . "</p>";
                        }
                        ?>
                    </div>
                </div>
                <!-- /Highlights -->

            </div>
        </div>
    </div>
</div>
<!-- /Highlights Wrapper -->