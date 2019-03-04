<?php
/*
 * SINGLE PERSON TEMPLATE
 *
 * This is the single template for the "People" custom post type
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap cf">
					<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
						<?php $thisSeason = get_posts(array(
							'numberposts' => 1,
							'post_type' => 'seasons',
							'meta_query' => array(
								array(
									'key' => '_bachelor_season_attached_episodes',
									'value' => get_the_ID(),
									'compare' => 'LIKE',
								),
							),
						)); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">
							<header class="article-header">
								<h1 class="single-title custom-post-type-title">Episode <?php the_title(); ?></h1>
								<div class="breadcrumb"><a href="<?php echo get_the_permalink($thisSeason[0]->ID); ?>">Season <?php echo $thisSeason[0]->post_title; ?></a></div>
							</header>
							<?php $modules = get_posts(array( 
								'numberposts' => -1,
								'post_type' => 'modules',
								'meta_query' => array(
									array(
										'key' => '_bachelor_module_location',
										'value' => 'episodes',
										'compare' => 'LIKE',
									),
								),
								'order' => 'ASC',
								'orderby' => 'meta_value',
								'meta_key' => '_bachelor_module_priority',
							));
							$hasContentSecondary = $modules || is_active_sidebar('sidebar1');
							?>
							<section class="entry-content<?php echo $hasContentSecondary ? ' has-content-secondary':''; ?>">
								<div class="content-primary">
									<?php echo createYoutubePlayer(getYoutubeIDfromURL(get_post_meta(get_the_ID(),'_bachelor_episode_youtube_url',true))); ?>
									<div class="episode-description">
										<?php the_content(); ?>
									</div>
								</div>
								<?php if ($hasContentSecondary) { ?>
								<div class="content-secondary">
									<?php if ($modules) { ?>
									<div class="modules">
										<?php foreach($modules as $module) { ?>
										<div class="module">
											<h2 class="module-title"><?php echo $module->post_title; ?></h2>
											<div class="module-content"><?php echo wpautop(do_shortcode($module->post_content)); ?></div>
										</div>
										<?php } ?>
									</div>
									<?php } ?>
									<?php if (is_active_sidebar('sidebar1')) { 
										get_sidebar();
									} ?>
								</div>
								<?php } ?>
							</div>
						</article>
						<?php endwhile; ?>
						<?php else : ?>
								<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
										<p><?php _e( 'This is the error message in the single-custom_type.php template.', 'bonestheme' ); ?></p>
									</footer>
								</article>
						<?php endif; ?>
					</main>
				</div>
			</div>

<?php get_footer(); ?>
