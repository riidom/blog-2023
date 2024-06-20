
<?php include_once 'php/misc.php'?>
<?php include_once 'post/blog_info.php'?>

<?=head_and_header(string('about'), '.');?>

  <main>
    <p>Email: <?=$blog_info['author_email']?></p>
    <p>RSS: <a href="<?=$blog_info['url_rss']?>">Feed</a></p>
    <p>Socials:
      <a href="<?=$blog_info['profilepage_mastodon']?>" target="_blank">Mastodon</a>
    </p>
    <p><?=string('imprint')?></p>
  </main>

</body>
</html>
