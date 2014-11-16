<?php
/**
 * Images widget class
 */
class po_Progress_bar extends WP_Widget {
	
	public $fields = array(
		'title',
		'bar1',
		'progress1',
		'bar2',
		'progress2',
		'bar3',
		'progress3',
		'bar4',
		'progress4',						
	);
	
    function po_Progress_bar(){
        $widget_ops = array('classname' => 'po_Progress_bar', 'description' => __( "Show a set of Progress Bars", 'po_Progress_bar') );
        $this->WP_Widget('po-progress-bar', __('Progress Bars', 'po_Progress_bar'), $widget_ops);
    }//po_Progress_bar
	
	/*--------------------------Front End Display------------------------------------------------------*/
    function widget($args, $instance) {
        extract($args);
		
		foreach($this->fields as $key){ $this->$key = $instance[$key]; }//foreach
		
		echo $before_widget;
		
		echo $before_title . $this->title . $after_title; 

		for ($x=0; $x<=4; $x++) {
			$bar = 'bar' . $x;
			$progress = 'progress' . $x;
			if($this->$bar){
				echo '<div class="po_progress_bar">';
				echo '<p class="progress_title">' . $this->$bar . '</p>';
				$this->bar($this->$progress);
				echo '</div>';
			}
		} 
		
		
		echo $after_widget; 
	} //end Front End Display

	public function bar($num=0){
		if($num > 100){ $num = 100; }
	 ?>
			<div class="bar">
				<span style="width: <?php echo $num; ?>%"></span>
			</div>
			<p class="progress_percent"><?php echo $num; ?>%</p>
	<?php }

	/*--------------------------save info------------------------------------------------------*/
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
		foreach($this->fields as $field){
			$instance[$field] = strip_tags($new_instance[$field]);
		}//foreach		
		
		return $instance;
    }
	/*--------------------------Admin Form------------------------------------------------------*/
	function form( $instance ) {
		wp_enqueue_media();
		wp_enqueue_script('wpg_widget_admin');		
		$title = array(
			'name' => $this->get_field_name('title'),
			'label' => 'Title: ',
			'placeholder' => 'Title',
			'id' => $this->get_field_id('title'),
			'value' => $instance['title'],
			'class' => 'widefat'
		);

		$bar1 = array(
			'name' => $this->get_field_name('bar1'),
			'label' => 'Bar 1: ',
			'placeholder' => 'Bar 1',
			'id' => $this->get_field_id('bar1'),
			'value' => $instance['bar1'],
			'class' => 'widefat'
		);

		$progress1 = array(
			'name' => $this->get_field_name('progress1'),
			'label' => 'Progress 1: ',
			'placeholder' => 'Progress 1',
			'id' => $this->get_field_id('progress1'),
			'value' => $instance['progress1'],
			'class' => 'widefat'
		);		

		$bar2 = array(
			'name' => $this->get_field_name('bar2'),
			'label' => 'Bar 2: ',
			'placeholder' => 'Bar 2',
			'id' => $this->get_field_id('bar2'),
			'value' => $instance['bar2'],
			'class' => 'widefat'
		);

		$progress2 = array(
			'name' => $this->get_field_name('progress2'),
			'label' => 'Progress 2: ',
			'placeholder' => 'Progress 2',
			'id' => $this->get_field_id('progress2'),
			'value' => $instance['progress2'],
			'class' => 'widefat'
		);		

		$bar3 = array(
			'name' => $this->get_field_name('bar3'),
			'label' => 'Bar 3: ',
			'placeholder' => 'Bar 3',
			'id' => $this->get_field_id('bar3'),
			'value' => $instance['bar3'],
			'class' => 'widefat'
		);

		$progress3 = array(
			'name' => $this->get_field_name('progress3'),
			'label' => 'Progress 3: ',
			'placeholder' => 'Progress 3',
			'id' => $this->get_field_id('progress3'),
			'value' => $instance['progress3'],
			'class' => 'widefat'
		);		

		$bar4 = array(
			'name' => $this->get_field_name('bar4'),
			'label' => 'Bar 4: ',
			'placeholder' => 'Bar 4',
			'id' => $this->get_field_id('bar4'),
			'value' => $instance['bar4'],
			'class' => 'widefat'
		);

		$progress4 = array(
			'name' => $this->get_field_name('progress4'),
			'label' => 'Progress 4: ',
			'placeholder' => 'Progress 4',
			'id' => $this->get_field_id('progress4'),
			'value' => $instance['progress4'],
			'class' => 'widefat'
		);		

		$fields = array($title, $bar1, $progress1, $bar2, $progress2, $bar3, $progress3, $bar4, $progress4);
		$formargs = array('fields' => $fields, 'submit_button' => '', 'before_field' => '<p>', 'after_field' => '</p>');						
		
		$form = new WP_Geek_Form($formargs);
		
		echo $form->fields(); ?>
		
<?php
    }
}

function register_po_Progress_bar() {
    register_widget('po_Progress_bar');
}
add_action('widgets_init', 'register_po_Progress_bar');

?>