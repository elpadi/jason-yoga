<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<!-- Footer -->

<?php if(is_front_page()) { ?>

<div class="homefooter footer">

	<div class="footer-left">

		<a href="/?page_id=27"><img src="<?php bloginfo('template_directory'); ?>/images/footerleft.jpg" /></a>
	
	</div>

	<div class="footer-middle">

		<a href="/?page_id=7"><img src="<?php bloginfo('template_directory'); ?>/images/footermiddle.jpg" /></a>
	
	</div>

	<div class="footer-right">

		<h1 class="aligncenter">Want to keep up with Jason?<br /> Join the mailing list!</h1>
		<!-- <form>
			<input type="text" name="name" placeholder="First Name">
			<input type="text" name="email" placeholder="E-mail">
		</form>

		<img src="<?php bloginfo('template_directory'); ?>/images/gobutton.png" /> -->

		<!-- Begin MailChimp Signup Form -->
			
			<div id="mc_embed_signup">
				<form action="http://jasonyoga.us6.list-manage.com/subscribe/post?u=066944c3703953d1a7b9de19c&amp;id=19a7e31f47" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
		
					<div class="mc-field-group">
						<input type="text" value="" placeholder="First Name" name="FNAME" class="" id="mce-FNAME">
					</div>
					<!-- <div class="mc-field-group">
						<input type="text" value="" placeholder="Last Name" name="LNAME" class="" id="mce-LNAME">
					</div> -->
					<div class="mc-field-group">
						<input type="email" value="" placeholder="Email Address" name="EMAIL" class="required email" id="mce-EMAIL">
					</div>
					<div id="mce-responses">
						<div class="response" id="mce-error-response" style="display:none"></div>
						<div class="response" id="mce-success-response" style="display:none"></div>
					</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					<div style="position: absolute; left: -5000px;"><input type="text" name="b_066944c3703953d1a7b9de19c_19a7e31f47" tabindex="-1" value=""></div>
					<input type="submit" value="" name="subscribe" id="mc-embedded-subscribe" class="mc-embedded-subscribe button">
				</form>
			</div>

		<!--End mc_embed_signup-->

	</div>

	<div class="copyright aligncenter">&copy; 2014 Jason Crandell Yoga Method. <br />Power + Precision + Mindfulness. All Rights Reserved. <br />All pose illustrations ©2014 MCKIBILLO. <br />Site by <a href="http://www.sheilabuchanan.com/" target="_blank">Sheila Buchanan</a></div>
    
    <div class="footer-icons aligncenter">

		<a href="https://twitter.com/jason_crandell" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png" /></a>
		<a href="https://www.facebook.com/JasonCrandellYoga" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/facebook.png" /></a>
		<a href="http://instagram.com/jason_crandell" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/instagram.png" /></a>
		<a href="http://www.pinterest.com/jasonyoga/" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/pinterest.png" /></a>
	
	</div>

</div>

<?php } else { ?>

<!-- Footer -->
<div class="footer aligncenter">
	
	<div class="formwrapper">
		<?php include(__DIR__.'/inc/newsletter-form.php'); ?>

		<!--End mc_embed_signup-->

		<div class="footer-icons">

			<a href="https://twitter.com/jason_crandell" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/twitterwhite.png" /></a>
			<a href="https://www.facebook.com/JasonCrandellYoga" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/facebookwhite.png" /></a>
			<a href="http://instagram.com/jason_crandell" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/instagramwhite.png" /></a>
			<a href="http://www.pinterest.com/jasonyoga/" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/pinterestwhite.png" /></a>
		
		</div>

	</div>

	<div class="copyright"  class="aligncenter">© 2014 Jason Crandell Yoga Method. <br />
	Power + Precision + Mindfulness. All Rights Reserved. <br />
All pose illustrations ©2014 MCKIBILLO. <br /><a href="http://www.sheilabuchanan.com/" target="_blank">Site by Sheila Buchanan</a></div>    

</div>

<?php } ?>

<?php wp_footer(); ?>
</body>
</html>
