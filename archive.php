<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<div class="row">
<div class="small-12 columns">
<div class="row">
<div class="large-9 columns">
	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'flexfour' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'flexfour' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'flexfour' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'flexfour' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'flexfour' ) ) . '</span>' );
					else :
						_e( 'Archives', 'flexfour' );
					endif;
				?></h1>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

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

			endwhile;

			flexfour_content_nav( 'nav-below' );
			?>

		<?php else : ?>
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

		</div><!-- #content -->
	</section><!-- #primary -->
</div>
<div class="large-3 columns">

<?php get_sidebar(); ?>
</div>
</div>
</div>
</div>
<?php get_footer(); ?>