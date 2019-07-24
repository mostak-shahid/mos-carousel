<?php
function mos_slider_metaboxes() {
    $prefix = '_mos_slider_';   

    $mos_slider_details = new_cmb2_box(array(
        'id' => $prefix . 'details',
        'title' => __('Slider Details', 'cmb2'),
        'object_types' => array('slider'),
    ));
    $mos_slider_details->add_field(array(
        'name' => 'Image List for Desktop',
        'desc' => '',
        'id'   => $prefix . 'images',
        'type' => 'file_list',
    ));
    $mos_slider_details->add_field(array(
        'name' => 'Image List for Mobile',
        'desc' => '',
        'id'   => $prefix . 'images_mobile',
        'type' => 'file_list',
    ));
    $mos_slider_details->add_field(array(
        'name' => __( 'Button Text', 'cmb2' ),
        'id'   => $prefix . 'button_text',
        'type' => 'text',
    ));
    $mos_slider_details->add_field(array(
        'name' => __( 'Button URL', 'cmb2' ),
        'id'   => $prefix . 'button_url',
        'type' => 'text_url',
    ));

}
add_action('cmb2_admin_init', 'mos_slider_metaboxes');