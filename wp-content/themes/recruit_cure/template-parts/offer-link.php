<div class="post-custom__link">
    <?php if( is_mobile() ) : ?><a href="tel:<?= get_option('company_option_tel_contact'); ?>">電話で応募する</a><?php endif; ?>
    <a href="<?= home_url(); ?>/entry/?code=<?= get_post_meta($post->ID, 'management_code', true); ?>">Webで応募する</a>
</div>