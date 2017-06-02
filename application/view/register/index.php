<div class="container">
  <!-- echo out the system feedback (error and success messages) -->
  <?php $this->renderFeedbackMessages(); ?>
  <div class="registration">
  <!-- login box on left side -->
  <div class="form-login-details" style="">
      <!-- register form -->
      <form method="post" action="<?php echo Config::get('URL'); ?>register/register_action">
        <!-- the user name input field uses a HTML5 pattern check -->
        <input type="text" pattern="[a-zA-Z0-9,./!-]{2,64}" name="user_name" placeholder="Username (letters/numbers/special, min 10 chars)" required />
        <div class="outter">
          <div class="inner">
            <input type="text" name="user_email" placeholder="Email address (a valid address)" required />
            <input type="text" name="user_email_repeat" placeholder="Repeat Email address" required />
          </div>
          <div class="inner two">
            <input type="password" name="user_password_new" pattern=".{6,}" placeholder="Password (min 6 chars)" required autocomplete="off" />
            <input type="password" name="user_password_repeat" pattern=".{6,}" required placeholder="Repeat Password" autocomplete="off" />
          </div>
        </div>


        <!-- show the captcha by calling the login/showCaptcha-method in the src attribute of the img tag -->
        <img id="captcha" src="<?php echo Config::get('URL'); ?>register/showCaptcha" />
        <input type="text" name="captcha" placeholder="Please enter above characters" required />

        <!-- quick & dirty captcha reloader -->
        <a href="#" style="display: block; font-size: 11px; margin: 5px 0 15px 0; text-align: center"
           onclick="document.getElementById('captcha').src = '<?php echo Config::get('URL'); ?>register/showCaptcha?' + Math.random(); return false">Reload Captcha</a>
        <input type="submit" value="Register" class="submit-button" />
      </form>
    </div>
  </div>
</div>
<!-- <div class="container">
    <p style="display: block; font-size: 11px; color: #999;">
        Please note: This captcha will be generated when the img tag requests the captcha-generation
        (= a real image) from YOURURL/register/showcaptcha. As this is a client-side triggered request, a
        $_SESSION["captcha"] dump will not show the captcha characters. The captcha generation
        happens AFTER the request that generates THIS page has been finished.
    </p>
</div> -->
