</div>

<?php $form = get_field('contact_form', 'option'); ?>
<?php if($form): ?>
    <?php //gravity_form($form['id'], true, true, false, '', true, 1); ?>
<?php endif; ?>

<?php $partners = get_field('partners', 'option'); ?>
<?php if($partners): ?>
    <div class="partners">
        <ul class="partner__list">
            <?php foreach ($partners as $partner): ?>
                <li class="partner">
                    <img class="partner__logo" src="<?php echo $partner['partner']['url']; ?>" />
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<footer class="site__footer component">

    <div class="footer__content">
        <nav class="footer-nav">
            <?php bem_menu('footer_nav', 'footer-menu', 'footer-menu--main'); ?>
        </nav>

        <div class="contact">
            <img class="contact__logo" src="<?php bloginfo('template_url'); ?>/images/logo.svg" alt="">
        </div>
    </div>
    
    <p class="site__copyright">&copy; <?php echo date('Y'); ?> <?php echo get_bloginfo(); ?></p>

</footer>

<?php wp_footer(); ?>
</body>
</html>