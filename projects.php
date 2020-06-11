<?php

/**
 * Template Name: Projects Page
 *
 * @package Wisteria
 */
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

get_header(); ?>

	<div class="container">
		<div class="row">
			<main class="site-main" role="main">

				<div class="post-wrapper post-wrapper-single post-wrapper-page">
				<?php

					$args = array(
						'post_type' => 'projects'
					);
					$the_query = new WP_Query( $args );

				if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
										<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
												<!-- Subtitle widget area -->
												
													<div class="excerpt-wrapper"><!-- Excerpt -->

														<div class="wrapper-excerpt-thumbnail">
															<?php
															if ( get_theme_mod( 'ribosome_thumbnail_rounded', '' ) == '' ) {
																the_post_thumbnail( 'ribosome-excerpt-thumbnail' );
															} else {
																the_post_thumbnail( 'ribosome-excerpt-thumbnail-rounded' );
															}
															?>
														</div>
														<div style="min-height:14rem; display:flex; flex-direction: column; justify-content: space-between;">
														<header class="entry-header">
															<h2 class="entry-title">
																<?php the_title(); ?>
															</h2>
														</header>
														<div><?php the_content(); ?></div>
														<div style="font-size:1.6rem;">
															<a href="<?php the_field( 'demo' ); ?>">Demo</a>
														</div>
														</div>
													</div><!-- .excerpt-wrapper -->
												
													<footer class="entry-meta">
														<!-- Post end widget area -->
														<?php if ( is_single() ) : ?>
															<div class="post-end-widget-area">
																<?php if ( ! dynamic_sidebar( 'wt-post-end' ) ) {} ?>
															</div>
														<?php endif; ?>

														<?php
														if ( is_single() || ( is_home() && get_theme_mod( 'ribosome_contenido_completo_entradas_pp', '' ) == 1 ) ) {
															?>
															<div class="entry-meta-term-single">
															<?php
														} else {
															?>
															<div class="entry-meta-term-excerpt">
															<?php
														}
														?>

															<span class="entry-meta-categories"><span class="term-icon"><i class="fa fa-folder-open"></i></span> <?php echo get_the_term_list( $post->ID, 'category', '', ', ', '' ); ?>&nbsp;&nbsp;&nbsp;</span>

															<?php
															$post_tags = get_the_term_list( $post->ID, 'post_tag' );
															if ( $post_tags ) {
																?>
																<span class="entry-meta-tags"><span class="term-icon"><i class="fa fa-tags"></i></span> <?php echo get_the_term_list( $post->ID, 'post_tag', '', ', ', '' ); ?></span>
																<?php
															}
															?>

															<div style="float:right;"><?php edit_post_link( __( 'Edit', 'ribosome' ), '<span class="edit-link">', '</span>' ); ?></div>
														</div><!-- .entry-meta-term -->

														<?php
														// Related posts.
														if ( is_single() && get_theme_mod( 'ribosome_related_posts', '' ) == 1 ) {
															get_template_part( RIBOSOME_TEMPLATE_PARTS . 'related-posts' );
														}
														// Author info.
														if ( is_singular() && get_the_author_meta( 'description' ) ) {
															get_template_part( RIBOSOME_TEMPLATE_PARTS . 'author-info-box' );
														}
													//} // (else) if ( is_sticky() && is_home() ).
													?>
													</footer><!-- .entry-meta -->
											</article>
					<?php
						endwhile;

						ribosome_the_posts_pagination(); 
					else: ?>

					<article id="post-0" class="post no-results not-found">

					<?php if ( current_user_can( 'edit_posts' ) ) :
						// Show a different message to a logged-in user who can add posts.
					?>
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'No posts to display', 'ribosome' ); ?></h1>
						</header>

						<div class="entry-content">
							<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'ribosome' ), admin_url( 'post-new.php' ) ); ?></p>
						</div><!-- .entry-content -->

					<?php else :
						// Show the default message to everyone else.
					?>
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'Nothing Found', 'ribosome' ); ?></h1>
						</header>

						<div class="entry-content">
							<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'ribosome' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .entry-content -->
					<?php endif; // end current_user_can() check ?>

					</article><!-- #post-0 -->

					<?php endif; // end have_posts() check ?>
				</div><!-- .post-wrapper -->

			</main><!-- #main -->
			<?php get_sidebar(); ?>
		</div><!-- .row -->
	</div><!-- .container -->

<?php get_footer(); ?>