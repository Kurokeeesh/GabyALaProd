<section class="contact">
  <h1>Contacte-moi</h1>
  <p>Tu veux poser sur une prod, collaborer ou juste échanger ? Remplis ce formulaire :</p>

  <form id="contact-form">
    <input type="text" name="nom" placeholder="Ton nom" required>
    <input type="email" name="email" placeholder="Ton email" required>
    <textarea name="message" placeholder="Ton message..." required></textarea>
    <button type="submit">Envoyer</button>
  </form>

  <p id="success-message" class="info" style="display: none;">✅ Ton message a bien été envoyé !</p>
</section>

<script>
document.querySelector("#contact-form").addEventListener("submit", async function(e) {
  e.preventDefault();

  const form = e.target;
  const data = new FormData(form);
  const url = "https://formspree.io/f/mldbngba"; // ← Remplace par ton lien Formspree

  const response = await fetch(url, {
    method: "POST",
    headers: { 'Accept': 'application/json' },
    body: data
  });

  if (response.ok) {
    form.reset();
    document.querySelector("#success-message").style.display = "block";
  } else {
    alert("Une erreur est survenue. Essaie à nouveau plus tard.");
  }
});
</script>
