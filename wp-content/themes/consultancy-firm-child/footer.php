<?php
/**
 * The template for displaying the footer - North Stars Clean Version
 */
?>
    </div> <footer id="site-footer" class="site-footer" role="contentinfo">
        
        <div class="bloc-footer-newsletter">
            <div class="wrapper">
                <div class="newsletter-content">
                    
                    <div class="newsletter-text-block">
                        <h3>Newsletter</h3>
                        <p>Suivez notre newsletter.</p>
                    </div>
                    
                    <div class="newsletter-form-block">
                        <?php 
                        if ( is_active_sidebar( 'consultancy-firm-footer-widget-0' ) ) : 
                            dynamic_sidebar( 'consultancy-firm-footer-widget-0' ); 
                        endif; 
                        ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="site-info">
            <div class="wrapper">
                <div class="info-content">
                    <div class="footer-credits">
                        <p>© <?php echo date('Y'); ?> <strong>North Stars</strong> – Tous droits réservés.</p>
                    </div>
                    <div class="footer-back-to-top">
                        <a class="scroll-top" href="#site-header">Revenir en haut ↑</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div> <?php wp_footer(); ?>
</body>
</html>