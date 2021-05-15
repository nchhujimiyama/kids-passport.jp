<?php

// 求人情報URL --------------------------------------------------------------------------------
function my_recruit_post_slug( $slug, $post_ID, $post_status, $post_type ) {
    // if ( $post_type === 'offer' ) {
    if ( preg_match( '/(%[0-9a-zA-Z]*)+/', $slug ) ) {
        $slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
    }
    return $slug;
}
add_filter( 'wp_unique_post_slug', 'my_recruit_post_slug', 10, 4  );


// リンク設定 --------------------------------------------------------------------------------
function my_recruit_page_permalinks() {
	global $wpdb;
	$modified_type = $_POST['modified_type'];

	//=== POST
	if (strtolower($_SERVER["REQUEST_METHOD"]) === "post") {
		if (!empty($_POST["job_checked"]) && is_array($_POST["job_checked"]) && !empty($_POST["job"]) && is_array($_POST["job"])) {
			foreach((array)$_POST["job_checked"] as $post_id) {
				if (!empty($_POST["job"][$post_id])) {
					$_data = $_POST["job"][$post_id];

                    delete_post_meta( $post_id, 'management_code' );
                    delete_post_meta( $post_id, 'update_num' );
                    delete_post_meta( $post_id, 'uuid' );
					delete_post_meta( $post_id, 'custom_permalink' );
					if (!empty($_data["job_id"])) {
						echo '<script>console.log("not empty");</script>';
                        add_post_meta( $post_id, 'management_code', $_data["job_id"]);
                        add_post_meta( $post_id, 'update_num', $_data["job_num"] + 1);

						if (!empty($_data["job_url_auto_change"])) {
                            add_post_meta( $post_id, 'uuid', $_data["rand"]);
						} else {
                            add_post_meta( $post_id, 'uuid', $_data["uuid"]);
						}

						$slug = str_replace('%2F', '/', urlencode( ltrim( stripcslashes( $_data['custom_permalink'] ), "/" ) ) );
						add_post_meta( $post_id, 'custom_permalink', $slug );

						$wpdb->update(
							'wp_posts',
							array(
								'post_name' => $slug
							),
							array( 'ID' => $post_id )
						);

						// update modified date
						if( $modified_type == 2 ) {
							$modified = $_POST['modified_date'] . ' ' . $_POST['modified_hour'] . ':' . $_POST['modified_minute'] . ':00';
							$modified_gmt = get_gmt_from_date( $modified );

							$wpdb->update(
								'wp_posts',
								array(
									'post_modified' => stripslashes( $modified ),
									'post_modified_gmt' => stripslashes( $modified_gmt )
								),
								array( 'ID' => $post_id ),
								array( '%s', '%s' ),
								array( '%d' )
							);
						}
					} else {
						echo '<script>console.log("empty");</script>';
                        add_post_meta( $post_id, 'management_code', "offer-".$post_id );
                        add_post_meta( $post_id, 'update_num', $_data["job_num"] + 1 );
                        add_post_meta( $post_id, 'uuid', $_data["rand"] );
						add_post_meta( $post_id, 'custom_permalink', ltrim( my_recruit_custom_permalinks_url( 'offer-' . $post_id, $_data['rand'], str_pad( $_data['job_num'] + 1, 3, 0, STR_PAD_LEFT ) ) ) );
                    }
				}
			}
		}

	   // Redirect
		$redirectUrl = $_SERVER['REQUEST_URI'];
		?>
		<script type="text/javascript">
		document.location = '<?= $redirectUrl ?>'
		</script>
		<?php ;
	}

	//=== GET
	$limit = -1;
	$paged = isset($_GET["paged"]) ? (int)$_GET["paged"] : 1;
	if ($paged <= 0) $paged = 1;

	$form_url = "";
	list($form_url) = explode('?' , $_SERVER["REQUEST_URI"]);

    $form_query = $_GET;

    get_template_part('lib/page/custom_permalinks');
}



//===
function my_recruit_custom_permalinks_url( $job_id, $rand, $job_num = 0 ) {
	$format  = cr_get_option( "job_url_format" );
	$replace = array(
        '%job_id%'   => $job_id,
        '%job_num%'  => str_pad( $job_num, 3, 0, STR_PAD_LEFT ),
		'%job_rand%' => $rand,
		'%rand%'     => $rand,
	);

	return str_replace( array_keys( $replace ), array_values( $replace ), $format );
}
//=== return date
function my_recruit_custom_permalinks_rand() {
	return date( "Ymd" );
}

function cr_get_option( $key ) {
	// 1.設定値
	// 2.引数に指定された $default
	// 3.下記の# $defaults[$key]
	$defaults = array(
		"job_url_format" => 'offer/%job_id%-%job_num%-%job_rand%',
		"job_tel_flg"    => false,
	);

	if ( isset( $defaults[ $key ] ) ) {
		return $defaults[ $key ];
	}

	return null;
}


//=== 新規ページの作成
function my_recruit_admin_menu() {
    $page_root = 'edit.php?post_type=offer';
    // $page_root = 'options-general.php';
	add_submenu_page(
        $page_root,
        '求人URL設定',
        '求人URL設定',
        'edit_pages',
        'my_recruit_page_permalinks',
        "my_recruit_page_permalinks"
    );
}
add_action( 'admin_menu', 'my_recruit_admin_menu' );



//=== カスタムフィールド 追加
add_action('admin_menu', 'add_permalinks_field');
add_action('save_post', 'save_permalinks_fields');
function add_permalinks_field() {
    add_meta_box('permalinks', 'permalink', 'insert_permalinks_fields', 'offer', 'normal');
}
function insert_permalinks_fields() {
    global $post;

    echo '<input type="hidden" name="custom_permalink" value="'.get_post_meta($post->ID, 'custom_permalink', true).'" size="50" />
    <input type="hidden" name="uuid" value="'.get_post_meta($post->ID, 'uuid', true).'" size="50" />
    <style>#permalinks {display: none;}</style>';
}
function save_permalinks_fields($post_id) {
    if(!empty($_POST['custom_permalink'])) {
        update_post_meta($post_id, 'custom_permalink', $_POST['custom_permalink']);
    } else {
        delete_post_meta($post_id, 'custom_permalink');
    }
    if(!empty($_POST['uuid'])) {
        update_post_meta($post_id, 'uuid', $_POST['uuid']);
    } else {
        delete_post_meta($post_id, 'uuid');
    }
}