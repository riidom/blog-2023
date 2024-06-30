<?php
$blog_info = [

  'logo_svg' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 12H12.5C14.9853 12 17 9.98528 17 7.5C17 5.01472 14.9853 3 12.5 3H6V12ZM6 12H13.5C15.9853 12 18 14.0147 18 16.5C18 18.9853 15.9853 21 13.5 21H6V12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>',

  'title_rss' => 'RSS for the blog',

  'url_rss' => 'https://blog.url/feed.xml',

  'title_prefix' => 'blogathing',

  'author_email' => 'blog-at-domain-dot-url',

  'profile_links' => [
    [
      'name' => 'Some Social Media',
      'link_text' => '@me@some.social.media',
      'link_url' => 'https://some.social.media/@me'
    ],
    [
      'name' => 'Other Website',
      'link_text' => 'example.com/myusername',
      'link_url' => 'https://example.com/myusername'
    ],
  ],

  'meta_tags_post_only' => [
    '<meta property="fediverse:creator" content="@yourName@mastodon.instance">',
  ],

  'meta_tags_index_only' => [],
];