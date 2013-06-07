<?php
/*
*The main index template.
*
*/
get_header();?>

<div id="content-wrapper" class="row">
<div class="large-12 columns"> <!--main column-->
<div class="row"><!-- inner row -->
	<div class="large-9 columns">
		<div id="main" role="content" >

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting" >
						
						    <header class="article-header">
							
							    <h1 class="h2" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
							
								<p class="byline vcard"><?php _e('Posted', 'flexfour'); ?> <time class="updated" itemprop="datePublished" datetime="<?php echo the_time('Y-m-d'); ?>" ><?php the_time('F j, Y'); ?></time> <?php _e('by', 'flexfour'); ?> <span class="author" itemprop="author"><?php the_author_posts_link(); ?></span> <span class="amp">&</span> <span itemprop="articleSection"><?php _e('filed under', 'flexfour'); ?> <?php the_category(', '); ?></span>.</p>
						
						    </header> <!-- end article header -->
					
							<section class="entry-content clearfix" itemprop="articleBody">
							<div class="row">
								
								<?php if  (has_post_thumbnail()):?>
	<div class="small-3 columns">
		<?php the_post_thumbnail('thumbnail');?>
										</div>
										<div class="small-9 columns">
											 <?php the_content(); ?></div>
								
								<?php  else :?>
								<div class="small-12 columns">
									<?php the_content();?>
								</div>
<?php endif; ?>
								
								
									
								
								   </div>
						    </section> <!-- end article section -->
						
						    <footer class="article-footer">

    							<p class="tags" itemprop="keywords"><?php the_tags('<span class="tags-title">Tags:</span> ', ', ', ''); ?></p>

						    </footer> <!-- end article footer -->
						    
						    <?php // comments_template(); // uncomment if you want to use them ?>
					
					    </article> <!-- end article -->
			<hr/>
						<?php endwhile; else: ?>	
					<?php flexfour_content_nav( 'nav-below' ); ?>
					     
					    
					        <article id="post-not-found" class="hentry clearfix">
					            <header class="article-header">
					        	    <h1><?php _e("Oops, Post Not Found!", "flexfour"); ?></h1>
					        	</header>
					            <section class="entry-content">
					        	    <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "flexfour"); ?></p>
					        	</section>
					        	<footer class="article-footer">
					        	    <p><?php _e("This is the error message in the index.php template.", "flexfour"); ?></p>
					        	</footer>
					        </article>
					
					    <?php endif; ?>
			
				    </div> <!-- end #main -->
	</div>
	<div class="large-3 columns">
		<?php get_sidebar();?>
	</div><!--end sidebar column-->
	
</div>
</div><!--end main column-->
</div><!--end content-wrapper -->

<?php get_footer();?>