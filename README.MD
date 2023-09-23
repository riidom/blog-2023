# My super simple blog setup

- write html yourself
- use some php helper functions
- made for simple shared hosts: no build, no deploy, just push changed files via FTP
- zero JS; language and theme handling only via browser preferences

## Develop / write

- start a local server (`$: php -S localhost:3000`) and do a manual reload in browser on change
- if you use git, the list of modified files is useful to see what you have to push to server (do before wrapping up your commit)
- if you write content, check for layout breaks on long descriptions etc., it's not fool-proof

## Writing a new post

Four blog posts and some media are included as demo content. Feel free to change or delete. 

### About post metadata

- each post has a `date`, a `name`, a `title`, a `teaser`
- also, each post has a sub-directory named after the `date`, inside the `post` folder and some data stored in `_metadata.php`
- with the current system, you can only have one blog post per day!

### Post files

Ignoring the image, there is one boilerplate post file (`{name}.php`) and then one for each language (`{name}.{language}.php`). Copy the boilerplate one from another post and change the middle part, `$date` and `$name`. Date must be same as the directory, name must be same as the filenames. And name will also be part of the URL, so stick with lowercase letters and dashes.

There is no check or fallback for missing translations, you have to commit to the languages you want to support. Visitors will just see a `404` when a blog post file is missing.

- noteworthy: `p_note()` (see test-post for usage and effect and `_misc.php` for definition)

### Update `_metadata.php`

Copy one of the existing blocks inside `$blog_titles`, and change the date and name according to the steps before, then set `'title'` and `'teaser'` text per language.

You can use `<br>` inside the title, to style the appearance on the blog index page. The tag will be stripped on the actual post page, where the title appears as heading without extra line breaks. For both `title` and `teaser` you can use soft hyphens (`&shy;`) to improve visuals for the blog index page.

### Teaser image

- file name is the post `name` and `.webp` extension
- 304 x 112 px
- the center will be occupied by text

### RSS: Update `feed.xml`

Update texts and URLs in `<title>` section.
Add this on top, below `<title>` section. 
```
<item>
  <title>YOUR TITLE HERE</title>
  <pubDate>Sun, 10 Sep 2023 15:00:00 +0200</pubDate>
  <link>https://YOUR.URL/blog/{date}/{name}.php</link>
  <guid>https://YOUR.URL/blog/{date}/{name}.php</guid>
  <description>{teaser}</description>
</item>
```
You can delete older entries so a new subscriber will only see the last _n_ entries. 

## Personal data

- in `index.php` change email and social media links
- in `header.php` change blog name
- in `_misc.php` -> `html_head()` change `<title>` tag


## Multi-language setup

### Just english: the easy way

- in `_misc.php` -> `lang()`, always return `'en'`
- in your post folder, just have `{name}.php`, `{name}.en.php`, `{name}.webp`
- in `_metadata.php`, just have a `'en' => [ ... ]` entry per date/post

### Different/more languages

Extend/change the array in `lang()`, add the corresponding `{name}.xy.php` file and the extra key in `$blog_titles`.

## Theming

Assuming you just want to change the colors, there is a set of color definitions for a dark theme (also the default) and a light theme (if `prefers-color-scheme: light`).

### CSS custom properties

Most things are defined on top of the `style.css` file, some specific `rem`'s are spread throughout the file though.