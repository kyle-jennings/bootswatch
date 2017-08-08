<?php


class SideNavWalker extends Walker_Nav_Menu {


    function start_lvl( &$output, $depth = 0, $args = array() ) {

		$output .= '<ul class="sub_list">';
	}

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '</ul>';
    }

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {


        $list_item_classes = isset($args->list_item_classes) ? $args->list_item_classes : '';

        $object = $item->object;
        $type = $item->type;
        $title = $item->title;
        $description = $item->description;
        $permalink = $item->url;

        $is_current = false;

        if($item->classes){
            foreach($item->classes as $key=>$class){
                if(strpos($class, 'current-menu-item') !== false )
                $is_current = true;
            }
        }

		$classes = $is_current ? 'current': '';

        $output .= '<li class="'.$list_item_classes.'">';

        $link_class = ($depth == 0) ? 'nav-link' : '';


        if( $permalink && $permalink != '#' ) {
            $output .= '<a class="'.$classes.'" href="'.$permalink.'">';
                $output .= '<span>'.$title.'</span>';
            $output .= '</a>';
        }else{
            $output .= '<span class="'.$classes.'">';
                $output .= '<span>'.$title.'</span>';
            $output .= '</span>';
        }

	}


}
