      <!-- echo out the system feedback (error and success messages) -->
      <?php $this->renderFeedbackMessages(); ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header" data-background-color="red">
                <h4 class="title">Profiel</h4>
                <p class="category">Hier kunt u alle gebrukers in het systeem zien</p>
            </div>
            <div class="card-content table-responsive">
              <table class="overview-table table">
                  <thead class="text-primary">
                  <tr>
                      <td>Id</td>
                      <td>Avatar</td>
                      <td>Gebruikersnaam</td>
                      <td>Email</td>
                      <td>Account actief</td>
                      <td>Gebruikers profiel</td>
                  </tr>
                  </thead>
                  <?php foreach ($this->users as $user) { ?>
                      <tr class="<?= ($user->user_active == 0 ? 'inactive' : 'activated'); ?>">
                          <td><?= $user->user_id; ?></td>
                          <td class="avatar">
                              <?php if (isset($user->user_avatar_link)) { ?>
                                  <img src="<?= $user->user_avatar_link; ?>" />
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
                      </tr>
                  <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
</main>
