<?php get_header(); ?>

    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>

        <div class="content-title">
            <?php the_category(' <span>/</span> '); ?>
            <a href="http://facebook.com/share.php?u=<?php the_permalink() ?>&amp;t=<?php echo urlencode(the_title('','', false)) ?>" target="_blank" class="f" title="Share on Facebook"></a>
            <a href="http://twitter.com/home?status=<?php the_title(); ?> <?php echo getTinyUrl(get_permalink($post->ID)); ?>" target="_blank" class="t" title="Spread the word on Twitter"></a>
            <a href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>" target="_blank" class="di" title="Bookmark on Del.icio.us"></a>
            <a href="http://stumbleupon.com/submit?url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(the_title('','', false)) ?>" target="_blank" class="su" title="Share on StumbleUpon"></a>
        </div>

        <div class="entry">
            <div <?php post_class('single clear'); ?> id="post_<?php the_ID(); ?>">
                <div class="post-meta">
                    <h1><?php the_title(); ?></h1>
                    <?php if (ICL_LANGUAGE_CODE == "es"){echo "por"; } else { echo "by"; } ?> <span class="post-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="Posts by <?php the_author(); ?>"><?php the_author(); ?></a></span> <?php if (ICL_LANGUAGE_CODE == "es"){echo "el"; } else { echo "on"; } ?> <span
                        class="post-date"><?php the_time(__('M j, Y')) ?></span> &bull; <span><?php the_time() ?></span> <?php edit_post_link( __( 'Edit entry'), '&bull; '); ?><a
                        href="#comments" class="post-comms"><?php comments_number(__('No Comments'), __('1 Comment'), __('% Comments'), '', __('Comments Closed') ); ?></a></div>
                <div class="post-content"><?php the_content(); ?></div>
                <div class="post-footer"><?php the_tags(__('<strong>Tags: </strong>'), ', '); ?></div>
				<div class="translations">
					<?php
						function icl_post_languages(){
							$languages = icl_get_languages('skip_missing=1');
							if(1 < count($languages)){
								if(ICL_LANGUAGE_CODE == "es"){
									echo "Lee esta entrada en ";
								} else {
									echo "Read this entry in ";
								}						
							foreach($languages as $l){
							  if(!$l['active']) $langs[] = '<a href="'.$l['url'].'">'.$l['translated_name'].'</a>';
							}
							echo join(', ', $langs);
						  }
						}
						icl_post_languages();
					?>
				</div>
                <div class="author-bio">
					<h2>Meet <a href="<?php the_author_url(); ?>" target="_blank"><?php the_author_nickname(); ?></a></h2>
					<img src="<?php bloginfo('template_url'); ?>/images/<?php the_author_nickname(); ?>.jpg" alt="" class="alignleft"/>
					<p><?php the_author_description(); ?></p>
				</div>
            </div>
            <div class="post-navigation clear">
                <?php
                    $prev_post = get_adjacent_post(false, '', true);
                    $next_post = get_adjacent_post(false, '', false); ?>
                    <?php if ($prev_post) : $prev_post_url = get_permalink($prev_post->ID); $prev_post_title = $prev_post->post_title; ?>
                        <a class="post-prev" href="<?php echo $prev_post_url; ?>"><em><?php if (ICL_LANGUAGE_CODE == "es"){echo "Entrada anterior"; } else { echo "Previous post"; } ?></em><span><?php echo $prev_post_title; ?></span></a>
                    <?php endif; ?>
                    <?php if ($next_post) : $next_post_url = get_permalink($next_post->ID); $next_post_title = $next_post->post_title; ?>
                        <a class="post-next" href="<?php echo $next_post_url; ?>"><em><?php if (ICL_LANGUAGE_CODE == "es"){echo "Entrada posterior"; } else { echo "Next post"; } ?></em><span><?php echo $next_post_title; ?></span></a>
                    <?php endif; ?>
                <div class="line"></div>
            </div>
        </div>

        <?php endwhile; ?>
    <?php endif; ?>

<?php comments_template(); ?>

<?php get_footer(); ?>