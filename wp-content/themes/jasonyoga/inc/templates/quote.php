<article class="quote">
	<blockquote><?php echo apply_filters('the_content', '<span class="quote-mark open">“</span>'.$quote->testimonial_quote.'<span class="quote-mark close">”</span>'); ?></blockquote>
	<footer>
		<span><?php echo $quote->author_name; ?></span>
		<?php if (!empty($quote->author_info_parts)): foreach ($quote->author_info_parts as $part): ?> <span><?php echo trim($part); ?></span> <?php endforeach; endif; ?>
	</footer>
</article>
