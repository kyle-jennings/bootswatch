<?php


class BootswatchesNavbarWalker extends Walker_Nav_Menu {


    function start_lvl( &$output, $depth = 0, $args = array() ) {

        $active = isset($this->child_active) ? $this->child_active : null;
        $id = 'side-nav-'.$this->curItem->menu_order;
        $output .= '<ul class="dropdown-menu ' . $active . '" aria-hidden="true">';
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '</ul>';
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {


        $this->curItem = $item;
        $object = $item->object;
        $type = $item->type;
        $title = $item->title;
        $description = $item->description;
        $permalink = $item->url;
        $item_output = isset($item_output) ? $item_output : '';

        $is_current = false;
        if($item->classes){
            foreach($item->classes as $key=>$class){
                if(strpos($class, 'current-menu-item') !== false )
                $is_current = true;
            }
        }

        $classes = ($is_current && $depth == 0) || $this->hasActiveChild($item) ? 'active': '';
        if($depth > 0 && $item->current )
            $classes .= 'active';


        $is_dropdown = ($depth == 0 && $args->walker->has_children) ? true : false;

        if($is_dropdown)
            $output .= '<li class="' . $classes . ' dropdown">';
        else
            $output .= '<li class="' . $classes . '">';

        $link_class = '';

        if($is_dropdown){
            $output  .= '<a href="#" class="dropdown-toggle"
            aria-expanded="false" aria-haspopup="true"
            data-toggle="dropdown" role="button" >';
                $output .= $title;
                $output .= '<span class="caret"></span>';
            $output .= '</a>';
        }elseif( $permalink && $permalink != '#' ) {
            $output .= '<a href="'.$permalink.'" class="'.$link_class.'">';
                $output .= $title;
            $output .= '</a>';
        }else{
            $output .= '<span class="'.$link_class.'">';
                $output .= $title;
            $output .= '</span>';
        }


        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }


    private function hasActiveChild($item)
    {
         return ($item->current_item_ancestor || in_array('current-page-ancestor', $item->classes)) ? true: false;
    }

    private function isActiveChild($item)
    {
        return ($item->current_item_ancestor || in_array('current-page-ancestor', $item->classes)) ? true: false;

    }

}
