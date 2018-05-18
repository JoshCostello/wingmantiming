</div>

<?php $partners = get_field('partners', 'option'); ?>
<?php if($partners): ?>
    <div class="partners">
        <ul class="partner__list">
            <?php foreach ($partners as $partner): ?>
                <li class="partner">
                    <?php if($partner['partner_url'] !== ''): ?><a href="<?php echo $partner['partner_url']; ?>"><?php endif; ?>
                    <img class="partner__logo" src="<?php echo $partner['partner']['url']; ?>" />
                    <?php if($partner['partner_url'] !== ''): ?></a><?php endif; ?>
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
            <?php $email = get_field('email', 'option'); ?>
            <?php $phone = get_field('phone', 'option'); ?>
            <?php $city = get_field('city', 'option'); ?>
            <?php $state = get_field('state', 'option'); ?>

            <p class="contact__item  contact__item--logo">
                <img class="contact__logo" src="<?php bloginfo('template_url'); ?>/images/logo.svg" alt="">
            </p>

            <?php if($email !== ''): ?>
                <p class="contact__item contact__item--detail"><?php echo $email;?></p>
            <?php endif; ?>

            <?php if($phone !== ''): ?>
                <p class="contact__item contact__item--detail"><?php echo $phone;?></p>
            <?php endif; ?>

            <?php if($city !== '' && $state !== ''): ?>
                <p class="contact__item contact__item--detail"><?php echo $city;?>, <?php echo $state; ?></p>
            <?php endif; ?>
        </div>
    </div>
    
    <p class="site__copyright">&copy; <?php echo date('Y'); ?> <?php echo get_bloginfo(); ?></p>

</footer>

<?php wp_footer(); ?>
</body>
</html>