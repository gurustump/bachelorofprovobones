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
									<div class="current-season">
										<?php print_r( get_option('bachelor_main_options')); ?>
										<br />
										<?php echo get_option('bachelor_main_options')['current_season']; ?>
									</div>
									<?php 
									$currentSeason = get_option('bachelor_main_options')['current_season'];
									$currentShowType = get_option('bachelor_main_options')['current_show_type'];
									$currentContestantType = $currentShowType == 'bachelor' ? 'bachelorette' : 'bachelor';
									//echo ucfirst($currentShowType);
									// echo ucfirst($currentContestantType);
									$testorama = ucfirst($currentContestantType);
									$currentStar = get_posts(array(
										'post_type' => 'people',
										'tax_query' => array(
											array(
												'taxonomy' => 'person_cat',
												'field' => 'slug',
												'terms' => 'season-'.$currentSeason.'-star',
											)
										),
									));
									$currentCast = get_posts(array(
										'post_type' => 'people',
										'tax_query' => array(
											array(
												'taxonomy' => 'person_cat',
												'field' => 'slug',
												'terms' => 'season-'.$currentSeason.'-competitor',
											)
										),
									));
									$currentHost = get_posts(array(
										'post_type' => 'people',
										'tax_query' => array(
											array(
												'taxonomy' => 'person_cat',
												'field' => 'slug',
												'terms' => 'season-'.$currentSeason.'-host',
											)
										),
									));
									function castMemberMarkup($castMember,$type) {
										global $currentContestantType,$currentShowType;
										$castMemberMeta = get_post_meta($castMember->ID);
										$exit_episode = $castMemberMeta['_bachelor_person_exit_episode'][0];
										$cast_type = 'test';
										$markup = '<div class="'.$type.($exit_episode ? ' retired' : '').'">';
										$markup .= (string)$testorama;
										$markup .= '<a href="'.get_permalink($castMember->ID).'">';
										if (has_post_thumbnail($castMember->ID)) {
											$markup .= '<span class="image-container">';
											$markup .= '<img src="'.get_the_post_thumbnail_url($castMember->ID,'thumbnail').'" alt="'.$castMember->post_name.'" />';
											$markup .= '</span>';
										}
										$markup .= '<span class="cast-name">'.$castMember->post_title.'</span>';
										$markup .= '<span class="cast-type">';
										$markup .= $type == 'host' ? 'Host' : $type == 'contestant' ? ucfirst($currentContestantType) : ucfirst($currentShowType);
										$markup .= '</span>';
										$markup .= '</a>';
										$markup .= '</div>';
										$markup .= '<pre style="padding:20px 30px;font-size:10px;border:1px solid #eee;margin-bottom:20px;">';
										$markup .= print_r($castMember,true);
										$markup .= '</pre>';
										return $markup;
									}
									if (count($currentStar) > 0 || count($currentCast) > 0) { ?>
									<div class="current-contestants">
										<h2>Current Cast</h2>
										<?php foreach($currentStar as $key => $castMember) {
											echo castMemberMarkup($castMember,'star');
										}
										foreach($currentCast as $key => $castMember) { 
											echo castMemberMarkup($castMember,'contestant');
											print_r( setCastMemberType('contestant'));
										}
										foreach($currentHost as $key => $castMember) { 
											echo castMemberMarkup($castMember,'host');
										} ?>
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
