<?php 
class boot_Category_Widget extends WP_Widget {
  /**
  * To create the example widget all four methods will be 
  * nested inside this single instance of the WP_Widget class.
  **/
  public function __construct() {
    $widget_options = array( 
      'classname' => 'boot_category_widget',
      'description' => 'This is Boot\'s category widget',
    );
    parent::__construct( 'boot_category_widget', 'Boot Category Filter Widget', $widget_options );
  }

  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance[ 'title' ] );
    echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
  
    get_template_part('content','shop-sidebar');
  
     echo $args['after_widget'];
  }

  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
    </p><?php 
  }

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    return $instance;
  }
}

function boot_register_widgets() { 
    register_widget( 'boot_Category_Widget' );
  }
  add_action( 'widgets_init', 'boot_register_widgets' );