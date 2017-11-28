<h1>test</h1>
<form action="<?= config::get("URL"); ?>register/verify_action" method="post">
  <div class="group">
    <label>Wachtwoord</label>
      <input type="hidden" name="user_id" value="<?php echo $this->user_id; ?>">
      <input type="hidden" name="user_activation_verification_code" value="<?php echo $this->user_activation_verification_code; ?>">
      <input type="password" name="user_password_new" pattern=".{6,}" placeholder="Wachtwoord (6+ karakters)" required autocomplete="off" />
      <label>Wachtwoord herhalen</label>
  <input type="password" name="user_password_repeat" pattern=".{6,}" required placeholder="Herhaal wachtwoord" autocomplete="off" />
  </div>
<!-- when a user navigates to a page that's only accessible for logged a logged-in user, then
     the user is sent to this page here, also having the page he/she came from in the URL parameter
     (have a look). This "where did you came from" value is put into this form to sent the user back
     there after being logged in successfully.
     Simple but powerful feature, big thanks to @tysonlist. -->
<?php if (!empty($this->redirect)) { ?>
    <input type="hidden" name="redirect" value="<?php echo $this->encodeHTML($this->redirect); ?>" />
<?php } ?>
<!--
set CSRF token in login form, although sending fake login requests mightn't be interesting gap here.
If you want to get deeper, check these answers:
1. natevw's http://stackoverflow.com/questions/6412813/do-login-forms-need-tokens-against-csrf-attacks?rq=1
2. http://stackoverflow.com/questions/15602473/is-csrf-protection-necessary-on-a-sign-up-form?lq=1
3. http://stackoverflow.com/questions/13667437/how-to-add-csrf-token-to-login-form?lq=1
-->
    <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>" />
    <input type="submit" class="login-submit-button" value="Log in"/>
</form>
