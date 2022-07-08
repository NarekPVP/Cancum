<?php


/*
// modal
                            $modal = "
                                    <div class='uk-lightbox uk-overflow-hidden uk-lightbox-panel uk-open'> 
                                <ul class='uk-lightbox-items'>
                                <li class='uk-active uk-transition-active' style='' tabindex='-1'>
                                <img width='750' height='500' src='{$file}' alt=''>
                                </li>
                                </ul>
                                 <div class='uk-lightbox-toolbar uk-position-top uk-text-right uk-transition-slide-top uk-transition-opaque'>
                                  <button class='uk-lightbox-toolbar-icon uk-close-large uk-icon uk-close' type='button' uk-close=''>
                                  <svg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg' data-svg='close-large'>
                                  <line fill='none' stroke='#000' stroke-width='1.4' x1='1' y1='1' x2='19' y2='19'></line>
                                  <line fill='none' stroke='#000' stroke-width='1.4' x1='19' y1='1' x2='1' y2='19'></line>
                                  </svg>
                                  </button>
                                   </div>
                                    <a class='uk-lightbox-button uk-position-center-left uk-position-medium uk-transition-fade uk-icon uk-slidenav-previous uk-slidenav uk-hidden' href='#' uk-slidenav-previous='' uk-lightbox-item='previous'>
                                    <svg width='14px' height='24px' viewBox='0 0 14 24' xmlns='http://www.w3.org/2000/svg' data-svg='slidenav-previous'>
                                    <polyline fill='none' stroke='#000' stroke-width='1.4' points='12.775,1 1.225,12 12.775,23 '></polyline>
                                    </svg>
                                    </a>
                                     <a class='uk-lightbox-button uk-position-center-right uk-position-medium uk-transition-fade uk-icon uk-slidenav-next uk-slidenav uk-hidden' href='#' uk-slidenav-next='' uk-lightbox-item='next'>
                                     <svg width='14px' height='24px' viewBox='0 0 14 24' xmlns='http://www.w3.org/2000/svg' data-svg='slidenav-next'>
                                     <polyline fill='none' stroke='#000' stroke-width='1.4' points='1.225,23 12.775,12 1.225,1 '></polyline>
                                     </svg>
                                     </a>
                                      <div class='uk-lightbox-toolbar uk-lightbox-caption uk-position-bottom uk-text-center uk-transition-slide-bottom uk-transition-opaque' style='display: none;'>                           
                                    </div>
                                     </div>
                                ";

*/

namespace app\helpers;


class Post extends Helper{

    public static function get($post_id){
        return \R::findOne("posts", "id = ?", [$post_id]);
    }

    public static function getPostImages($post_id, $classes = "", $deleteable = false){
        $post = self::get($post_id);
        if($post){
            if($post->img){
                $search = '|';
                if(preg_match("/{$search}/i", $post->img)){
                    $files = explode('|', $post->img);
                    foreach ($files as $file){
                        if(file_exists($file)){
                            if(!$deleteable) echo "<img data-path='{$file}' src='{$file}' class='{$classes}'>";
                            
                            // href='posts/delete-image?path={$file}&postid={$post_id}'
                            if($deleteable){
                                //echo "<a class='btn btn-danger delete-image' data-path='{$file}' data-postid='{$post_id}' style='max-height: 40px;'>X</a>";
                                echo "<a class='delete-hover delete-image' href='posts/delete-image?path={$file}&postid={$post_id}' data-path='{$file}' data-postid='{$post_id}'><img data-path='{$file}' src='{$file}' class='{$classes}'></a>";
                            } 
                            // modal
                            
                        }else{
                            //$_SESSION['error'] = $file . " File not found";
                        }
                    }
                }else{
                    if(is_file($post->img)){
                        $file = $post->img;
                        if(!$deleteable) echo "<img data-path='{$file}' src='{$file}' class='{$classes}'>";
                            
                            // href='posts/delete-image?path={$file}&postid={$post_id}'
                        if($deleteable){
                            //echo "<a class='btn btn-danger delete-image' data-path='{$file}' data-postid='{$post_id}' style='max-height: 40px;'>X</a>";
                            echo "<a class='delete-hover delete-image' href='posts/delete-image?path={$file}&postid={$post_id}' data-path='{$file}' data-postid='{$post_id}'><img data-path='{$file}' src='{$file}' class='{$classes}'></a>";
                        } 

                        // modal
                        
                    }else{
                        //$_SESSION['error'] = $post->img . " File not found";
                    }
                }
            }
        }
    }

}