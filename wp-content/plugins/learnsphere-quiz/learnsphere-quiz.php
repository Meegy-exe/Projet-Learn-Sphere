<?php
/**
 * Plugin Name: LearnSphere Quiz
 * Description: Système de quiz interactif pour la plateforme LearnSphere, incluant des Custom Post Types et une gestion via ACF
 * Version: 1.3
 * Author: Meegy & Magda
 */

// master dicte quels fichiers lancés pour le plugin


// sécurité : abspath constante définie par wordpress
// arrete le script si quelqu'un tente dacceder au fichier

if (!defined('ABSPATH')) {
    exit;
}

// constante pour les shortcuts
// evite la répétition de chemin

// défini le chemin
define('PATH_LEARNSPHERE_QUIZ', plugin_dir_path(__FILE__));
// défini lurl
define('URL_LEARNSPHERE_QUIZ', plugin_dir_url(__FILE__));

// import des fichiers (master)
// permet la création du menu quiz
require_once PATH_LEARNSPHERE_QUIZ . 'includes/cpt.php';
// permet laffichage du quiz
require_once PATH_LEARNSPHERE_QUIZ . 'includes/shortcode.php';

// ajout script css et js
function ls_quiz_enqueue_assets() {
    // charge css
    wp_enqueue_style('ls-quiz-style', URL_LEARNSPHERE_QUIZ . 'assets/style.css');
    // charge le fichier js
    // en paramètre nom, url dépendances, v, charger dans le footer
    wp_enqueue_script('ls-quiz-script', URL_LEARNSPHERE_QUIZ . 'assets/script.js', array(), '1.0', true);
}

// met la fonction au moment de preparation des scripts
add_action('wp_enqueue_scripts', 'ls_quiz_enqueue_assets');