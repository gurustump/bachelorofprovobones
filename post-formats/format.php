
			<?php
				/*
				 * This is the default post format.
				 *
				 * So basically this is a regular post. if you don't want to use post formats,
				 * you can just copy ths stuff in here and replace the post format thing in
				 * single.php.
				 *
				 * The other formats are SUPER basic so you can style them as you like.
				 *
				 * Again, If you want to remove post formats, just delete the post-formats
				 * folder and replace the function below with the contents of the "format.php" file.
				*/
			?>
			<?php $modules = get_posts(array( 
				'numberposts' => -1,
				'post_type' => 'modules',
				'meta_query' => array(
					array(
						'key' => '_bachelor_module_location',
						'value' => 'posts',
						'compare' => 'LIKE',
					),
				),
				'order' => 'ASC',
				'orderby' => 'meta_value',
				'meta_key' => '_bachelor_module_priority',
			));
			$hasContentSecondary = $modules || is_active_sidebar('sidebar1'); ?>
			<section class="entry-content<?php echo $hasContentSecondary ? ' has-content-secondary':''; ?>" itemprop="articleBody">
				<div class="content-primary">
					<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
						<header class="article-header entry-header">
							<h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
							<p class="byline entry-meta vcard">
								<?php printf( __( 'Posted', 'bonestheme' ).' %1$s',
							   /* the time the post was published */
							   '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>'
							); ?>
							</p>
						</header> <?php // end article header ?>
						<div class="article-body">
							<?php the_content(); ?>
						</div>
						<?php //comments_template(); ?>
					</article> <?php // end article ?>
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
			</section> <?php // end article section ?>
