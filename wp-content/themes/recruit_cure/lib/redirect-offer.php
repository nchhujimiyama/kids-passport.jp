<?php
/* redirect */
function page_redirect(){
	global $post;

	if( is_404() ) {
		$this_url = $_SERVER["REQUEST_URI"];
		preg_match("/([a-zA-Z]*)(-*)([a-zA-Z]*)-([0-9]{3})-([0-9]{8})/u", $this_url, $match_result);

		$code = $match_result[1] . $match_result[2] . $match_result[3];


		$args = array(
			'posts_per_page' => 1,
			'post_type' => 'offer',
			'meta_key' => 'management_code',
			'meta_value' => $code,
			'meta_compare' => 'LIKE'
		);

		$permalink = '';
		$query = new WP_Query( $args );
		if( $query->have_posts() ) {
			while( $query->have_posts() ) {
				$query->the_post();

				$permalink = get_permalink();
			}
		}

		if( !empty( $permalink ) ){
			wp_redirect( $permalink , 301);
			exit;
		}
	}
}
add_action( 'get_header', 'page_redirect' );