INSERT INTO utilisateurs (id_utilisateur, nom_utilisateur, email, mot_de_passe) VALUES (1, 'John Doe', 'john@example.com', 'password123');
INSERT INTO categories (id_categorie, nom_categorie, description) VALUES (1, 'Moteurs', 'Composants relatifs aux moteurs automobiles');
INSERT INTO composantes (id_composante, nom_composante, description, id_categorie, prix, fabricant) VALUES (1, 'Piston', 'Composant du moteur à combustion interne', 1, 50.00, 'ACME Motors');
INSERT INTO commentaires (id_commentaire, id_utilisateur, id_composante, texte) VALUES (1, 1, 1, 'Excellent produit, fonctionne très bien !');
