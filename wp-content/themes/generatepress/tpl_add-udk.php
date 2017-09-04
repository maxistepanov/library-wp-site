
<?php
/**
	Template Name: Шаблон УДК
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
			<?php if( is_user_logged_in()) : ?>
				<article id="post-158" class="post-158 page type-page status-publish" itemtype="http://schema.org/CreativeWork" itemscope="itemscope">
	<div class="inside-article">
					<header class="entry-header">
					</header><!-- .entry-header -->
				
				<div class="entry-content" itemprop="text">
				<div id="wrapper-request-udk">
					<form  id="request-ukd" method="post" action="">
				

					ПІБ читача російською мовою (повністю) <br>
					<input id="dfio"  type="text" /> 
					<br>

					Номер штрих-коду читача <br>
					<input id="dkod" type="text" /> 
					<br>

					Назва документа <br>
					<input id="dname"  type="text" /> 
					<br>

					Анотація документа <br>
					<textarea id="dnotat"  cols="40" rows="3"></textarea>
					<br>
					
					<br>
					<input id="submitudk" type="submit"  value="Отправить" />
				</form>
			</div>
			<div id="wrapper-request-answer">
				
			</div>
<!-- loader -->
<div id="cssload-pgloading">
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
<?php else: ?>
				<article id="post-158" class="post-158 page type-page status-publish" itemtype="http://schema.org/CreativeWork" itemscope="itemscope">
	<div class="inside-article">
					<header class="entry-header">
					</header><!-- .entry-header -->
				
				<div class="entry-content" itemprop="text">
				<div id="wrapper">

<h2>Для користування даною послугою необхідно авторизуватись в системі</h2>
<form action="/wp-admin">
    <input type="submit" value="Авторизація" />
</form>
			</div>
		


				
						</div><!-- .entry-content -->
			</div><!-- .inside-article -->
</article>
<?php endif ?>


		

<!-- end  my custom code block-->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php 
do_action('generate_sidebars');
get_footer();