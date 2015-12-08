<?php get_header();?>
<div id="container">
	<?php if(have_posts()):?><?php while(have_posts()):the_post();?>

		<div class="post" id="post-<?php the_ID();?>">

		<h2>
			<a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>
		</h2>

		<div class="entry">

   				 <?php the_excerpt();?>
   				<p class="postmetadata">
				<span class="metayuan">	<?php _e('分类&#58;'); ?> <?php the_category(', ') ?> </span>
				<span class="metazz"><?php _e('&#9812;'); ?>  <a
					href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>"><?php
			echo get_the_author ()?></a>&#124;</span>
 				<span class="metapl">
				 <?php comments_popup_link('暂无评论 &#187;', '1 条评论 &#187;', '% 条评论 &#187;'); ?></span>
				<span class="metabj">
				  <?php edit_post_link('编辑', ' &#124; ', ''); ?>
				</span>	
				阅读：<?php post_views(' ', ' 次'); ?>			
				</p>
		</div>
	</div>

    <?php endwhile;?>

    <div class="navigation">
    	<?php posts_nav_link('','','');?>
    </div>

<?php else:?>
	<div class="post">
		<h2>没有文章</h2>
	</div>

    <?php endif;?>
<div class="page_navi"><?php par_pagenavi(9); ?></div>
</div>

<?php get_sidebar();?>
<?php get_footer();?>
