
<?php include_once 'php/misc.php'?>
<?php include_once 'post/blog_info.php'?>

<?=head_and_header('', string('about'), '.');?>

  <main>
    <p>Email: <?=$blog_info['author_email']?></p>
    <p>RSS: <a href="<?=$blog_info['url_rss']?>">Feed</a></p>
    <p><?=string('elsewhere')?></p>
    <ul class="about__link-list">
      <?php foreach ($blog_info['profile_links'] as $item) {
        echo '<li><p>'
        . $item['name'] . ': '
        . '<a href="' . $item['link_url'] . '" target="_blank">'
        . $item['link_text']
        . '</a></p></li>';
      }?>
    </ul>
    
    
    <p class="about__imprint"><?=string('imprint')?></p>
  </main>

</body>
</html>
