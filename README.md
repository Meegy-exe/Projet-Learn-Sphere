# LearnSphere - Plateforme E-Learning & Moteur de Quiz adapté au besoin
Plateforme d'e-learning développée dans le cadre du projet LearnSphere à Epitech. Ce site accompagne les futurs étudiants avec des cours et des quiz interactifs sur la pédagogie et la vie à l'école.

## Crédits
* [Alison Dehaies](https://github.com/Meegy-exe) - Développeur WordPress - co-conception du moteur de quiz (PHP / JS) & Développeur Frontend
* [Magda Boughezal](https://github.com/) - Développeur WordPress - co-conception du moteur de quiz (PHP / JS)

## Stack Technique
CMS : WordPress 6.x.  

Thème Parent : Consultancy Firm.  

Langages : PHP (Moteur de quiz), JavaScript (Interactivité), CSS3 (Thème enfant).  

Base de données : MySQL via phpMyAdmin.  

Outils de dev : Git, ACF Pro

## Architecture du Plugin "LearnSphere Quiz"
Nous avons développé un plugin sur-mesure pour répondre aux besoins spécifiques de la plateforme :
- Custom Post Types (CPT) : Création d'un type de contenu "Quiz" dédié.
- Advanced Custom Fields (ACF) : Structuration des questions/réponses via des champs répéteurs.
- Moteur de calcul JavaScript : Validation des scores en temps réel sans rechargement de page pour une meilleure UX.

## Architecture du Thème : Consultancy Firm (Child Theme)
Pour personnaliser l'apparence et les fonctionnalités du site tout en garantissant sa maintenabilité, nous avons mis en place un thème enfant.  

    Pourquoi un thème enfant ?
Pérennité des modifications : Les personnalisations (CSS, PHP) ne sont pas écrasées lors des mises à jour du thème parent.  

    Surcharge de templates : 
Nous avons pu modifier la structure de la barre latérale (sidebar.php) pour y intégrer nos filtres dynamiques sans altérer le code source original.

    Organisation des ressources :
 Centralisation de nos styles personnalisés dans un dossier dédié /assets/css/ pour une meilleure clarté.

    Structure des fichiers ajoutés functions.php : 
Coeur du thème enfant, gérant le chargement conditionnel des styles et des scripts.

    style.css : 
Déclarations de base du thème enfant et imports du thème parent.

    sidebar.php :
Version modifiée pour inclure la logique de filtrage des Cours et des Quiz.

    /assets/css/quiz-cours.css : 
Style dédié aux interfaces de filtrage pédagogiques.

## Installation & Configuration Wordpress
Le projet repose sur un environnement WordPress complet. Suivez ces étapes pour déployer la plateforme sur votre machine.

### 1. Prérequis
Un serveur local (Local WP, Laragon, MAMP ou XAMPP) avec PHP 8.x et MySQL.

Un client Git.

### 2. Déploiement des fichiers
Clonez le dépôt dans le dossier racine de votre serveur local (ex: www/ ou public_html/) :
`git clone CléSSH`

### 3. Configuration de la Base de Données
Créez une base de données vide nommée learnsphere via phpMyAdmin.

Importez le fichier db_export.sql fourni dans le projet pour récupérer les contenus (cours, quiz, réglages ACF).

### 4. Liaison avec WordPress
Renommez le fichier wp-config-sample.php en wp-config.php.

Modifiez les accès à la base de données :
`define( 'DB_NAME', 'learnsphere' );`
`define( 'DB_USER', 'votre_utilisateur' );` 
`define( 'DB_PASSWORD', 'votre_mdp' );`

### 5. Finalisation
Connectez-vous à l'administration (/wp-login.php) avec les identifiants fournis dans le dossier de rendu.
Note : Si les URLs ne fonctionnent pas, utilisez le plugin "Better Search Replace" ou modifiez siteurl et home dans la table wp_options pour correspondre à votre URL locale.


## Sécurité et Intégrité du Code
Nous avons veillé à la sécurisation du plugin  :

- Protection des accès directs : 
    Chaque fichier PHP débute par une vérification de la constante ABSPATH. Cela bloque toute tentative d'exécution de script par un utilisateur tentant d'accéder directement aux fichiers du plugin via une URL.

- Prévention des failles XSS (Cross-Site Scripting) :
    Utilisation systématique de la fonction native esc_html() lors de l'affichage des questions et des réponses. Cela neutralise toute injection de code malveillant en transformant les balises HTML suspectes en texte inoffensif.

- Sanitisation des Entrées (Input Validation) : 
    Utilisation de absint() (Absolute Integer) pour traiter l'ID du quiz récupéré via le shortcode. Cela garantit que la donnée manipulée est obligatoirement un nombre entier positif, empêchant les injections de texte inattendu.

- Protection contre les Injections SQL : 
    Le système a été conçu pour traiter les scores localement dans le navigateur. Aucune donnée de quiz n'étant envoyée ou stockée en base de données lors de la soumission, le risque d'injection SQL est réduit à zéro par design.

- Sécurisation de l'Administration : 
    La saisie des données est confiée à ACF, qui intègre nativement des filtres de nettoyage des données (sanitization) avant tout enregistrement en base de données.

## ⚠️ Note sur la gestion du dépôt
Pour les besoins de l'évaluation pédagogique, ce dépôt contient l'intégralité de l'environnement WordPress (Core, Plugins tiers et fichiers de configuration).

Pourquoi ce choix ?
Conformément aux attentes du projet LearnSphere, l'objectif est de fournir un environnement immédiatement fonctionnel après clonage. Cela permet au jury de constater l'intégrité de la plateforme, incluant la configuration fine des plugins de sécurité et d'optimisation (Wordfence, Autoptimize, WP Super Cache) sans avoir à les réinstaller manuellement.

***Ce qui ne devrait normalement pas être versionné :***
Dans un cadre professionnel réel, les éléments suivants figureraient dans le .gitignore pour des raisons de sécurité et de poids :

    - export .sql :
    Contenu : contient tous les textes, réglages de thèmes et types de contenus personnalisés (quiz_learnsphere et cours).

    - wp-admin/ & wp-includes/ :
    Ce sont les fichiers natifs de WordPress. On les installe normalement via WP-CLI ou un téléchargement officiel.

    - wp-content/plugins/ (tiers) : 
    On utilise généralement Composer pour gérer les dépendances externes.

    - .htaccess : 
    Fichier de configuration serveur propre à l'hébergeur.

    - *.log : 
    Journaux d'erreurs pouvant contenir des chemins serveurs sensibles.

## Guide d'administration (Contenus)
La plateforme a été pensée pour une autonomie totale du client, sans connaissances techniques.  

### Ajouter un Cours
Se rendre dans l'onglet Cours.

Renseigner le titre, le contenu et l'image mise en avant.

Configurer le niveau de difficulté via l'interface ACF dédiée.  

Publier : le cours s'ajoute automatiquement à la liste et à la page d'accueil.  

### Créer un Quiz interactif
Se rendre dans l'onglet Quiz.

Utiliser le champ Répéteur ACF pour ajouter autant de questions que souhaité.  

Pour chaque question : saisir l'intitulé, les options de réponses et désigner la réponse correcte.

Le plugin "LearnSphere Quiz" génère automatiquement l'interface interactive côté client.



## Extensions installées
### Sécurité
- WPS Hide Login
    Sert à modifier l'URL /wp-admin pour bloquer les tentatives de hack.

- Wordfence Security 
    Pour le pare-feu et le scan de sécurité du site.

- WP Armour - Honeypot Anti Spam
    Pour bloquer les spams sans utiliser de Captcha visuel, ce qui est mieux pour l'accessibilité.

- Akismet Anti-spam
    Protection supplémentaire de niveau serveur contre le spam dans les commentaires et formulaires.

### Perfomances & Optimisation
- WP Super Cache 
    Système de mise en cache statique indispensable pour réduire le temps de chargement des pages et la charge serveur, comme exigé par le cahier des charges.

- Smush
    Optimisation, compression et redimensionnement automatique des images uploadées pour garantir une fluidité de navigation maximale.

- Autoptimize (RECOMMANDÉ)
    Optimise le site en agrégeant et en minifiant les scripts (JS) et les styles (CSS) pour limiter le nombre de requêtes HTTP.

### Référencement (SEO)
- Yoast SEO
    Outil d'analyse sémantique fournissant des conseils de rédaction en temps réel (lisibilité et mots-clés) pour optimiser le contenu pédagogique.

### Expérience Utilisateur & Fonctionnalités
- WPForms
    Constructeur de formulaires par "glisser-déposer" utilisé pour la page de contact (Nom, Email, Message).

- WP Go Maps
    Intégration d'une carte interactive personnalisée pour localiser le siège social de LearnSphere.

- MailPoet
    Solution de marketing par courriel intégrée pour gérer la newsletter et l'automatisation des envois lors de la publication de nouveaux cours.

- Advanced Custom Fields (ACF)
    Pilier central du moteur de quiz pour la création de champs structurés et dynamiques.

- Page Links To
    Permet de rediriger des pages ou articles vers des URLs spécifiques, utile pour la gestion des ressources externes.

- Complianz
    Pour être en règle avec la loi (RGPD/Cookies).

- Loco translate
    Permet de traduire tout le site dans une seule et même langue.
