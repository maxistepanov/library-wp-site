
<?php
/**
	Template Name: Шаблон списка УДК
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package GeneratePress
 */
 
// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

	<div id="primary" <?php generate_content_class();?>>
		<main id="main" <?php generate_main_class(); ?>>
			
			<?php do_action('generate_before_main_content'); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>
				
				<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) : ?>
					<div class="comments-area">
						<?php comments_template(); ?>
					</div>
				<?php endif; ?>

			<?php endwhile; // end of the loop. ?>

			<?php do_action('generate_after_main_content'); ?>
			<!--   my custom code block-->

			<article id="post-158" class="post-158 page type-page status-publish" itemtype="http://schema.org/CreativeWork" itemscope="itemscope">
	<div class="inside-article">
					<header class="entry-header">
					</header><!-- .entry-header -->
				
				<div class="entry-content" itemprop="text">
<div id="wrapper-udk">
	 <div class="dropdown">
	    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Кількість результатів на сторінку
	    <span class="caret"></span></button>
	    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
	      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">10</a></li>
	      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">20</a></li>
	      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">50</a></li>
	    
	    </ul>
	  </div>
	 <br>
	<div class="list-udk">
		
	</div>
	<div class="pagination-wrapper">
		
	</div>
	<div class="other-way"></div>
</div>
<!-- loader -->
<div style="visibility: hidden;" id="cssload-pgloading">
	<div class="cssload-loadingwrap">
		<ul class="cssload-bokeh">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</div>
<!-- end loader -->

				
						</div><!-- .entry-content -->
			</div><!-- .inside-article -->
</article>

<!-- end  my custom code block-->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php 
do_action('generate_sidebars');
get_footer();