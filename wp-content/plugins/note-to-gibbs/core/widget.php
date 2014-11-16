<?php
/**
 * Note_to_Gibbs widget class
 */
class ntg_Widget_Note_to_Gibbs extends WP_Widget {
	
    function ntg_Widget_Note_to_Gibbs()
	{
        $widget_ops = array('classname' => 'note_to_gibbs', 'description' => __( "Show random Notes to Gibbs", 'ntg_Note_to_Gibbs_widget') );
        $this->WP_Widget('Notes_to_Gibbs', __('Note to Gibbs', 'ntg_Note_to_Gibbs_widget'), $widget_ops);
    }
	/*--------------------------Front End Display------------------------------------------------------*/
    function widget($args, $instance) {
        extract($args);
 
       
		 ?>
	
		<?php echo $before_widget; ?>	
		        <div class="note_to_gibbs_rss_post">
    	    <div class="gibbs_note">
            <h3>Note to Gibbs</h3>
				<div class="ntg_widget_content"><?php
gg_random_rss_gibbs_note();
				?></div>
			</div>
		</div>


        
	 	<?php echo $after_widget; ?>

<?php	
} 
	/*--------------------------save info------------------------------------------------------*/
    function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
	

        return $instance;
    }

	/*--------------------------Admin Form------------------------------------------------------*/  
    function form( $instance ) {
       
       		
    ?>
        <p>This widget has no settings</p>

   
    <?php
    }
}

function registerNTG_Note_to_Gibbs_widget() {
    register_widget('ntg_Widget_Note_to_Gibbs');
}
add_action('widgets_init', 'registerNTG_Note_to_Gibbs_widget');
?>