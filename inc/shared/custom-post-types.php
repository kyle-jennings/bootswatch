<?php

function bootswatches_get_cpts() {
    $args = array(
       'public'   => true,
       'publicly_queryable' => true,
       '_builtin' => false
    );
    return bootswatches_get_cpt_template_types( get_post_types($args) );
}

function bootswatches_get_cpt_template_types($cpts) {
    $new = array();
    foreach($cpts as $cpt){
        $obj = get_post_type_object($cpt);
        $new[$cpt] = array(
            'label' => $obj->label,
            /* translators: custom post type label. */
            'description' => sprintf( __('A single instance of a %s.', 'bootswatches'), $obj->label)
        );
        if($obj->has_archive){

            $new[$cpt.'-feed'] = array(
                'label' => $obj->label . ' Feed',
                /* translators: custom post type label. */
                'description' => sprintf( __('The feed for your %s.', 'bootswatches'), $obj->label)
            );
        }
    }


    return $new;
}