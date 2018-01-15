<!-- echo out the system feedback (error and success messages) -->
<?php $this->renderFeedbackMessages(); ?>
<div class="row">
  <div class="col-md-9">
    <div class="card">
      <div class="card-header" data-background-color="red">
        <h4 class="title">Admin Dashbaord</h4>
        <p class="category">Hier kunt u alle gebruikers beheren</p>
      </div>

      <div class="card-content table-responsive">
        <table class="overview-table table display" cellspacing="0" width="100%">
            <thead class="text-primary">
            <tr>
                <!-- <td>Id</td> -->
                <td>Avatar</td>
                <td>Gebruikersnaam</td>
                <td>Email</td>
                <td>Account actief</td>
                <td>Gebruikers profiel</td>
                <td>Schorsings tijd in dagen</td>
                <td>Soft delete</td>
                <td>Account type</td>
                <td>Verzend</td>
            </tr>
            </thead>

            <?php foreach ($this->users as $user) { ?>
                <tr class="<?= ($user->user_active == 0 ? 'inactive' : 'activated'); ?>">
                    <!-- <td><?= $user->user_id; ?></td> -->
                    <td class="avatar">
                        <?php if (true) { ?>
                            <img src="<?= UserModel::getAvatarLink($user); ?>"/>
                        <?php } ?>
                    </td>
                    <td><?= $user->user_name; ?></td>
                    <td><?= $user->user_email; ?></td>
                    <td>
                      <?php
                      if ($user->user_active == 0 ) {
                          echo '<span title="This user is not activated" class="label label-default">No</span>';
                      }else {
                          echo '<span title="This user is activated" class="label label-success">Yes</span>';
                      }
                      ?>
                    </td>
                    <td>
                        <a href="<?= Config::get('URL') . 'profile/showProfile/' . $user->user_id; ?>">Profiel</a>
                    </td>
                    <form action="<?= config::get("URL"); ?>admin/actionAccountSettings" method="post">
                        <td><input type="number" name="suspension" /></td>
                        <td><input type="checkbox" name="softDelete" <?php if ($user->user_deleted) { ?> checked <?php } ?> /></td>
                        <td>
                          <select name="account_type">
                            <?php if ($user->user_account_type == 7) { ?>
                              <!-- <option data-display="select">Nothing</option> -->
                              <option value="7" >Admin</option>
                              <option value="2" >Moderator</option>
                              <option value="1" >Standaard</option>
                            <?php } elseif ($user->user_account_type == 2) { ?>
                              <option value="2" >Moderator</option>
                              <option value="7" >Admin</option>
                              <option value="1" >Standaard</option>
                            <?php } else { ?>
              	               <option value="1" >Standaard</option>
                               <option value="7" >Admin</option>
                               <option value="2" >Moderator</option>
                            <?php } ?>
                          </select>
                        <td>
                            <input type="hidden" name="user_id" value="<?= $user->user_id; ?>" />
                            <input class="btn btn-primary" type="submit" />
                        </td>
                    </form>
                </tr>
            <?php } ?>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-header" data-background-color="red">
        <h4 class="title">Nodig nieuwe gebruiker uit</h4>
        <p class="category">Connecting people</p>
      </div>
      <div class="card-content">
        <div class="row">
          <div class="col-md-12">
            <form action="<?php echo Config::get('URL'); ?>admin/actionInvite" method="post">
              <div class="col-md-12">
                <div class="form-group label-floating is-empty">
                  <label class="control-label">exameple@example.com</label>
                  <input class="form-control" type="text" name="invite_email" required />
                </div>
              </div>
                <!-- set CSRF token at the end of the form -->
                <input type="hidden" name="csrf_token" value="<?= Csrf::makeToken(); ?>" />
                <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
