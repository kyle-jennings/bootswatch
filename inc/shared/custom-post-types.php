<?php

function bootswatch_get_cpts() {
    $args = array(
       'public'   => true,
       'publicly_queryable' => true,
       '_builtin' => false
    );
    return bootswatch_get_cpt_template_types( get_post_types($args) );
}

function bootswatch_get_cpt_template_types($cpts) {
    $new = array();
    foreach($cpts as $cpt){
        $obj = get_post_type_object($cpt);
        $new[$cpt] = array(
            'label' => $obj->label,
            /* translators: custom post type label. */
            'description' => sprintf( __('A single instance of a %s.', 'bootswatch'), $obj->label)
        );
        if($obj->has_archive){

            $new[$cpt.'-feed'] = array(
                'label' => $obj->label . ' Feed',
                /* translators: custom post type label. */
                'description' => sprintf( __('The feed for your %s.', 'bootswatch'), $obj->label)
            );
        }
    }


    return $new;
}