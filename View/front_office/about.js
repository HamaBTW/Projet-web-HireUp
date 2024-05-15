function verif_inputs() {
    var titre = document.getElementById('titre').value.trim();
    var contenu = document.getElementById('contenu').value.trim();
    var objectif = document.getElementById('objectif').value.trim();
    var dure = document.getElementById('dure').value.trim();
    var budget = document.getElementById('budget').value.trim();

    // Expressions régulières pour valider les champs
    var chaine = /^[a-zA-Z_ ]+$/;
    var entier = /^\d+$/;

    // Valider le titre
    if (!chaine.test(titre)) {
        document.getElementById('titre_error').innerText = "Titre can only contain letters";
        return false;
    } else {
        document.getElementById('titre_error').innerText = "";
    }
    // Valider le contenu
    if (!chaine.test(contenu)) {
        document.getElementById('contenu_error').innerText = "Contenu can only contain letters";
        return false;
    } else {
        document.getElementById('contenu_error').innerText = "";
    }
    // Valider l'objectif
    if (!chaine.test(objectif)) {
        document.getElementById('objectif_error').innerText = "Objectif can only contain letters";
        return false;
    } else {
        document.getElementById('objectif_error').innerText = "";
    }
    // Valider la durée
    if (!entier.test(dure)) {
        document.getElementById('dure_error').innerText = "Dure can only contain numbers";
        return false;
    } else {
        document.getElementById('dure_error').innerText = "";
    }
    // Valider le budget
    if (!entier.test(budget)) {
        document.getElementById('budget_error').innerText = "Budget can only contain numbers";
        return false;
    } else {
        document.getElementById('budget_error').innerText = "";
    }

    return true;
}

// Fonction pour gérer le changement de fichier pour la photo de publication
function handlePhotoChange(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        const publicationPhoto = document.getElementById('publication_pic_display');
        const hiddenPublicationPhotoContainer = document.getElementById('hiddenPublicationPhotoContainer');

        // Définir la source de la photo de publication cachée
        document.getElementById('hiddenPublicationPhoto').src = e.target.result;

        // Afficher le conteneur de photo de publication caché et masquer la photo affichée
        publicationPhoto.style.display = 'none';
        hiddenPublicationPhotoContainer.style.display = 'block';
    };

    reader.readAsDataURL(file);
}
