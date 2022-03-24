<?php
$options = get_design_plus_option();
?>
<div id="bread_crumb">

     <?php
     // member archive -----------------------------------------------------------------------------
     if(is_author()) {
          global $wp_query;
          $curauth = $wp_query->get_queried_object();
          $author_id = $curauth->ID;
          $user_data = get_userdata($author_id);
          $author_name = $user_data->display_name;
          ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($author_name); ?></span><meta itemprop="position" content="2"></li>
          </ul>
     <?php
     // gallery archive -----------------------
     } elseif(is_post_type_archive('gallery')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['gallery_label']); ?></span><meta itemprop="position" content="2"></li>
          </ul>
     <?php
     // gallery single page
     } elseif(is_singular('gallery')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('gallery')); ?>"><span itemprop="name"><?php echo esc_html($options['gallery_label']); ?></span></a><meta itemprop="position" content="2"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
          </ul>
     <?php
     // staff archive -----------------------
     } elseif(is_post_type_archive('staff')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['staff_label']); ?></span><meta itemprop="position" content="2"></li>
          </ul>
     <?php
     // staff single page
     } elseif(is_singular('staff')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('staff')); ?>"><span itemprop="name"><?php echo esc_html($options['staff_label']); ?></span></a><meta itemprop="position" content="2"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
          </ul>
     <?php
     // menu archive -----------------------
     } elseif(is_post_type_archive('menu')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['menu_label']); ?></span><meta itemprop="position" content="2"></li>
          </ul>
     <?php
     // menu single -----------------------
     } elseif(is_singular('menu')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('menu')); ?>"><span itemprop="name"><?php echo esc_html($options['menu_label']); ?></span></a><meta itemprop="position" content="2"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
          </ul>
     <?php
     // news archive -----------------------
     } elseif(is_post_type_archive('news')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['news_label']); ?></span><meta itemprop="position" content="2"></li>
          </ul>
     <?php
     // news single -----------------------
     } elseif(is_singular('news')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><span itemprop="name"><?php echo esc_html($options['news_label']); ?></span></a><meta itemprop="position" content="2"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
          </ul>
     <?php
     // diary archive -----------------------
     } elseif(is_post_type_archive('diary')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['diary_label']); ?></span><meta itemprop="position" content="2"></li>
          </ul>
     <?php
     // diary tax archive -----------------------
     } elseif(is_tax('diary_category')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('diary')); ?>"><span itemprop="name"><?php echo esc_html($options['diary_label']); ?></span></a><meta itemprop="position" content="2"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php single_term_title(); ?></span><meta itemprop="position" content="3"></li>
          </ul>
     <?php
     // diary single -----------------------
     } elseif(is_singular('diary')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('diary')); ?>"><span itemprop="name"><?php echo esc_html($options['diary_label']); ?></span></a><meta itemprop="position" content="2"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
          </ul>
     <?php
     // interview archive -----------------------
     } elseif(is_post_type_archive('interview')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['interview_label']); ?></span><meta itemprop="position" content="2"></li>
          </ul>
     <?php
     // interview tax archive -----------------------
     } elseif(is_tax('interview_division')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('interview')); ?>"><span itemprop="name"><?php echo esc_html($options['interview_label']); ?></span></a><meta itemprop="position" content="2"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php single_term_title(); ?></span><meta itemprop="position" content="3"></li>
          </ul>
     <?php
     // interview tax archive -----------------------
     } elseif(is_tax('interview_occupation')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('interview')); ?>"><span itemprop="name"><?php echo esc_html($options['interview_label']); ?></span></a><meta itemprop="position" content="2"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php single_term_title(); ?></span><meta itemprop="position" content="3"></li>
          </ul>
     <?php
     // interview single -----------------------
     } elseif(is_singular('interview')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('interview')); ?>"><span itemprop="name"><?php echo esc_html($options['interview_label']); ?></span></a><meta itemprop="position" content="2"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
          </ul>
     <?php
     // review archive -----------------------
     } elseif(is_post_type_archive('review')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['review_label']); ?></span><meta itemprop="position" content="2"></li>
          </ul>
     <?php
     // review single -----------------------
     } elseif(is_singular('review')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('review')); ?>"><span itemprop="name"><?php echo esc_html($options['review_label']); ?></span></a><meta itemprop="position" content="2"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
          </ul>
     <?php
     // service archive -----------------------
     } elseif(is_post_type_archive('service')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['service_label']); ?></span><meta itemprop="position" content="2"></li>
          </ul>
     <?php
     // service single -----------------------
     } elseif(is_singular('service')) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('service')); ?>"><span itemprop="name"><?php echo esc_html($options['service_label']); ?></span></a><meta itemprop="position" content="2"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
          </ul>
     <?php
     // Search -----------------------
     } elseif(is_search()) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php _e('Search result','tcd-w'); ?></span><meta itemprop="position" content="2"></li>
          </ul>
     <?php
     // Blog page -----------------------
     } elseif(is_home()) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['blog_label']); ?></span><meta itemprop="position" content="2"></li>
          </ul>
     <?php
     // Category, Tag , Archive page -----------------------
     } elseif(is_category() || is_tag() || is_day() || is_month() || is_year()) {
          if (is_category()) {
               $title = single_cat_title('', false);
          } elseif( is_tag() ) {
               $title = single_tag_title('', false);
          } elseif (is_day()) {
               $title = sprintf(__('Archive for %s', 'tcd-w'), get_the_time(__('F jS, Y', 'tcd-w')) );
          } elseif (is_month()) {
               $title = sprintf(__('Archive for %s', 'tcd-w'), get_the_time(__('F, Y', 'tcd-w')) );
          } elseif (is_year()) {
               $title = sprintf(__('Archive for %s', 'tcd-w'), get_the_time(__('Y', 'tcd-w')) );
          };
          ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($options['blog_label']); ?></span></a><meta itemprop="position" content="2"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($title); ?></span><meta itemprop="position" content="3"></li>
          </ul>
     <?php
     //  Page -----------------------
     } elseif(is_page()) {
     ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
          </ul>
     <?php
     // Other page -----------------------
     } else {
          $category = get_the_category();
          ?>
          <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
               <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($options['blog_label']); ?></span></a><meta itemprop="position" content="2"></li>
               <?php if($category) { ?>
                    <li class="category" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                         <?php
                         $count=1;
                         foreach ($category as $cat) {
                         ?>
                              <a itemprop="item" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><span itemprop="name"><?php echo esc_html($cat->name); ?></span></a>
                         <?php $count++; } ?>
                         <meta itemprop="position" content="3">
                    </li>
               <?php }; ?>
               <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="4"></li>
          </ul>
     <?php }; ?>

</div>
