
*See `RELEASE.md` for upcoming changes*

# My super simple blog setup

- write html yourself
- use some php helper functions like they are components
- made for simple shared hosts: no build, simplest deploy: just push changed files via FTP
- zero JS, zero dependencies; language and theme handling only via browser preferences

## Checklist for writing a new post

1. update `post/metadata.php` with date, name, and per language: title and teaser
2. create new directory in `post/` named after date (e.g. `221031/`), inside:
    1. add teaser image, named `{name}.webp`
    2. from old post, copy boilerplate php and rename to `{name}.php`
    3. add content php's per language `{name}.{lang}.php`
3. update `feed.xml`
4. push to your server: new directory, updated `metadata.php` & `feed.xml`

_For details, see below._

## License

The blog software is MIT, the example content text is CC-0, the example media for the blog and posts, including the teaser images, is also CC-0.

The license for the font can be found as PDF in the `fonts` directory, or read online at https://brailleinstitute.org/wp-content/uploads/2020/11/Atkinson-Hyperlegible-Font-License-2020-1104.pdf.

## Initial setup / Develop / Write

I have some difficulties to keep the demo content intact, but off my actual website, and keep future, "real" content off the git repo. Unfortunately, my clunky workaround means for you:

- first clone the repo, or download the .zip
- rename `post_demo` directory to `post`
- inside the just renamed `post` directory:
  - rename `metadata_demo.php` to `metadata.php`
  - rename `blog_info_demo.php` to `blog_info.php`
- finally rename`feed_demo.xml` to `feed.xml`

Once this is sorted out (or you just created your own content and are using demo stuff just for reference):

- start a local server (`$: php -S localhost:3000`) and do a manual reload in browser on change
- if you use git, the list of modified files is useful to see what you have to push to server
- if you write content, check for layout breaks on long descriptions etc., it's not fool-proof

### .htaccess and mod_rewrite

Since after `v1.0.0`, there will be a `.htaccess` to hide the `.php` in URLs. This checks for server URL, so on `127.0.0.1` it will still show the `.php`. If this causes you trouble for some reason, look in `misc.php` for the function `get_ext()`, comment everything out and de-comment the line that returns just the static string.

## Writing a new post

Four blog posts and some media are included as demo content. Feel free to change or delete. 

### About post metadata

Each post has a `date`, a `name`, a `title`, a `teaser`. These are defined in `post/metadata.php`.

The date is the core identifier, which means you can have only one blog post per day. The name is also the slug. Both date and name are localization-independent.

Title and teaser need to be defined per language. See array structure in `post/metadata.php`.

### Post files

In `post/`, create a sub-directory named after the post's date in `yymmdd` format. Inside, there needs to be:

- a teaser image (see below)
- a boilerplate php file (`{name}.php`). Copy as-is from other posts, or from the reference sub-section below
- a content php file per language (`{name}.{language}.php`)
  - start the content with a `<h2>` tag, let it play nice with the post title (which will be the `h1`, right above it!)
  - also see content functions below

There is no check or fallback for missing translations, you have to commit to the languages you want to support. Visitors will just see a `404` when a blog post file is missing.

#### Content functions

For details, see the beginning of `php/misc.php` for available content functions to use, and the demo content for example usage. Otherwise, here a short list:

- `img($file, $width, $height, $alt="", $caption="")`: Displays an image, with optional caption, and builtin link to open full-size in a new tab.
- `video($file, $width, $height, $alt="")`: Displays a self-hosted video file.
- `p_note($copy, $note, $side = "end")`: Shows an ordinary `<p>` with the `$copy`, but with a `$note` text on one side of the main area (`$side = "start"` or `"end"`, depending on your local translates to left or right side). On mobile/tablet, it turns into a summary/detail element below the parapgraph.

#### Boilerplate PHP for posts
```php
<?php
include_once '../../php/misc.php';
['date' => $date, 'name' => $name, 'lang' => $lang] = get_post_meta(getcwd());
?>

<?=post_begin("${date}")?>
  <?php include "$name.$lang.php"?>
<?=post_end()?>
```

### Update `metadata.php`

Copy one of the existing blocks inside `$blog_titles`, and change the date and name according to the steps before, then set `'title'` and `'teaser'` text per language.

You can use `<br>` inside the title, to style the appearance on the blog index page. The tag will be stripped on the actual post page, where the title appears as heading without extra line breaks. For both `title` and `teaser` you can use soft hyphens (`&shy;`) to improve visuals for the blog index page.

### Teaser image

- file name is the post `{name}` and `.webp` extension
- 304 x 112 px
- the center will be occupied by text

### RSS: Update `feed.xml`

Update texts and URLs in `<title>` section.
Add this on top, below `<title>` section. 
```xml
<item>
  <title>YOUR TITLE HERE</title>
  <pubDate>Sun, 10 Sep 2023 15:00:00 +0000</pubDate>
  <link>https://YOUR.URL/blog/{date}/{name}</link>
  <description>{teaser}</description>
</item>
```
You can delete older entries so a new subscriber will only see the last _n_ entries.

You can see the `pubDate` if you go to the post, open devtools and copy the contents of the very first `<p hidden>` inside the `<main>`.

__ATTENTION:__ If you work locally, make sure to not accidentally copy a localhost-URL into your feed file!

## Personal data

 Everything is bundled in `post/blog_info.php`.

## Multi-language setup

### Just english: the easy way

- in `misc.php` -> `lang()`, always return `'en'`
- in your post folder, just have `{name}.php`, `{name}.en.php`, `{name}.webp`
- in `metadata.php`, just have a `'en' => [ ... ]` entry per date/post

### Different/more languages

Extend/change the array in `lang()`, add the corresponding `{name}.xy.php` file and the extra key in `$blog_titles`. This is the simple version here, there is no difference between e.g. `pt-BR` and `pt-PT`, just use `pt`.

## Theming

Assuming you just want to change the colors, there is a set of color definitions for a dark theme (also the default) and a light theme (if `prefers-color-scheme: light`).

### CSS custom properties

Most things are defined on top of the `style.css` file, some specific `rem`'s are spread throughout the file though.