<?php get_header();?>
<div id="single-container">

	<?php if(have_posts()):?><?php while(have_posts()):the_post();?>

		<div class="post" id="post-<?php the_ID();?>" >
              
    		<h2><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h2>
               <p class="postmetadata">
				 <?php _e('分类&#58;'); ?> <?php the_category(', ') ?> <?php _e('&#9812;'); ?> <?php  the_author(); ?>		 
				</p>
  		  <div class="entry">

   				 <?php the_content();?>
                 <?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>
   				 

   		  </div>
        

		</div>

    <?php endwhile;?>

    <div class="navigation">
    	<?php previous_post_link('上篇 &#8674; %link')?><br/>
    	<?php next_post_link('下篇  &#8674; %link ')?>
    </div>
    <div class="comments-template">
          <?php comments_template();?>
        </div>

<?php else:?>
	<div class="post">
       <h2>	没有文章</h2>
	</div>

    <?php endif;?>

</div>
<?php get_footer();?>
