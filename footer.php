
<footer itemscope itemtype="http://schema.org/WPFooter">
<div class="row" id="footer">
		<div class="large-12 columns">
	<div class="row">
		
				
		
<div class="large-4 columns">
	<div class="widget-area">
	
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Area 1')) : ?>
	<div class="alert-box"><h4>Hey! You!</h4>
		You should like, so test out this dynamic sidebar. Check it out in Appearance > Widgets!</div>
		<?php endif; ?>
        </div>
	</div>
		
		
            <div class="large-4 columns">
				<div class="widget-area">
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Area 2')) : ?>
		<div class="alert-box"><h4>Hey! You!</h4>
		You should like, so test out this dynamic sidebar. Check it out in Appearance > Widgets!</div>
		<?php endif; ?>
        </div></div>
            <div class="large-4 columns">
				<div class="widget-area">
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Area 3')) : ?>
		<div class="alert-box"><h4>Hey! You!</h4>
		You should like, so test out this dynamic sidebar. Check it out in Appearance > Widgets!</div>
		<?php endif; ?>
        </div>
		</div>
	</div>
	<div class="row">
	
	<div class="small-6 columns">
	<?php if(of_get_option('flexfour_credit_link','no entry')):?>
	Lovingly made by <a href="http://lautman.ca" target="_blank" title="The Lautman Group - Digital Marketing. Done Well.">The Lautman Group</a>
	<?php else: ?>
	<?php endif;?>
	</div>
	<div class="small-6 columns">
	<p><?php echo of_get_option('flexfour_copyright_option', 'copyright 2012'); ?></p>
	</div>
	</div>
</div>
</div>

 <script>
  document.write('<script src=' +
				 ('__proto__' in {} ? 'wp-content/themes/flexfour/js/vendor/zepto' : 'wp-content/themes/flexfour/js/vendor/jquery') +
  '.js><\/script>')
  </script>
<?php wp_footer();?>
<script>
  $(document).foundation();
</script>
	</footer>
</body>

	
</html>