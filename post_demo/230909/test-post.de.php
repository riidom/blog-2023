<h2>Vermutlich nicht so lesenswert</h2>

<h3>Aber ich brauche eine Handvoll Posts...</h3>

<h4>...um die Startseite mit der Postübersicht zu testen</h4>

<p>Das ist schon mal ein <a href="#">häßlicher Einstieg</a>, aber die Warnung ist nun hoffentlich angekommen. Hier brauche ich mal einen Textabsatz der mindestens zweizeilig ist, das sollte hiermit geschafft sein.</p>

<h2>Vermutlich nicht so lesenswert</h2>

<p>Das ist schon mal ein häßlicher Einstieg, aber die Warnung ist nun hoffentlich angekommen. Hier brauche ich mal einen Textabsatz der mindestens zweizeilig ist, das sollte hiermit geschafft sein.</p>

<h3>Aber ich brauche eine Handvoll Posts...</h3>

<p>Das ist schon mal ein häßlicher Einstieg, aber die Warnung ist nun hoffentlich angekommen. Hier brauche ich mal einen Textabsatz der mindestens zweizeilig ist, das sollte hiermit geschafft sein.</p>

<h4>...um die Startseite mit der Postübersicht zu testen</h4>

<?=p_note(
  "Dies ist ein Absatz, der schön kurz und knapp ist, weil Zusatzinfos daneben stehen. Allerdings muss er schon zweizeilig sein, das ist wichtig. Dies ist ein Absatz, der schön kurz und knapp ist, weil Zusatzinfos daneben stehen. Allerdings muss er schon zweizeilig sein, das ist wichtig. Dies ist ein Absatz, der schön kurz und knapp ist, weil Zusatzinfos daneben stehen. Allerdings muss er schon zweizeilig sein, das ist wichtig.",
  "Zusätzliche Notizen, tangen tiales Zeugs was aus dem Haupttext heraus gekürzt werden sollte, worauf ich aber trotzdem nicht verzichten mag.",
  "start"
)?>

<h2>Wie sieht die H2 zwischen zwei Texten aus?</h2>

<?=img('header-bg.webp', 1920, 128, 'alte Bannergrafik', 'Das habe ich aus irgendeinem alten Ordner ausgegraben. War für eine Webseite, die entweder nie wirklich online gegangen ist, oder schon lange in Rente ist. Wirklich nur ein Beispiel, aber da es so länglich ist, gut zumk Testen.')?>

<h3>Wie sieht die H3 zwischen zwei Texten aus?</h3>

<?=p_note(
  "Dies ist ein Absatz, der schön kurz und knapp ist, weil Zusatzinfos daneben stehen. Allerdings muss er schon zweizeilig sein, das ist wichtig.",
  "Zusätzliche Notizen, <a href='#'>tangen tiales</a> Zeugs was aus dem Haupttext heraus gekürzt werden sollte, worauf ich aber trotzdem nicht verzichten mag."
)?>

<p>Und jetzt testen wir das Markup mit demselben Bild, aber ohne Caption:</p>

<?=img('header-bg.webp', 1920, 128, 'dieselbe alte Bannergrafik')?>
