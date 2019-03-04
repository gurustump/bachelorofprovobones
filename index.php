<?php get_header(); ?>

			<div id="content">
				<div id="inner-content" class="wrap cf">
						<?php $postPageModules = get_posts(array( 
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
						?>
						<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
							<header class="page-header">
								<h1 class="page-title" itemprop="headline"><?php echo $page_title; ?></h1>
							</header> <?php // end article header ?>
							<div<?php echo $postPageModules ? ' class="has-content-secondary"':''; ?>>
								<div class="content-primary">
									<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
										<header class="article-header">
											<h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
											<p class="byline vcard">
												<?php printf( __( 'Posted <time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
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
								<?php if ($postPageModules) { ?>
								<div class="content-secondary">
									<?php if ($postPageModules) { ?>
									<div class="modules">
										<?php foreach($postPageModules as $module) { ?>
										<div class="module">
											<h2 class="module-title"><?php echo $module->post_title; ?></h2>
											<div class="module-content"><?php echo wpautop(do_shortcode($module->post_content)); ?></div>
										</div>
										<?php } ?>
										</div>
									<?php } ?>
								</div>
								<?php } ?>
							</div>
						</main>
				</div>
			</div>


<?php get_footer(); ?>
