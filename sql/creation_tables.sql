CREATE TABLE utilisateurs (
    id_utilisateur  NUMBER PRIMARY KEY,
    nom_utilisateur VARCHAR2(100) NOT NULL,
    email           VARCHAR2(100) NOT NULL,
    mot_de_passe    VARCHAR2(100) NOT NULL,
    role            VARCHAR2(20) DEFAULT 'user'
);

CREATE TABLE categories (
    id_categorie   NUMBER PRIMARY KEY,
    nom_categorie  VARCHAR2(100) NOT NULL,
    description    VARCHAR2(255)
);

CREATE TABLE composantes (
    id_composante   NUMBER PRIMARY KEY,
    nom_composante  VARCHAR2(100) NOT NULL,
    description     VARCHAR2(255),
    id_categorie    NUMBER,
    prix            NUMBER(10, 2),
    fabricant       VARCHAR2(100),
    FOREIGN KEY (id_categorie) REFERENCES categories(id_categorie)
);

CREATE TABLE commentaires (
    id_commentaire   NUMBER PRIMARY KEY,
    id_utilisateur   NUMBER,
    id_composante    NUMBER,
    texte            VARCHAR2(1000),
    date_commentaire TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur),
    FOREIGN KEY (id_composante) REFERENCES composantes(id_composante)
);
