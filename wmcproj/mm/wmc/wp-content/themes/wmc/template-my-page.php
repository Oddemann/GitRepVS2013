<?php
/* Template name: My page */
get_header();
the_post();

if(get_post_meta(get_the_ID(), 'header', true) != 'no'){
	echo avia_title();
}
?>

<div class="container_wrap container_wrap_first main_color <?php avia_layout_class('main'); ?>">
	<div class="container">
		<div class="template-page content <?php avia_layout_class('content'); ?> units">

			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>

		</div>

		<?php
		$avia_config['currently_viewing'] = 'page';
		get_sidebar();
		?>
	</div>
</div>

<?php get_footer(); ?>