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
        'supports' => array('title', 'thumbnail'),
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