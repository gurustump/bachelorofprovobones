<?php
/*
 Template Name: Home Page
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>
			<div id="content">
				<div id="inner-content" class="wrap cf">
						<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								<section class="entry-content cf" itemprop="articleBody">
								
									<?php 
									$currentSeasonID = get_option('bachelor_main_options')['current_season'];
									$currentSeasonEpisodeIDs = get_post_meta($currentSeasonID,'_bachelor_season_attached_episodes',true);
									$currentMostRecentEpisode = get_posts(array(
										'post_type' => 'episodes',
										'post__in' => $currentSeasonEpisodeIDs,
										'numberposts' => 1,
									));
									
									$homeModule = get_posts(array( 
										'numberposts' => 1,
										'post_type' => 'modules',
										'meta_query' => array(
											array(
												'key' => '_bachelor_module_location',
												'value' => 'home',
												'compare' => 'LIKE',
											),
										),
									)); ?>
									<div class="content-primary<?php echo $homeModule ? ' home-module-container':''; ?>">
										<div class="current-episode">
											<?php if ($currentSeasonEpisodeIDs) { ?>
												<h2>Latest Episode</h2>
												<?php echo createYoutubePlayer(getYoutubeIDfromURL(get_post_meta($currentMostRecentEpisode[0]->ID,'_bachelor_episode_youtube_url',true)));
											} else { ?>
												<h2><?php echo get_post_meta(get_the_ID(),'_bachelor_page_main_section_title',true); ?></h2>
												<div class="main-section-content"><?php echo wpautop(do_shortcode(get_post_meta(get_the_ID(),'_bachelor_page_main_section_content',true))); ?></div>
											<?php } ?>
										</div>
										<?php if ($homeModule) { foreach($homeModule as $module) { ?>
										<div class="home-module">
											<h2 class="module-title"><?php echo $module->post_title; ?></h2>
											<div class="module-content"><?php echo wpautop(do_shortcode($module->post_content)); ?></div>
										</div>
										<?php /*<pre style="clear:both"><?php print_r($module); ?></pre>*/ ?>
										<?php } } ?>
									</div>
									<?php 
									$sponsors = get_posts(array(
										'numberposts' => -1,
										'post_type' => 'sponsor',
										'meta_query' => array(
											/*array(
												'key' => '_bachelor_sponsor_type',
												'value' => 'sponsor',
												'compare' => 'LIKE',
											),*/
											array(
												'key' => '_bachelor_sponsor_location',
												'value' => 'home-slider',
												'compare' => 'LIKE',
											),
										),
										'tax_query' => array(
											array(
												'taxonomy' => 'sponsor_cat',
												'field' => 'slug',
												'terms' => 'season-'.get_post(get_option('bachelor_main_options')['current_season'])->post_title,
											),
										),
									));
									if ($sponsors) { ?>
									<div class="sponsor-container">
										<h2>Sponsors</h2>
										<div class="slider-list sponsor-list SLICK_SPONSOR_LIST">
											<?php foreach($sponsors as $sponsor) {
											if (!has_post_thumbnail($sponsor->ID)) { continue; } 
											$sponsorURL = get_post_meta($sponsor->ID,'_bachelor_sponsor_website',true);
											?>
											<div class="slider-item sponsor SLICK_SPONSOR_ITEM">
												<?php echo $sponsorURL ? '<a target="_blank" href="'.$sponsorURL.'">' : ''; ?>
													<img src="<?php echo get_the_post_thumbnail_url($sponsor->ID,'thumbnail'); ?>" alt="<?php echo $sponsor->post_title; ?>" />
													<span class="slider-item-title sponsor-name"><?php echo $sponsor->post_title; ?></span>
												<?php echo $sponsorURL ? '</a>' : ''; ?>
											</div>
											<?php } ?>
										</div>
									</div>
									<?php } ?>
									
									<?php
									$currentSeasonCast = get_post_meta($currentSeasonID,'_bachelor_season_attached_people',true);
									if ($currentSeasonCast) { ?>
									<div class="current-cast cast-list">
										<h2>Current Cast</h2>
										<div class="thumb-list">
											<?php foreach($currentSeasonCast as $key => $castMemberID) {
												$castMember = get_post($castMemberID);
												$role = get_post_meta($castMemberID,'_bachelor_person_role',true);
												echo personThumbMarkup($castMember,$role,false);
											} ?>
										</div>
									</div>
									<?php } ?>
									<?php the_content(); ?>
								</section>
							</article>
							<?php endwhile; else : ?>
									<article id="post-not-found" class="hentry cf">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>
							<?php endif; ?>
						</main>
				</div>
			</div>
<?php get_footer(); ?>
