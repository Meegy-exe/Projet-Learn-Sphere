<?php
// sécurité : abspath constante définie par wordpress
// arrete le script si quelqu'un tente dacceder au fichier

if (!defined('ABSPATH')) {
    exit;
}

// création du custom post type
// (menu quiz coté WordPress)
// permet dajouter longlet quiz
function ls_register_quiz_cpt()
{
    // labels: textes qui safficheront dans le dashboard
    $labels = array(
        'name' => 'Quiz',
        'singular_name' => 'Quiz',
        'menu_name' => 'Quiz LearnSphere',
        'add_new' => 'Ajouter un Quiz',
        'add_new_item' => 'Ajouter un nouveau Quiz',
        'edit_item' => 'Modifier le Quiz',
    );

    // args: config et comportement du nouveau type de contenu
    $args = array(
        'labels' => $labels,
        // permet la visibilité de tous
        'public' => true,
        // permet davoir une page qui liste tous les quiz
        'has_archive' => true,
        // icone
        'menu_icon' => 'dashicons-welcome-learn-more',
        // par defaut affiche ce titre
        // thumbnail: permet dactiver limg
        'supports' => array('title', 'thumbnail', 'editor', 'custom-fields'),
        // modifie lurl pour afficher lurl avec quiz
        'rewrite' => array('slug' => 'quiz'),
    );

    // fonction native à wordpress, permet denregistrer le type de contenu
    register_post_type('quiz_learnsphere', $args);
}

// hook: demande a wp de lancer la function au moment de linit
add_action('init', 'ls_register_quiz_cpt');

// CATEGORIE
function ls_register_quiz_taxonomies()
{
    // taxonomie : systeme pour classer/filtrer des contenus sur le dashboard
    // GENRE
    $labels_genre = array(
        'name' => 'Genres',
        'singular_name' => 'Genre',
        'menu_name' => 'Genres',
        'all_items' => 'Tous les Genres',
        'add_new_item' => 'Ajouter un nouveau Genre',
    );

    // hierarchical : permet de faire des sous categories
    // le mettre en true permet de creer des cases à cocher
    $args_genre = array(
        'hierarchical' => true,
        'labels' => $labels_genre,
        'show_ui' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'genre-quiz'),
    );

    // associe les genres au cpt quiz
    register_taxonomy('ls_quiz_genre', 'quiz_learnsphere', $args_genre);

    // DIFFICULTE
    $labels_niveau = array(
        'name' => 'Niveaux de difficulté',
        'singular_name' => 'Niveau de difficulté',
        'menu_name' => 'Niveaux de difficulté',
        'all_items' => 'Tous les Niveaux',
        'add_new_item' => 'Ajouter un nouveau Niveau',
    );

    $args_niveau = array(
        'hierarchical' => true,
        'labels' => $labels_niveau,
        'show_ui' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'niveau-quiz'),
    );

    // associe la difficulté au cpt quiz
    register_taxonomy('ls_quiz_niveau', 'quiz_learnsphere', $args_niveau);
}
// cree les taxo au moment de linitiation
add_action('init', 'ls_register_quiz_taxonomies');

// hook : wordpress utilise ce filtre pour mettre le contenu de la fonction avan tdafficher la page
add_filter('the_content', 'ls_add_quiz_meta_automatically');
// ajoute les metadonnées (genre, difficulte)
// param string $content : content original de la page
// return le contenu modifié par le code
function ls_add_quiz_meta_automatically($content)
{
    // is_singular : verifie la page si luser se trouve sur la page specific dun quiz
    // SIL est dessus alors
    if (is_singular('quiz_learnsphere')) {
        // get the terms: recuperer les taxonomies (difficulte)
        $niveaux = get_the_terms(get_the_ID(), 'ls_quiz_niveau');
        // est ce que la var contient des data et quil ya pas derreur
        // si oui recupere la data
        // sinon met undefined
        $difficulte = ($niveaux && !is_wp_error($niveaux)) ? $niveaux[0]->name : 'Non définie';
        $genres = get_the_terms(get_the_ID(), 'ls_quiz_genre');
        $categorie = ($genres && !is_wp_error($genres)) ? $genres[0]->name : 'Général';
        // get the terms: recuperer les taxonomies (date du post)
        $date = get_the_date();
        // structure html
        $quiz_meta = '
        <div class="quiz-meta-container">
            <p class="quiz-meta-description">
                Testez vos connaissances et validez vos acquis sur ce module en répondant aux questions ci-dessous.
            </p>
            
            <hr class="quiz-meta-separator">
            
            <div class="quiz-meta-details">
                <span class="quiz-meta-item"><strong>Niveau :</strong> ' . esc_html($difficulte) . '</span>
                <span class="quiz-meta-item"><strong>Thématique :</strong> ' . esc_html($categorie) . '</span>
                <span class="quiz-meta-item"><strong>Publié le :</strong> ' . $date . '</span>
            </div>
        </div>';

        // placement dans le contenu
        return $quiz_meta . $content;
    }
    // si pas page quiz return content originel
    return $content;
}