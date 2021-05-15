<?php
     // redirect to FAQ archive page
     $faq_archive_page = get_post_type_archive_link('faq');
     wp_safe_redirect( $faq_archive_page );
     exit;
?>