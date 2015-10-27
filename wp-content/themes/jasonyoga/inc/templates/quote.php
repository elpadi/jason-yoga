<article class="quote" <?php if (isset($quote->thumb)): ?>style="background-image:url(<?php echo $quote->thumb; ?>);"<?php endif; ?>>
	<blockquote><?php echo apply_filters('the_content', '<span class="quote-mark open">“</span>'.$quote->testimonial_quote.'<span class="quote-mark close">”</span>'); ?></blockquote>
	<footer>
		<?php if (!empty($quote->author_url)): ?>
		<a href="<?php echo $quote->author_url; ?>" target="_blank"><?php echo $quote->author_name; ?></a>
		<?php else: ?>
		<span><?php echo $quote->author_name; ?></span>
		<?php endif; ?>
		<?php if (!empty($quote->author_info_parts)): foreach ($quote->author_info_parts as $part): ?> <span><?php echo trim($part); ?></span> <?php endforeach; endif; ?>
	</footer>
</article>
