<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('breadcrumb'))
{
    function breadcrumb($pages, $separator = '', $endlink = FALSE)
    {
        $depth = count($pages);

        $i = 0;
        
        $output = '<ul id="breadcrumb">';

        foreach ($pages as  $url => $label)
        {
             $i++;

             if($depth > $i)
             {
                $output .= '<li>'.anchor($url, $label).'</li>';

                if($separator != '')
                {
                    $output .= '<li class="separator">'.$separator.'</li>';
                }
             }

             else
             {
                 if($depth == $i && $endlink == TRUE)
                 {
                    $output .= '<li>'.anchor($url, $label).'</li>';

                 }

                 else
                 {
                    $output .= '<li><span>'.$label.'</span></li>';
                 }
             } 
        }
       
        $output .= '</ul>';

        return $output;
    }
} 