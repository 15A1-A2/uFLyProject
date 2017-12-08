    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
    <div class="login">
       <div class="form-login-details">
        <form action="<?php echo Config::get('URL'); ?>login/login" method="post">
          <ul class="tab-group">
            <li class="tab active"><a href="#login">Log In</a></li>
            <li class="tab "><a href="<?php echo Config::get('URL'); ?>register/index">Registreer </a></li>
          </ul>

            <input type="text" name="user_name" placeholder="Gebrukersnaam of e-mailadres" required />
            <input type="password" name="user_password" placeholder="Wachtwoord" autocomplete="off" required />

             <?php if (!empty($this->redirect)) { ?>
                <input type="hidden" name="redirect" value="<?php echo $this->encodeHTML($this->redirect); ?>" />
             <?php } ?>

            <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>" />
            <input type="submit" class="submit-button" value="Log in"/>
          </form>
          <div class="link-forgot-my-password">
            <a href="<?php echo Config::get('URL'); ?>login/requestPasswordReset">Ik ben mij wachtwoord vergeten</a>
          </div>
           <!-- <label for="set_remember_me_cookie" class="remember-me-label">
                     <input type="checkbox" name="set_remember_me_cookie" class="remember-me-checkbox" />
                     Remember me for 2 weeks
            </label> -->
        </div>
    </div>
