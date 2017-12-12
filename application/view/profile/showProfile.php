<!-- echo out the system feedback (error and success messages) -->
<?php $this->renderFeedbackMessages(); ?>
<div class="row">
  <div class="col-md-3">
      <div class="card card-profile">
        <div class="card-avatar">
          <a href="#pablo">
            <?php if (isset($this->user->user_avatar_link)) { ?>
                <img class="img" src="<?= $this->user->user_avatar_link; ?>" />
            <?php } ?>
          </a>
        </div>
        <div class="content">
          <h6 class="category text-gray"><?= $this->user->user_email; ?></h6>
          <h4 class="card-title"><?= $this->user->user_name; ?></h4>
          <p class="card-content"></p>
          <a class="btn btn-primary btn-round" href="<?= Config::get('URL') ?>user/editAvatar">Bewerk je avatar</a>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="card">
        <div class="card-header" data-background-color="red">
          <h4 class="title">Bewerk Profile</h4>
          <p class="category">Make it your own</p>
        </div>
        <div class="card-content">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group label-floating is-empty">
                <form action="<?php echo Config::get('URL'); ?>user/editUserName_action" method="post">
                  <!-- btw http://stackoverflow.com/questions/774054/should-i-put-input-tag-inside-label-tag -->
                  <label class="control-label">Nieuwe gebruikersnaam:</label>
                  <input class="form-control" type="text" name="user_name" required />
                  <!-- set CSRF token at the end of the form -->
                  <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>" />
                  <button class="btn btn-primary" type="submit" value="Submit">Verzend</button>
                </form>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group label-floating is-empty">
                <form action="<?php echo Config::get('URL'); ?>user/editUserEmail_action" method="post">
                  <label class="control-label">Nieuw email adres</label>
                  <input class="form-control" type="text" name="user_email" required />
                  <button class="btn btn-primary" type="submit" value="Submit">Verzend</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form method="post" action="<?php echo Config::get('URL'); ?>user/changePassword_action" name="new_password_form">
                <div class="col-md-4">
                  <div class="form-group label-floating is-empty">
                    <label class="control-label" for="change_input_password_current">Geef huidig wachtwoord in</label>
                    <input class="form-control" id="change_input_password_current" class="reset_input" type='password' name='user_password_current' pattern=".{6,}" required autocomplete="off"  />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group label-floating is-empty">
                    <label class="control-label" for="change_input_password_new">Nieuw wachtwoord (min. 6)</label>
                    <input class="form-control" id="change_input_password_new" class="reset_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" /></p>
                  </div>
                </div>
                <div class="col-md-4" style="padding-right: 20px;">
                  <div class="form-group label-floating is-empty">
                    <label class="control-label" for="change_input_password_repeat">Herhaal nieuw password</label>
                    <input class="form-control" id="change_input_password_repeat" class="reset_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
                    <button class="btn btn-primary" type="submit"  name="submit_new_password" value="Submit new password">Verzend</button>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
