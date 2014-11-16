<?php
/**
 * Images widget class
 */
class po_Appearances_Widget extends WP_Widget {
	
	public $fields = array(
		'title',
		'subhead',
		'number'
	);
	
    function po_Appearances_Widget(){
        $widget_ops = array('classname' => 'po_Appearances', 'description' => __( "Show list of Appearances", 'po_Appearances_widget') );
        $this->WP_Widget('po-appearances-widget', __('Appearances', 'po_Appearances_widget'), $widget_ops);
    }//po_Appearances_Widget
	
	/*--------------------------Front End Display------------------------------------------------------*/
    function widget($args, $instance) {

        extract($args);
		
		foreach($this->fields as $key){ $this->$key = $instance[$key]; }//foreach
		
		if($this->link){ $this->link = get_permalink($this->link); $target = ''; }
		if($this->customlink){ $this->link = $this->customlink; $target = ' target="_blank"'; }

		echo $before_widget;
		
		echo $before_title;
			if($this->link && $this->link_title){ echo '<a href="' . $this->link . '"' . $target . '>'; }
				echo $this->title;
			if($this->link && $this->link_title){ echo '</a>'; }
        echo $after_title; 
		
		if($this->subhead){ ?><h4><?php echo $this->subhead; ?></h4><?php }

		$queryargs = array(
			'post_type' => 'appearances',
			'posts_per_page' => $instance['number'],
			'meta_key' => 'date',
			'orderby' => 'meta_value_num',
			'order' => 'ASC'		
		); 
		 
		$query = new WP_Query($queryargs);		

            global $post;
                  while ( $query->have_posts() ) {
                    $query->the_post();

                    $meta = new WP_Geek_metabox();
                    $meta->setdata();

					$before_post_title = apply_filters('wpg_before_appearances_title', '<a href="' . get_permalink() . '">');
					$after_post_title =  apply_filters('wpg_before_appearances_title', '</a>');
					 ?>
                    
                    <div class="excerpt">
                    <h4 class="appearances_title"><?php echo $before_post_title; the_title(); echo $after_post_title; ?></h4>
                    <p class="appearances_date"><?php echo $meta->time . ', ' . $meta->date; ?></p>
	                    

                    <div class="clear"></div>
                                        
                 </div>
            <?php	  } //endwhile
                // Reset Post Data
                wp_reset_postdata();		
				
		if($this->thumb){ 
			$img = wp_get_attachment_image_src($this->thumb, $this->size); // returns an array
			$alt = get_post_meta($this->thumb, '_wp_attachment_image_alt', true);
			if(!$alt){$alt = $this->title;}
			if($this->maxwidth){ 
				$style = ' style="max-width:' . $this->maxwidth  . '; height:auto;"';
				}
			 else { $style ='';}
			 
			if($this->link){ ?> <a href="<?php echo $this->link; ?>" <?php echo $target . $link_class; ?>> <?php } ?>
				<img<?php echo $style; ?> class="widget_thumb" src="<?php echo $img[0]; ?>" alt="<?php echo $alt; ?>" <?php WP_Geek::img_dimensions($img); ?> />
		<?php if($this->link){ ?></a> <?php } 
		}//if($thumb)

        if($this->readmore && $this->link){ ?>
			<div class="custom_excerpt after_widget_thumb">
                <?php  echo '<p class="readmore"><a href="' . $this->link . '"' . $target . $link_class . '>' . $this->readmore . '</a></p>';  ?>
			</div>
		<?php }
		
		echo $after_widget; 
} //end Front End Display

	/*--------------------------save info------------------------------------------------------*/
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
		foreach($this->fields as $field){
			$instance[$field] = strip_tags($new_instance[$field]);
		}//foreach
	
		$instance['custom_text'] = stripslashes($new_instance['custom_text']);	
		$instance['maxwidth'] = stripslashes($new_instance['maxwidth']);		
		
		return $instance;
    }
	/*--------------------------Admin Form------------------------------------------------------*/
	function form( $instance ) {
		
		$title = array(
			'name' => $this->get_field_name('title'),
			'label' => 'Title: ',
			'placeholder' => 'Title',
			'id' => $this->get_field_id('title'),
			'value' => $instance['title'],
			'class' => 'widefat'
		);

		$subhead = array(
			'name' => $this->get_field_name('subhead'),
			'label' => 'Subhead: ',
			'placeholder' => 'Subhead',
			'id' => $this->get_field_id('subhead'),
			'value' => $instance['subhead'],
			'class' => 'widefat'
		);		

		$number = array(
			'name' => $this->get_field_name('number'),
			'label' => 'Number to show (-1 to show all): ',
			'placeholder' => '-1',
			'id' => $this->get_field_id('number'),
			'value' => $instance['number'],
			'class' => 'widefat'
		);		

		$fields = array($title, $subhead, $number);
		$formargs = array('fields' => $fields, 'submit_button' => '', 'before_field' => '<p>', 'after_field' => '</p>');						
		
		$form = new WP_Geek_Form($formargs);
		
		echo $form->fields();

    }
}

function register_po_Appearances_widget() {
    register_widget('po_Appearances_Widget');
}
add_action('widgets_init', 'register_po_Appearances_widget');

?>