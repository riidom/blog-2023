<?php
require_once(dirname(__FILE__) . '/../post/metadata.php');
require_once(dirname(__FILE__) . '/../post/blog_info.php');
require_once('strings.php');

function img($file, $width, $height, $alt="", $caption="") {
  if ($caption) {
    $figure_open = "<figure>";
    $figure_close = <<<EOFC
      <figcaption>$caption</figcaption>
    </figure>
    EOFC;
  }

  return <<<EOI
  $figure_open
    <a href="media/$file" class="image-link" target="_blank">
      <img src="media/$file" width=$width height=$height alt="$alt">
    </a>
  $figure_close
  EOI;
}

function download($file, $icon) {
  // use nice icon per "type"; can be file type, or find smarter taxonomy
}

function video($file, $width, $height, $alt="") {
  return <<<EOV
  <video controls preload width=$width height=$height src="media/$file" title="$alt">
  </video>
  EOV;
}

function p_note($copy, $note, $side = "end") {
  $more = string('more');

  if (!$note) {
    return "<p>${copy}</p>";
  }

  return <<<EOP
  <div class="p-note-wide ${side}">
    <p class="copy">${copy}</p>
    <aside><p class="note">${note}</p></aside>
  </div>

  <div class="p-note-narrow">
    <p>${copy}</p>
    <details role="complementary">
      <summary>
        {$more}
      </summary>
      <p>${note}</p>
    </details>
  </div>
  EOP;
}



/*---------
  HELPERS
---------*/



/*
  many times used helper to get the current language
*/

function lang() {
  $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
  $lang = in_array($lang, ['en', 'de']) ? $lang : 'en';
  return $lang;
  // return 'en';
}

function get_ext() {
  if ($_SERVER['REMOTE_ADDR'] === "127.0.0.1"): return ".php";
  else: return "";
  endif;
  // return ".php"
}

/*
  gets a localized string from strings.php
*/

function string($id) {
  global $string;

  return $string[$id][lang()];
}

/*
  returns prettified date from YYMMDD
*/

function prettify_date($date) {
  $year = '20' . substr($date, 0, 2);
  $month = substr($date, 2, 2);
  $month_str = string('month')[(int)$month - 1];
  $day = substr($date, 4, 2);
  return "{$year}-{$month_str}-{$day}";
}

function rss_date($date) {
  $year = '20' . substr($date, 0, 2);
  $month = substr($date, 2, 2);
  $day = substr($date, 4, 2);
  return date('r', mktime(15, 0, 0, $month, $day, $year));
}

/*
  return data used in post root .php
*/

function get_post_meta($cwd) {
  global $blog_titles;

  $date = array_pop(explode("/", $cwd));

  return [
    'date' => $date,
    'name' => $blog_titles[$date]['name'],
    'lang' => lang()
  ];
}

/*
  returns html for begin of post pages
*/

function post_begin($date, $path_prefix = '../..') {
  global $blog_titles;

  $lang = lang();

  $meta_full = $blog_titles[$date];
  $meta = $meta_full[$lang];

  $id = $meta_full['id'];
  $title = strip_tags($meta['title']);
  $teaser = $meta['teaser'];
  $date_pretty = prettify_date($date);
  $date_rss = rss_date($date);

  $head_and_header = head_and_header($date, $title);
  
  $begin = <<<EOH
  {$head_and_header}
      <main>
        <p hidden>$date_rss</p>
        <p class="h1-supheading">{$date_pretty}</p>
        <h1>$title</h1>
        <p class="h1-subheading">{$teaser}</p>
  EOH;

  return $begin;
}

/*
  returns html for end of post pages
*/

function post_end() {
  $end = <<<EOH
      </main>
    </body>
  </html>
  EOH;

  return $end;
}

/*
  for head_and_header():
    header logo handling index vs post
*/

function get_logo_markup($type = 'index') {
  if ($type === 'index') {
    return [
      'link_logo_open' => '<div class="header__link">',
      'link_logo_text' => '',
      'link_logo_close' => '</div>',
    ];
  } else {
    $back_text = string('back_to_index');
    return [
      'link_logo_open' => '<a href="/blog" class="header__link">',
      'link_logo_text' => '<span class="header__back">&#8627;' . $back_text . '</span>',
      'link_logo_close' => '</a>',
    ];
  }
}

/*
  for head_and_header():
    assembles <meta> tags based on array in blog_info.php
    $type be 'index' or 'post' only
*/

function meta_misc($type = 'index') {
  global $blog_info;

  $meta_string = '';
  foreach($blog_info['meta_tags_'.$type.'_only'] as $meta) {
    $meta_string .= $meta;
  }
  return $meta_string;
}

/*
  for head_and_header():
    returns opengraph stuff
*/

function get_og($date, $title) {
  global $blog_info;

  $full_url = $_SERVER['SCRIPT_URI'];
  $full_title = $blog_info['title_prefix'] . ' | ' . $title;

  if ($date !== '') {
    return <<<OG
    <meta property="og:title" content="$full_title">
    <meta property="og:type" content="article">
    <meta property="og:url" content="$full_url">
    <meta property="og:image" content="$full_url.webp">
    OG;
  } else {
    return <<<OG
    <meta property="og:title" content="$full_title">
    <meta property="og:type" content="website">
    <meta property="og:url" content="$full_url">
    OG;
  }
}

/*
  returns html: head and header tags
  they are (mostly) the same on post page and index page
*/

function head_and_header($date, $title, $path_prefix = '../..') {
  global $blog_info;

  $back_text = string('back_to_index');

  $body_class = '';
  if ($date !== '') {
    $body_class .= 'is_post ';
  } else {
    $body_class .= 'is_page ';
  }
  if ($title === 'Index') {
    $body_class .= 'is_main ';
  }
  $location = 'class="' . $body_class . '"';

  if ($title === 'Index') {
    $logo_markup = get_logo_markup('index');
    $meta = meta_misc('index');
  } else {
    $logo_markup = get_logo_markup('post');
    $meta = meta_misc('post');
  }

  $og_meta = get_og($date, $title);

  [
    'link_logo_open' => $link_logo_open,
    'link_logo_text' => $link_logo_text,
    'link_logo_close' => $link_logo_close
  ] = $logo_markup;

  $head_and_header = <<<EOH
  <!DOCTYPE html>
  <html lang="$lang">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      $meta
      $og_meta

      <link rel="stylesheet" href="$path_prefix/style.css">
      <link rel="icon" type="image/png" href="$path_prefix/favicon.png">
      <link rel="alternate" type="application/rss+xml" title="${blog_info['title_rss']}" href="/blog/feed.xml">
      <title>${blog_info['title_prefix']} | $title</title>
    </head>

    <body $location>
      <header>
        $link_logo_open
          ${blog_info['logo_svg']}  
          $link_logo_text
        $link_logo_close
      </header>  
  EOH;

  return $head_and_header;
}

