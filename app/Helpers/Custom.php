<?php

namespace App\Helpers;
use Illuminate\Http\Request;

class Custom {
    public static function active_menu($segment, $menu_tree=false) {
        $current_segment = request()->segment(1);
        $current_segment .= request()->segment(2)!=''?'/'.request()->segment(2):'';
        if($menu_tree==true && is_array($segment)) {
            if(in_array($current_segment, $segment)) {
                return 'menu-open';
            }
        } else {
            return $current_segment==$segment?'active':'';
        }
    }
}