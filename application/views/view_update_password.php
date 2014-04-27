<h2>Update Your Password</h2>
<div id='update_password_form'>
    <form action='<?php echo site_url(); ?>login/update_password' method="post" name="update_password_form" class="login_form form-3">
        <p class="clearfix">
            <input type="hidden" name="domain" value="mem" />
            <input type="hidden" name="ip" value="127.0.0.1" />
            <input type="hidden" name="email_hash" value="<?php echo $email_hash; ?>" />
            <input type="hidden" name="email_code" value="<?php echo $email_code; ?>" />
            <label for="email">Email: </label>
            <input type="text" value="<?php echo (isset($email)) ? $email : ''; ?>"name="email" id="username" placeholder="Email">
        </p>
        <p>
            <label for="password">New Password: </label>
            <input type="password" value="" name="password" />
        </p>
        <p>
            <label for="password_conf">New Password Again: </label>
            <input type="password" value="" name="password_conf" />
        </p>
        <p>
            <input type="submit" name="submit" value="Update My Password">
        </p>       
    </form>
    <?php  echo validation_errors("<p class='error'>");    ?>
</div>