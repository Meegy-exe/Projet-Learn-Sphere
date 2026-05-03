<!-- fichier copié du theme parent -->
<!-- permet d'adapter à nos quiz et cours le filtre -->

<?php
$consultancy_firm_layout = consultancy_firm_get_final_sidebar_layout();
$consultancy_firm_sidebar_class = ($consultancy_firm_layout === 'right-sidebar') ? 'column-order-2' : 'column-order-1';

if ($consultancy_firm_layout !== 'no-sidebar'): ?>
    <aside id="secondary" class="widget-area <?php echo esc_attr($consultancy_firm_sidebar_class); ?>">
        <div class="widget-area-wrapper">

            <!-- bloc des filtres -->
            <div class="widget widget_custom_filters">
                <?php
                // regarde sur quel page est luser soit quiz soit cours
                $is_quiz = is_post_type_archive('quiz_learnsphere');
                $post_type_link = $is_quiz ? get_post_type_archive_link('quiz_learnsphere') : get_post_type_archive_link('cours');
                $titre_widget = $is_quiz ? 'Filtrer les quiz' : 'Filtrer les cours';

                // met la taxonomie selon la page quiz dans ce cas
                $taxonomie_active = $is_quiz ? 'ls_quiz_genre' : 'category';
                ?>

                <h3 class="widget-title"><?php echo esc_html($titre_widget); ?></h3>

                <form action="<?php echo esc_url($post_type_link); ?>" method="get" class="ls-filter-form">

                    <!-- zone de recherche -->
                    <div class="ls-filter-group">
                        <label class="ls-filter-label">Recherche</label>
                        <input type="text" name="s" placeholder="Mots-clés..." value="<?php echo get_search_query(); ?>"
                            class="ls-filter-input">
                    </div>

                    <!-- categorie selon cours ou quiz -->
                    <div class="ls-filter-group">
                        <label class="ls-filter-label">Thématiques</label>
                        <div class="ls-filter-checkboxes">
                            <?php
                            // taxonomie dynamique : changer automatiquement de source de data selon la page
                            $categories = get_terms([
                                'taxonomy' => $taxonomie_active,
                                'hide_empty' => false,
                            ]);

                            $selected_cats = isset($_GET['custom_cat']) && is_array($_GET['custom_cat']) ? $_GET['custom_cat'] : [];

                            if (!is_wp_error($categories) && !empty($categories)) {
                                foreach ($categories as $cat) {

                                    // securite : cours esc attr
                                    if (in_array($cat->slug, ['pertinent', 'slider', 'uncategorized'])) {
                                        continue;
                                    }

                                    $checked = in_array($cat->term_id, $selected_cats) ? 'checked' : '';
                                    echo '<label class="ls-filter-checkbox-label">';
                                    echo '<input type="checkbox" name="custom_cat[]" value="' . esc_attr($cat->term_id) . '" ' . $checked . '> ';
                                    echo esc_html($cat->name);
                                    echo '</label>';
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- FILTRE cagétorie niveaux de difficulté (acf) -->
                    <div class="ls-filter-group">
                        <label class="ls-filter-label">Difficulté</label>
                        <select name="difficulty_level" class="ls-filter-input">
                            <option value="">Tous les niveaux</option>
                            <option value="facile" <?php selected($_GET['difficulty_level'] ?? '', 'facile'); ?>>Facile
                            </option>
                            <option value="moyen" <?php selected($_GET['difficulty_level'] ?? '', 'moyen'); ?>>Moyen
                            </option>
                            <option value="difficile" <?php selected($_GET['difficulty_level'] ?? '', 'difficile'); ?>>
                                Difficile</option>
                        </select>
                    </div>

                    <!-- FILTRE ordre chrono -->
                    <div class="ls-filter-group">
                        <label class="ls-filter-label">Trier par</label>
                        <select name="sort_order" class="ls-filter-input">
                            <option value="desc" <?php selected($_GET['sort_order'] ?? '', 'desc'); ?>>Les plus récents
                                d'abord</option>
                            <option value="asc" <?php selected($_GET['sort_order'] ?? '', 'asc'); ?>>Les plus anciens
                                d'abord</option>
                        </select>
                    </div>

                    <!-- btn valider filtre -->
                    <button type="submit" class="ls-filter-submit">
                        Appliquer les filtres
                    </button>

                </form>
            </div>

        </div>
    </aside>
<?php endif; ?>