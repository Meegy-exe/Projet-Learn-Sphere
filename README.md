# LearnSphere - Guide de survie Epitech
Plateforme d'e-learning développée dans le cadre du projet LearnSphere à Epitech. Ce site accompagne les futurs étudiants avec des cours et des quiz interactifs sur la pédagogie et la vie à l'école.

## Crédits
* [Alison Dehaies](https://github.com/Meegy-exe) - Développeur WordPress - co-conception du moteur de quiz (PHP / JS) & Développeur Frontend
* [Magda Boughezal](https://github.com/) - Développeur WordPress - co-conception du moteur de quiz (PHP / JS)


## Architecture du Plugin "LearnSphere Quiz"
Nous avons développé un plugin sur-mesure pour répondre aux besoins spécifiques de la plateforme :
- Custom Post Types (CPT) : Création d'un type de contenu "Quiz" dédié.
- Advanced Custom Fields (ACF) : Structuration des questions/réponses via des champs répéteurs.
- Moteur de calcul JavaScript : Validation des scores en temps réel sans rechargement de page pour une meilleure UX.

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