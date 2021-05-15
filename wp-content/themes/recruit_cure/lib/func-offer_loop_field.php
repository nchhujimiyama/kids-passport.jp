<?php
function scf_add_offer_fields( $settings, $post_type, $post_id ) {
    $view_type = array( 'offer' );
    if ( !in_array( $post_type, $view_type ) ) return $settings;

    $Setting = SCF::add_setting( 'meta_process', '採用プロセス' );
    $Setting->add_group( 'process_group', true, array(
        array(
            'name' => 'process_ttl',
            'label' => '見出し',
            'type' => 'text',
        ),
        array(
            'name' => 'process_content',
            'label' => '内容',
            'type' => 'wysiwyg'
        )
    ) );
    $settings[] = $Setting;
    return $settings;
}
add_filter( 'smart-cf-register-fields', 'scf_add_offer_fields', 10, 3 );