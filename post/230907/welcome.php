<?php
include_once '../../php/_misc.php';
$lang = lang();

$date = '230907';
$name = 'welcome';
?>

<?=post_begin("${date}")?>
  <?php include "$name.$lang.php"?>
<?=post_end()?>
