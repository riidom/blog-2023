<h2>Probably not read-worthy</h2>

<h3>But I need a bunch of posts...</h3>

<h4>...to test the start page with the post list</h4>

<p>This is quite the <a href="#">ugly entrance</a> into the post, but you should've been warned by now. Here I need some paragraph that is at least two lines of text. This should be sufficient.</p>

<h2>Probably not read-worthy</h2>

<p>This is quite the ugly entrance into the post, but you should've been warned by now. Here I need some paragraph that is at least two lines of text. This should be sufficient.</p>

<h3>But I need a bunch of posts...</h3>

<p>This is quite the ugly entrance into the post, but you should've been warned by now. Here I need some paragraph that is at least two lines of text. This should be sufficient.</p>

<h4>...to test the start page with the post list</h4>

<?=p_note(
  "This is an paragraph which is pretty long, and also has additional notes on the side (or below, depending on if you are on desktop or mobile view currently). Should have plenty of lines, I will probably just copy paste this non-sense. This is an paragraph which is pretty long, and also has additional notes on the side (or below, depending on if you are on desktop or mobile view currently). Should have plenty of lines, I will probably just copy paste this non-sense. This is an paragraph which is pretty long, and also has additional notes on the side (or below, depending on if you are on desktop or mobile view currently). Should have plenty of lines, I will probably just copy paste this non-sense. This is an paragraph which is pretty long, and also has additional notes on the side (or below, depending on if you are on desktop or mobile view currently). Should have plenty of lines, I will probably just copy paste this non-sense.",
  "Additional notes that don't quite fit into the main flow of the post, but are still worth to keep. Web links with further info are a great thing to put here, for example.",
  "start"
)?>

<h2>How is the H2 between two paragraphs?</h2>

<?=img("${date}/header-bg.webp", 1920, 128, 'old header banner graphic', 'I digged that out from some old folder, was for a website that either never went online or is long defunct by now. Really just an example, also it is very oblong, so good for testing some display edge cases probably.')?>

<h3>How is the H3 between two paragraphs?</h3>

<?=p_note(
  "This is an paragraph which is pretty long, and also has additional notes on the side (or below, depending on if you are on desktop or mobile view currently). Should have plenty of lines, I will probably just copy paste this non-sense.",
  "Additional notes that don't <a href='#'>quite fit</a> into the main flow of the post, but are still worth to keep. Web links with further info are a great thing to put here, for example."
)?>

<p>And now the same image, but without caption:</p>

<?=img("${date}/header-bg.webp", 1920, 128, 'same old header banner graphic')?>
