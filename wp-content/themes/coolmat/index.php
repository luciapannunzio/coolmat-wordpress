<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package coolmat
 */

get_header();
?>

<main id="primary" class="site-main">

	<!-- our hero element dynamic -->

	<!-- we write our query to grab ourselves one post from the menu category, and make it a random one each time -->

	<?php query_posts('posts_per_page=1&category_name=menu&orderby=rand'); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="hero">
				<div class="hero-inner container">
					<h1 class="hero-text lowercase">
						<!-- Here we use the template tag to grab the site name -->
						<span class="hero-sitename"><?php bloginfo('name'); ?></span><?php the_title(); ?>

					</h1>
					<p class="hero-description">
						<span class="magenta"><?php bloginfo('name'); ?></span> <?php bloginfo('description'); ?>
					</p>
				</div>
			</div>

	<?php
		endwhile;
	endif;
	?>

	<!-- Query for our intro custom post and to get just one single post-->
	<?php query_posts('posts_per_page=1&post_type=intro'); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="intro" id="intro">
				<div class="intro-inner">
					<h2 class="intro-title"><?php the_title(); ?></h2>
					<div class="intro-description">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
	<?php
		endwhile;
	endif;
	?>

	<div class="section-heading" id="food">
		<?php get_category_description('category_name=menu') ?>
	</div>

	<div class="grid">

		<?php
		// we make sure to override our query otherwise the one from above will still be used in this loop
		query_posts('posts_per_page=20&category_name=menu');
		if (have_posts()) :
			/* Start the Loop */
			$item_number = 1;
			while (have_posts()) :
				the_post();
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part('template-parts/content', get_post_type());
				// increments the number 
				$item_number++;
			endwhile;
			the_posts_navigation();
		else :
			get_template_part('template-parts/content', 'none');
		endif;
		?>
	</div>

	<div class="section-heading" id="locations">
	<?php get_category_description('post_type=location'); ?>
	</div>

	<div class="locations">
    <!-- We query our location custom post types -->
	<?php query_posts('post_type=location'); ?>
	<!-- we loop over them -->
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!-- each individual location -->
		<div class="location grid">

			<!-- our map on the left -->
			<div class="map">
				<!-- our map embed goes in here -->
				<div class="map-inner">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3162.932491799999!2d126.86392899714912!3d37.55665426388287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357c9c03c38738ad%3A0x1eff909f2c04315c!2s284-10%20Yeomchang-dong%2C%20Gangseo-gu%2C%20Seoul%2C%20Corea%20del%20Sur!5e0!3m2!1ses-419!2sde!4v1737738795026!5m2!1ses-419!2sde" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>

			<div class="location-info">
				<!-- our location info goes here -->
				<div class="location-description">
				<?php the_content(); ?>
				</div>
			</div>
		</div>

		<?php endwhile; endif; ?> 
	</div>

</main><!-- #main -->
<?php

get_footer();