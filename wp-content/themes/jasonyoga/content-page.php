<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<div class="backgroundwrapper">

	<div class="contentwrapper">
	    
		<?php if(is_page('teacher-training')) { ?>

			<div class="feature aligncenter">
		    	<img src="<?php bloginfo('template_directory'); ?>/images/teachertraining1.jpg" />
		    	<img src="<?php bloginfo('template_directory'); ?>/images/teachertraining2.jpg" />
		    </div>

		<?php } else if(is_page('weekend-workshops')) { ?>

			<div class="feature aligncenter">
		    	<img src="<?php bloginfo('template_directory'); ?>/images/img-weekendWorkshop-001.jpg" />
		    	<img src="<?php bloginfo('template_directory'); ?>/images/img-weekendWorkshop-002.jpg" />
		    </div>

		<?php } ?>

	    <div class="content">

			<?php the_content(); ?>

	    </div>

	</div>

</div>