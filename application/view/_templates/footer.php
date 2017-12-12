  </div>
</div>
<?php
$now = new DateTime();
$date = $now->getTimestamp();
 ?>
    <script src="<?php echo Config::get('URL'); ?>js/jquery-3.1.0.min.js?_=<?=md5($date)?>" type="text/javascript"></script>

    <script src="<?php echo Config::get('URL'); ?>js/bootstrap.min.js?_=<?=md5($date)?>"></script>

    <script src="<?php echo Config::get('URL'); ?>js/material.min.js?_=<?=md5($date)?>" type="text/javascript"></script>

    <script src="<?php echo Config::get('URL'); ?>js/material-dashboard.js?_=<?=md5($date)?>" type="text/javascript"></script>

    <script src="<?php echo Config::get('URL'); ?>js/script.js?_=<?=md5($date)?>" type="text/javascript"></script>

    <script src="<?php echo Config::get('URL'); ?>js/dropzone.min.js?_=<?=md5($date)?>" type="text/javascript"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js?_=<?=md5($date)?>" type="text/javascript"></script>

  </body>
</html>
<!-- navigation -->
