<?php include_once './misc.php'?>

<h1 class="post-list--h1"><?=string('post_list')?></h1>

<ul class="post-list__ul">
  <?php foreach($blog_titles as $date => $full_meta):?>
    <?php
      $meta = $full_meta[lang()];
      $name = $full_meta['name'];
      $title = $meta['title'];
      $teaser = $meta['teaser'];
    ?>

    <li class="post-card">
      <a class="post-card__link" href="post/<?=$date?>/<?=$name?>.php" tabindex="0">
        <img class="post-card__image" src="post/<?=$date?>/<?=$name?>.webp" alt="">
        <p class="post-card__title h4"><?=$title?></p>
      </a>

      <p class="post-card__teaser p-small">
        <em class="post-card__date">(<?=prettify_date($date)?>)</em>&nbsp;<?=$teaser?>
      </p>
    </li>
  <?php endforeach ?>
</ul>
