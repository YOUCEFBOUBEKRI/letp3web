$(document).ready(function() {
    // Fonction de recherche
    $('#searchButton').click(function() {
        var searchInput = $('#searchInput').val();
        $.ajax({
            url: 'recherche.php',
            method: 'GET',
            data: { query: searchInput },
            success: function(response) {
                displaySearchResults(JSON.parse(response));
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    // Fonction pour afficher les résultats de la recherche
    function displaySearchResults(results) {
        var searchResultsDiv = $('#searchResults');
        searchResultsDiv.empty();
        // Boucle sur les résultats pour les afficher
        results.forEach(function(result) {
            searchResultsDiv.append('<p>' + result.nom_composante + '</p>');
        });
    }

    // Fonction pour afficher les détails de la composante sélectionnée
    $('#searchResults').on('click', 'p', function() {
        var componentName = $(this).text();
        $.ajax({
            url: 'details.php',
            method: 'GET',
            data: { name: componentName },
            success: function(response) {
                displayComponentDetails(JSON.parse(response));
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    // Fonction pour afficher les détails de la composante
    function displayComponentDetails(details) {
        var componentDetailsDiv = $('#componentDetails');
        componentDetailsDiv.empty();
        componentDetailsDiv.append('<h2>' + details.nom_composante + '</h2>');
        componentDetailsDiv.append('<p>Description : ' + details.description + '</p>');
        componentDetailsDiv.append('<p>Prix : ' + details.prix + '</p>');
        componentDetailsDiv.append('<p>Fabricant : ' + details.fabricant + '</p>');

        // Affichage des commentaires
        var commentsDiv = $('#comments');
        commentsDiv.empty();
        details.comments.forEach(function(comment) {
            commentsDiv.append('<p><strong>' + comment.nom_utilisateur + '</strong>: ' + comment.texte + '</p>');
        });

        // Pré-remplir le formulaire de commentaire avec l'ID de la composante
        $('#componentId').val(details.id_composante);
    }

    // Soumission du formulaire de commentaire
    $('#commentForm').submit(function(event) {
        event.preventDefault();
        
        var componentId = $('#componentId').val();
        var username = $('#username').val();
        var commentText = $('#commentText').val();

        $.ajax({
            url: 'add_comment.php',
            method: 'POST',
            data: {
                componentId: componentId,
                username: username,
                commentText: commentText
            },
            success: function(response) {
                if (response.success) {
                    alert('Commentaire ajouté avec succès !');
                    // Rafraîchir les détails de la composante pour afficher le nouveau commentaire
                    $('#searchResults').find('p:contains(' + details.nom_composante + ')').click();
                } else {
                    alert('Erreur : ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});
