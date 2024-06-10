document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('form.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Empêche l'envoi classique du formulaire

            const formData = new FormData(this);
            fetch('ajouter_au_panier.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Article ajouté au panier avec succès');
                } else {
                    alert('Erreur lors de l\'ajout au panier');
                }
            })
            .catch(error => console.error('Erreur:', error));
        });
    });
});