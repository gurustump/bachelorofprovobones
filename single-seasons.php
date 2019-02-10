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

						<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">
							<header class="article-header">
								<h1 class="single-title custom-post-type-title">Season <?php the_title(); ?></h1>
								<section class="season-description">
									<?php the_content(); ?>
								</section>
								<?php if (has_post_thumbnail()) { ?>
								<div class="image-container">
									<img src="<?php the_post_thumbnail_url('large'); ?>" alt="" />
								</div>
								<?php } ?>
							</header>
							<?php
							$seasonModules = get_posts(array( 
								'numberposts' => -1,
								'post_type' => 'modules',
								'meta_query' => array(
									array(
										'key' => '_bachelor_module_location',
										'value' => 'season',
										'compare' => 'LIKE',
									),
								),
								'order' => 'ASC',
								'orderby' => 'meta_value',
								'meta_key' => '_bachelor_module_priority',
							));
							$seasonType = get_post_meta(get_the_ID(),'_bachelor_season_show_type',true);
							$seasonCast = get_post_meta(get_the_ID(),'_bachelor_season_attached_people',true);
							$seasonEpisodes = get_post_meta(get_the_ID(),'_bachelor_season_attached_episodes',true);
							?>
							<section class="entry-content<?php echo ($seasonModules || $seasonCast) ? ' has-content-secondary':''; ?>">
								<div class="content-primary">
									<div class="episode-guide">
										<?php
										if ($seasonEpisodes) { ?>
											<h2>Episode Guide</h2>
											<ul class="episode-list">
											<?php foreach($seasonEpisodes as $episodeID) { 
												$episode = get_post($episodeID); ?>
												<li>
													<?php 
													$youtubeURL = get_post_meta($episodeID,'_bachelor_episode_youtube_url',true);
													if (has_post_thumbnail($episodeID) || $youtubeURL) { ?>
													<div class="image-container">
														<a href="<?php echo get_post_permalink($episodeID); ?>">
															<?php if (has_post_thumbnail($episodeID)) { ?>
															<img src="<?php echo get_the_post_thumbnail_url($episodeID,'large'); ?>" alt="" />
															<?php } elseif ($youtubeURL) { 
																echo getYoutubePoster(getYoutubeIDfromURL($youtubeURL),false); 
															} ?>
														</a>
													</div>
													<?php } ?>
													<div class="content-container">
														<?php /*<pre><?php print_r($episode); ?></pre> */ ?>
														<h3><a href="<?php echo get_post_permalink($episodeID); ?>">Episode <?php echo $episode->post_title; ?></a></h3>
														<div class="episode-description">
															<?php echo $episode->post_excerpt; ?>
														</div>
													</div>
												</li>
											<?php } ?>
											</ul>
										<?php } ?>
									</div>
								</div>
								<?php
								if ($seasonModules || $seasonCast) { ?>
								<div class="content-secondary">
									<?php if ($seasonModules) { ?>
									<div class="modules">
										<?php foreach($seasonModules as $module) { ?>
										<div class="module">
											<h2 class="module-title"><?php echo $module->post_title; ?></h2>
											<div class="module-content"><?php echo wpautop(do_shortcode($module->post_content)); ?></div>
										</div>
										<?php } ?>
										</div>
									<?php } ?>
									<?php if ($seasonCast) { ?>
									<div class="cast-list">
										<h2>Cast</h2>
										<div class="thumb-list">
											<?php foreach($seasonCast as $key => $castMemberID) {
												$castMember = get_post($castMemberID);
												$role = get_post_meta($castMemberID,'_bachelor_person_role',true);
												echo castMemberMarkup($castMember,$role,$seasonType);
											} ?>
										</div>
									</div>
									<?php } ?>
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
