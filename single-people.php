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
						
						<?php $personMeta = get_post_meta(get_the_ID()); 
						$personName = $personMeta['_bachelor_person_role'][0] == 'crew' ? $personMeta['_bachelor_person_first_name'][0].' '.$personMeta['_bachelor_person_last_name'][0] : get_the_title();
						?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">
							<header class="article-header">
								<div class="title-container">
									<h1 class="single-title custom-post-type-title"><?php echo $personName; ?></h1>
									<?php if ($personMeta['_bachelor_person_age'][0] || $personMeta['_bachelor_person_college_major'][0] || $personMeta['_bachelor_person_occupation'][0] || $personMeta['_bachelor_person_instagram'][0] || $personMeta['_bachelor_person_homepage_url'][0]) { ?>
									<table class="byline">
										<?php if ($personMeta['_bachelor_person_age'][0]) { ?>
										<tr><td colspan="2"><?php echo $personMeta['_bachelor_person_age'][0]; ?></td></tr>
										<?php } ?>
										<?php if ($personMeta['_bachelor_person_college_major'][0]) { ?>
										<tr><td>major: </td><td><?php echo $personMeta['_bachelor_person_college_major'][0]; ?></td></tr>
										<?php } ?>
										<?php if ($personMeta['_bachelor_person_occupation'][0]) { ?>
										<tr><td>occupation: </td><td><?php echo $personMeta['_bachelor_person_occupation'][0]; ?></td></tr>
										<?php } ?>
										<?php if ($personMeta['_bachelor_person_instagram'][0]) { ?>
										<tr><td>IG:</td><td><a target="_blank" href="https://instagram.com/<?php echo str_replace('@','',$personMeta['_bachelor_person_instagram'][0]); ?>">@<?php echo str_replace('@','',$personMeta['_bachelor_person_instagram'][0]); ?></a></td></tr>
										<?php } ?>
										<?php if ($personMeta['_bachelor_person_homepage_url'][0]) { ?>
										<tr><td>homepage:</td><td><a target="_blank" href="<?php echo $personMeta['_bachelor_person_homepage_url'][0]; ?>"><?php echo $personMeta['_bachelor_person_homepage_url'][0]; ?></a></td></tr>
										<?php } ?>
										<?php if ($personMeta['_bachelor_person_crew_position'][0]) { ?>
										<tr><td>crew position:</td><td><?php echo $personMeta['_bachelor_person_crew_position'][0]; ?></td></tr>
										<?php } ?>
										<?php /* <p><?php echo $personMeta['_bachelor_person_'][0]; ?></p> */?>
									</table>
									<?php } ?>
								</div>
								<?php if (has_post_thumbnail()) { ?>
								<div class="image-container">
									<img src="<?php the_post_thumbnail_url('large'); ?>" alt="" />
								</div>
								<?php } ?>
							</header>

							<section class="entry-content cf">
								<?php the_content(); ?>
							</section> <!-- end article section -->
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
