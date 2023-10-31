<?php
require_once('_metadata.php');
require_once('_strings.php');

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
  global $string;

  if ($title === 'Index') {
    $location = 'class="is_main"';
  }

  $lang = lang();
  $back_text = $string['back_to_index'][$lang];

  $head_and_header = <<<EOH
  <!DOCTYPE html>
  <html lang="$lang">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="$path_prefix/style.css">
      <link rel="icon" type="image/png" href="$path_prefix/favicon.png">
      <link rel="alternate" type="application/rss+xml" title="RSS riidom's blog" href="/blog/feed.xml" />
      <title>riidom | $title</title>
    </head>

    <body $location>
      <header>
        <a href="/blog" class="header__link" tabindex="0">

          <svg class="header__logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 313.5 50.7"><path fill="currentColor" d="M106.2 37.2c-.8 0-2.3-1-2.1-1.5.6.7 1.8 1.5 2.6.5.7-.6.5-2.1-.7-1.5a9 9 0 0 1-4.2-.9c-1-.8-2.6-1.4-2.9-2.7 1 1 2 2 3.4 2.4 1-.3 2 .6 3 .6 1.7-.3-.7-1.7-1-2.3-.6-1-2-2.4-1.8-3.2.8 1 1.4 2.3 2.5 3 1-.7-.2-2.2 0-3.2.1-.6-.4-2 .2-2.1.3.7.1-1.2.8-1.3 1.2-.7 2.5.4 3.1 1.4.7.5.8 2.2 1.6 1.9.7-.6 1.2-1.5.7-2.4 0-1.5-.7-3-1-4.3 1 1 1.2 2.7 1.7 4-.2 1.2.5 2.3.3 3.4-.8.6-1.5 1.3-1.1 2.5.5 1.3 2.4.9 3.6.8.4 0 2-1.4 1.1-.3-1.3 1.2-3.5 1.6-5 .5-1.5 0 0 1 .4 1.6.3.5.9.6 1.3.3.9.6 0 2.1-.8 1-.9-.6-2-2.3-2.8-2-.8 1.3-1.5 2.6-2.5 3.7l-.1.1z"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2.1" d="M1 1h311.5m-58 21.5c-14.6-7.3-18.8 22-2.9 18.3l2.3-.5m.6-19.8c.3 2.7 2.2 26-2.8 28a71.9 71.9 0 0 1-33.2-1.8m7.9-25.9c-8.7 0-10.2 21.9 1.1 21.1 11.4-.7 4.8-21-1.1-21zm-16-19c0 4.6-1 27-.6 38.3 0 2.2 1.9 3.4 4.2 4.6m-25.5-20.2c19-14.9 21.2 27.9-.4 15.9m.1-38.5c0 6.5-.4 34.5-.3 41m-20.7-21.5c-10-1-12 7.3-5.4 12.8 6 5 8 12.8-34.4 12.4m33.6-35c-2.2 2.4-8 4.4-6.4 9.3m-18 3.5c8-8.2 14.3-5.2 11.7 16.3m-23-15.6c15.1-14.2 11.5 8.9 11.2 16.6M123.2 21c3.3 1.1 1.3 15.2 1.4 21.4M109 19.8c-10.7-.6-12.4 21-2.2 21.2 11.3.2 12.6-20.7 2.2-21.2zm-17 4.3C80 7.6 70 55.4 91.7 38M93 1.8c0 6.5-.3 20-.6 29.1-.2 4.8-4.9 17.5 29.5 15.6m-50-24c-.2 7.3-1.3 18.5.1 19.3.7 0 2.3 0 2.8-.2m-12.3-19c.2 5.8-2.6 13.3-1 18.9.2.9 2.3 0 3 .2M47.4 25c2.2-3.7 5.1-6.7 9.7-4.6m-9.9-1.2c-.3 14.3 0 17.3-.2 23m16.6-26.8-.4 1.8m10-1.3-1.4 1.4"/></svg>
        
          <span class="header__back">$back_text</span>

        </a>
      </header>  
  EOH;
          // <img class="header__logo" src="../media/logo-riidoms-blog.svg" alt="riidom's blog">
          // #a4c7d0

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