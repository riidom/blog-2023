<?php
include_once '../../php/_misc.php';
['date' => $date, 'name' => $name, 'lang' => $lang] = get_post_meta(getcwd());
?>

<?=post_begin("${date}")?>
  <?php include "$name.$lang.php"?>
<?=post_end()?>
