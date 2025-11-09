J’ai créer une table utilisateurs qui est très complete pour pouvoir completer la feuillle profil 

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(50) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    ville VARCHAR(100),
    latitude DECIMAL(10,6),
    longitude DECIMAL(10,6),
    date_naissance DATE NULL,
    bio TEXT NULL,
    image_profil VARCHAR(255) DEFAULT 'default.png',
    role ENUM('utilisateur', 'admin') DEFAULT 'utilisateur',
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);

page à créer pour la partie front (php) voir si c’est possible que en html
- inscription (formulaire)
- connexion (formulaire)
- profil (affichage des informations des utilisateurs + modifications parametres)
- ne pas oublier de mettre un bouton sur deconnxion sur la page profil

partie interac (js)
- connexion (Envoie le formulaire de connexion au back)
- inscription 
- profil (Charge et modifie les infos utilisateur)
- deconnexion

voir option mdp oublié 
