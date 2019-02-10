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
											<h2>Latest Episode</h2>
											<?php $currentMostRecentEpisode = get_posts(array(
												'post_type' => 'episodes',
												'post__in' => $currentSeasonEpisodeIDs,
												'numberposts' => 1,
											));
											echo createYoutubePlayer(getYoutubeIDfromURL(get_post_meta($currentMostRecentEpisode[0]->ID,'_bachelor_episode_youtube_url',true))); ?>
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
									$currentSeasonType = get_post_meta($currentSeasonID,'_bachelor_season_show_type',true);
									$currentSeasonCast = get_post_meta($currentSeasonID,'_bachelor_season_attached_people',true);
									if ($currentSeasonCast) { ?>
									<div class="current-cast cast-list">
										<h2>Current Cast</h2>
										<div class="thumb-list">
											<?php foreach($currentSeasonCast as $key => $castMemberID) {
												$castMember = get_post($castMemberID);
												$role = get_post_meta($castMemberID,'_bachelor_person_role',true);
												echo castMemberMarkup($castMember,$role,$currentSeasonType);
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
