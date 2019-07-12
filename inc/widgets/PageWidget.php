<?php
class PageWidget extends WP_Widget {
    // class constructor
    public function __construct() {
        $widget_ops = array(
            'classname' => 'page-widget',
            'description' => 'get page link',
        );
        parent::__construct( 'page_widget', 'Page', $widget_ops );
    }

    // output the widget content on the front-end
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        $post_ids = !empty($instance['selected_posts']) ? array_column($instance['selected_posts'], 'post') : [];
        if( !empty($post_ids) ){
            ?>
           <div class="block-widget-page">
             <div class="menu-info"> Info  <span><i class="fa fa-chevron-up"></i></span> </div>
               <ul>
                
                   <?php foreach ( $post_ids as $id ) { 
                    $post = get_post($id);
                    ?>
                       <li><a href="<?php echo get_permalink( $post->ID ); ?>">
                               <?php echo $post->post_title; ?>
                           </a></li>
                   <?php } ?>
               </ul>
           </div>
            <?php

        }else{
            echo esc_html__( 'No posts selected!', 'text_domain' );
        }

        echo $args['after_widget'];
    }

    // output the option form field in admin Widgets screen
    public function form( $instance ) {
        $posts = get_posts( array(
            'posts_per_page' => 20,
            'offset' => 0,
            'post_type' => 'page'
        ) );
        $selected_posts = ! empty( $instance['selected_posts'] ) ? $instance['selected_posts'] : array();
        $selected__post = array_column($selected_posts, 'post');
        $selected__priority = array_column($selected_posts, 'priority');
        ?>
        <div style="max-height: 120px; overflow: auto;">
            <ul>
                <?php 
                $idxCheck = 0;
                foreach ( $posts as $post ) { 
                    $is_check = false;
                    $name_field = esc_attr( $this->get_field_name( 'selected_posts' ) );
                    $priority = '';

                    if (in_array( $post->ID, $selected__post )) {
                        $is_check = $post->ID;
                        $idx = array_search($post->ID, $selected__post);
                        $priority = isset($selected__priority[$idx]) ? $selected__priority[$idx] : '';
                    }

                ?>
    
                    <li>
                       <div class="block-post" style="display: inline; min-width: 40px">
                            <input
                            type="checkbox"
                            name="<?= $name_field ?>[post][]"
                            value="<?php echo $post->ID; ?>"
                            <?php checked($is_check, $post->ID); ?> />
                            <?= get_the_title( $post->ID ); ?>
                       </div>
                        <div class="block-priority" style="display: inline" style="margin-left: 10px">
                            <input type="number" value="<?= $priority ?>" name="<?= $name_field ?>[priority][<?= $post->ID ?>]" style="width: 80px;">
                        </div>
                    </li>

                <?php } ?>
            </ul>
        </div>
        <?php
    }

    // save options
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $selected_posts = ( ! empty ( $new_instance['selected_posts'] ) ) ? (array) $new_instance['selected_posts'] : array();

        // sort 
        $arr = [];
        if (!empty($selected_posts['post'])) {
            for ($i=0; $i < count($selected_posts['post']); $i++) {
                $arr[$selected_posts['post'][$i]] = [
                    'post' => $selected_posts['post'][$i],
                    'priority' => isset($selected_posts['priority'][$selected_posts['post'][$i]]) ? $selected_posts['priority'][$selected_posts['post'][$i]] : 0
                ];
            }
            usort($arr, function ($a, $b) {
                return $b['priority'] - $a['priority'];
            });
        }

        $instance['selected_posts'] = $arr;
        return $instance;
    }
}