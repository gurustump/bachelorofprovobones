<?php get_header(); ?>

			<div id="content">
				<div id="inner-content" class="wrap cf">
						<?php $modules = get_posts(array( 
							'numberposts' => -1,
							'post_type' => 'modules',
							'meta_query' => array(
								array(
									'key' => '_bachelor_module_location',
									'value' => 'post-index',
									'compare' => 'LIKE',
								),
							),
							'order' => 'ASC',
							'orderby' => 'meta_value',
							'meta_key' => '_bachelor_module_priority',
						)); 
						$page_title = get_the_title( get_option('page_for_posts', true) );
						$hasContentSecondary = $modules || is_active_sidebar('sidebar1');
						?>
						<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
							<header class="page-header">
								<h1 class="page-title" itemprop="headline"><?php echo $page_title; ?></h1>
							</header> <?php // end article header ?>
							<div<?php echo $hasContentSecondary ? ' class="has-content-secondary"':''; ?>>
								<div class="content-primary">
									<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
										<?php if (has_post_thumbnail()) { ?>
										<div class="image-container">
											<a href="<?php the_permalink() ?>">
												<img src="<?php the_post_thumbnail_url('movie-thumb'); ?>" alt="" />
											</a>
										</div>
										<?php } ?>
										<header class="article-header">
											<h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
											<p class="byline vcard">
												<?php printf( __( 'Posted <time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')) ); ?>
											</p>
										</header>
										<section class="entry-content cf">
											<?php the_excerpt(); ?>
										</section>
									</article>
									<?php endwhile; ?>
											<?php bones_page_navi(); ?>
									<?php else : ?>
									<article id="post-not-found" class="hentry cf">
											<header class="article-header">
												<h2><?php _e( 'Coming Soon', 'bonestheme' ); ?></h2>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Looks like we have yet to post any content here. Try back later.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<!--<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>-->
										</footer>
									</article>
									<?php endif; ?>
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
						</main>
				</div>
			</div>


<?php get_footer(); ?>
