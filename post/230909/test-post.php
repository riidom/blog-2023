<?php
include_once '../../php/_misc.php';
$lang = lang();

$date = '230909';
$name = 'test-post';
?>

<?=post_begin("${date}")?>
  <?php include "$name.$lang.php"?>
<?=post_end()?>
