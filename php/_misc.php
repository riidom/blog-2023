<?php
require_once('_metadata.php');

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

function video($file) {
  // https://developer.mozilla.org/en-US/docs/Web/HTML/Element/video
  // check what attributes to set automatic, which to pass as argument
  // video will sit in post/{date}/media as the images do
}

function p_note($copy, $note, $side = "end") {
  $more = string('more');

  if (!$note) {
    return "<p>${copy}</p>";
  }

  return <<<EOP
  <section class="p-note-wide ${side}">
    <p class="copy">${copy}</p>
    <p class="note">${note}</p>
  </section>

  <section class="p-note-narrow">
    <p>${copy}</p>
    <details>
      <summary>
        {$more}
      </summary>
      <p>${note}</p>
    </details>
  </section>
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

/*
  gets a localized string from _metadata.php
*/
function string($id) {
  global $string;
  return $string[$id][lang()];
}

/*
  returns prettified date from YYMMDD
*/
function prettify_date($date) {
  global $string;

  $year = '20' . substr($date, 0, 2);
  $month = substr($date, 2, 2);
  $month_str = $string['month'][lang()][(int)$month - 1];
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
  returns html: head and header tags
  they are the same on post page and index page
*/
function head_and_header($title, $path_prefix = '../..') {
  if ($title === 'Index') {
    $location = 'class="is_main"';
  }

  $head_and_header = <<<EOH
  <!DOCTYPE html>
  <html lang="$lang">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="$path_prefix/style.css">
      <link rel="icon" type="image/png" href="$path_prefix/favicon.png">
      <link rel="alternate" type="application/rss+xml"  title="RSS riidom's blog" href="/blog/feed.xml" />
      <title>riidom | $title</title>
    </head>

    <body $location>
      <header>
        <a href="/blog" class="header__link" tabindex="0">
          <span></span>
        </a>
      </header>  
  EOH;

  return $head_and_header;
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

  $head_and_header = head_and_header($title);
  
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