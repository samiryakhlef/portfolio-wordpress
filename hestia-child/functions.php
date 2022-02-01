<?php


/**
 ** activation theme
 **/

if (!defined('ABSPATH')) exit;

if (!function_exists('hestia_child_parent_css')) :
    function hestia_child_parent_css()
    {
        wp_enqueue_style('hestia_child_parent', trailingslashit(get_template_directory_uri()) . 'style.css', array('bootstrap'));
        if (is_rtl()) {
            wp_enqueue_style('hestia_child_parent_rtl', trailingslashit(get_template_directory_uri()) . 'style-rtl.css', array('bootstrap'));
        }
    }
endif;
add_action('wp_enqueue_scripts', 'hestia_child_parent_css', 10);

/**
 * Importer les  options du thème parent
 *
 * @since 1.0.0
 */
function hestia_child_get_parent_options()
{
    $hestia_mods = get_option('theme_mods_hestia');
    if (!empty($hestia_mods)) {
        foreach ($hestia_mods as $hestia_mod_k => $hestia_mod_v) {
            set_theme_mod($hestia_mod_k, $hestia_mod_v);
        }
    }
}
add_action('after_switch_theme', 'hestia_child_get_parent_options');

/*
* On utilise une fonction pour créer notre custom post type 'Compétences'
*/

function wpm_custom_post_type()
{

    // On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
    $labels = array(
        // Le nom au pluriel
        'name'                => _x('Compétences', 'Post Type General Name'),
        // Le nom au singulier
        'singular_name'       => _x('Compétence', 'Post Type Singular Name'),
        // Le libellé affiché dans le menu
        'menu_name'           => __('Compétences'),
        // Les différents libellés de l'administration
        'all_items'           => __('Toutes les compétences'),
        'view_item'           => __('Voir les Compétences'),
        'add_new_item'        => __('Ajouter une nouvelle compétences'),
        'add_new'             => __('Ajouter'),
        'edit_item'           => __('Editer la compétences'),
        'update_item'         => __('Modifier la compétences'),
        'search_items'        => __('Rechercher une compétences'),
        'not_found'           => __('Non trouvée'),
        'not_found_in_trash'  => __('Non trouvée dans la corbeille'),
    );

    // On peut définir ici d'autres options pour notre custom post type

    $args = array(
        'label'               => __('Compétences'),
        'description'         => __('Tous sur les compétences'),
        'labels'              => $labels,
        // On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
        'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
        /* 
		* Différentes options supplémentaires
		*/
        'show_in_rest' => true,
        'hierarchical'        => false,
        'public'              => true,
        'has_archive'         => true,
        'rewrite'              => array('slug' => 'Compétences'),

    );

    // On enregistre notre custom post type qu'on nomme ici "compétences" et ses arguments
    register_post_type('Compétences', $args);
}

add_action('init', 'wpm_custom_post_type', 0);


/* fonction pour les expériences*/

