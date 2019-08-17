<?php
/*
 Template Name: Crew Page
*/
?>

<?php get_header(); ?>

			<div id="content">
				<div id="inner-content" class="wrap cf">
						<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								<header class="article-header">
									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
								</header> <?php // end article header ?>
								<?php $modules = get_posts(array( 
									'numberposts' => -1,
									'post_type' => 'modules',
									'meta_query' => array(
										array(
											'key' => '_bachelor_module_location',
											'value' => 'pages',
											'compare' => 'LIKE',
										),
									),
									'order' => 'ASC',
									'orderby' => 'meta_value',
									'meta_key' => '_bachelor_module_priority',
								));
								$hasContentSecondary = $modules || is_active_sidebar('sidebar1');
								?>
								<section class="entry-content<?php echo $hasContentSecondary ? ' has-content-secondary':''; ?>" itemprop="articleBody">
									<div class="content-primary">
										<?php the_content(); ?>
										<div class="crew-list">
										<?php echo crewListMarkup('h2',false); ?>
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
										<?php }
										if (is_active_sidebar('sidebar1')) { 
											get_sidebar();
										} ?>
									</div>
									<?php } ?>
								</section> <?php // end article section ?>
							</article>
							<?php endwhile; endif; ?>
						</main>
				</div>
			</div>
<?php get_footer(); ?>
