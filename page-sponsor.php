<?php
/*
 Template Name: Sponsor Page
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
								<section class="entry-content cf" itemprop="articleBody">
									<div class="page-content">
										<?php the_content(); ?>
									</div>
									<?php 
									$sponsors = get_posts(array(
										'numberposts' => -1,
										'post_type' => 'sponsor',
										'meta_query' => array(
											array(
												'key' => '_bachelor_sponsor_type',
												'value' => 'sponsor',
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
									<div class="slider-list sponsor-list">
										<?php foreach($sponsors as $sponsor) {
										if (!has_post_thumbnail($sponsor->ID)) { continue; } 
										$sponsorURL = get_post_meta($sponsor->ID,'_bachelor_sponsor_website',true);
										?>
										<div class="slider-item sponsor">
											<?php echo $sponsorURL ? '<a target="_blank" href="'.$sponsorURL.'">' : ''; ?>
												<img src="<?php echo get_the_post_thumbnail_url($sponsor->ID,'thumbnail'); ?>" alt="<?php echo $sponsor->post_title; ?>" />
												<span class="slider-item-title sponsor-name"><?php echo $sponsor->post_title; ?></span>
											<?php echo $sponsorURL ? '</a>' : ''; ?>
										</div>
										<?php } ?>
									</div>
									<?php } ?>
								</section> <?php // end article section ?>
							</article>
							<?php endwhile; endif; ?>
						</main>
				</div>
			</div>
<?php get_footer(); ?>
