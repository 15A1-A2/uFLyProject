<?php $this->renderFeedbackMessages(); ?>
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header" data-background-color="red">
        <h4 class="title">Organisatie Dashbaord</h4>
        <p class="category">Hier kunt u alle domein beheren</p>
      </div>

      <div class="card-content table-responsive">
        <table class="overview-table table display" cellspacing="0" width="100%">
          <thead class="text-primary">
            <tr>
              <!-- <td>id</td> -->
              <td>domein</td>
              <td>verwijder</td>
            </tr>
          </thead>
      <?php foreach ($this->domains as $domain) { ?>
          <tr>
            <td><?= $domain->org_name; ?></td>
            <td></td>
          </tr>
      <?php } ?>

        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-header" data-background-color="red">
        <h4 class="title">Voeg domeinnaam toe van de organisatie</h4>
        <p class="category">Hier kunt u alle domein beheren</p>
      </div>

      <div class="card-content table-responsive">
        <form action="<?php echo Config::get('URL'); ?>admin/domainNameAction" method="post">
          <div class="col-md-12">
            <div class="form-group label-floating is-empty">
              <label class="control-label">@apple.com</label>
              <input class="form-control" type="text" name="domain_name" required />
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
