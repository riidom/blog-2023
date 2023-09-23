<?php
include_once '../../php/_misc.php';
$lang = lang();

$date = '240912';
$name = 'fake';
?>

<?=post_begin("${date}")?>
  <?php include "$name.$lang.php"?>
<?=post_end()?>
