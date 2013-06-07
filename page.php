<?php
/**
 * The Template for displaying all pages.
 *
 *
 */

get_header(); ?>
<div id="content-wrapper" class="row">
	<div class="large-12 columns">
		
<div class="row">
	<div class="large-9 columns">
		
	
		
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting" >
						
						    <header class="article-header">
							
							    <h1 class="h2" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
							
								
						    </header> <!-- end article header -->
					
							<section class="entry-content clearfix" itemprop="articleBody">
							    <?php the_content(); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'flexfour' ), 'after' => '</div>' ) ); ?>
						    </section> <!-- end article section -->
						
						    <footer class="article-footer">
								
    							<p class="tags" itemprop="keywords"><?php the_tags('<span class="tags-title">Tags:</span> ', ', ', ''); ?></p>

						    </footer> <!-- end article footer -->
						    
						    
					    </article> 

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div>
	<div class="large-3 columns">
		
	
<?php get_sidebar(); ?>
		</div>
	</div>
			</div>
</div>
<?php get_footer(); ?>