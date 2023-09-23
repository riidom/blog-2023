
<?php include_once 'php/_misc.php'?>
<?=head_and_header('Index', '.');?>

  <details class="header__imprint">
    <summary  tabindex="0">§&emsp;</summary>
    <p>Email: blog-at-riidom-dot-eu</p>
    <p>RSS: <a href="https://riidom.eu/blog/feed.xml">Feed</a></p>
    <p>Socials:
      <a href="https://cohost.org/riidom" target="_blank">cohost</a>
      <a href="https://metalhead.club/@riidom" target="_blank">Mastodon</a>
      <a href="https://kbin.social/u/riidom" target="_blank">Kbin</a>
    </p>
    <p><?=string('imprint')?></p>
  </details>
  
  <main>
    <?php include_once 'php/post_list.php'?>
  </main>
</body>
</html>