<!-- echo out the system feedback (error and success messages) -->
<?php $this->renderFeedbackMessages(); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header" data-background-color="red">
        <h4 class="title">Admin Dashbaord</h4>
        <p class="category">Hier kunt u alle gebruikers beheren.</p>
      </div>

      <div class="card-content table-responsive">
        <table class="overview-table table">
            <thead class="text-primary">
            <tr>
                <td>Id</td>
                <td>Avatar</td>
                <td>Username</td>
                <td>User's email</td>
                <td>Activated ?</td>
                <td>Link to user's profile</td>
                <td>suspension Time in days</td>
                <td>Soft delete</td>
                <td>Submit</td>
            </tr>
            </thead>
            <?php foreach ($this->users as $user) { ?>
                <tr class="<?= ($user->user_active == 0 ? 'inactive' : 'active'); ?>">
                    <td><?= $user->user_id; ?></td>
                    <td class="avatar">
                        <?php if (isset($user->user_avatar_link)) { ?>
                            <img src="<?= $user->user_avatar_link; ?>"/>
                        <?php } ?>
                    </td>
                    <td><?= $user->user_name; ?></td>
                    <td><?= $user->user_email; ?></td>
                    <td><?= ($user->user_active == 0 ? 'No' : 'Yes'); ?></td>
                    <td>
                        <a href="<?= Config::get('URL') . 'profile/showProfile/' . $user->user_id; ?>">Profile</a>
                    </td>
                    <form action="<?= config::get("URL"); ?>admin/actionAccountSettings" method="post">
                        <td><input type="number" name="suspension" /></td>
                        <td><input type="checkbox" name="softDelete" <?php if ($user->user_deleted) { ?> checked <?php } ?> /></td>
                        <td>
                            <input type="hidden" name="user_id" value="<?= $user->user_id; ?>" />
                            <input type="submit" />
                        </td>
                    </form>
                </tr>
            <?php } ?>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-header" data-background-color="red">
        <h4 class="title">Edit Profile</h4>
        <p class="category">Make it your own</p>
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
              <div class="col-md-12">
                <div class="form-group label-floating is-empty">
                  <label class="control-label">Voornaam</label>
                  <input class="form-control" type="text" name="first_name" required />
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group label-floating is-empty">
                  <label class="control-label">Achternaam</label>
                  <input class="form-control" type="text" name="last_name" required />
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
