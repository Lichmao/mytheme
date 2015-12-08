<?php
if ( function_exists('register_sidebar') )
    register_sidebar();
/*后台添加链接选项*/
add_filter('pre_option_link_manager_enabled', '__return_true');
/*注册菜单*/
 register_nav_menus(
      array(
      'header_menu' => __( '头部主导航' ),
      )
    );
/*控制文章摘要显示字数*/
function custom_excerpt_length( $length ) {
	return 120;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
/*摘要后添加阅读更多*/
function new_excerpt_more($more) {
	global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '"> 阅读更多...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
//分页
function par_pagenavi($range = 9){
	if ( is_singular() ) return;
	global $wp_query, $paged;
	$max_page = $wp_query->max_num_pages;
	if ( $max_page == 1 ) return;
	if ( emptyempty( $paged ) ) $paged = 1;
	echo '<span class="page-numbers">'.第 . $paged .页 .（共 . $max_page .页）. ' </span> ';
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> NO.1 </a>";}
	previous_posts_link(' « ');
	if($max_page > $range){
		if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
		elseif($paged >= ($max_page - ceil(($range/2)))){
			for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
			if($i==$paged)echo " class='current'";echo ">$i</a>";}}
			elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
				for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
				else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
				if($i==$paged)echo " class='current'";echo ">$i</a>";}}
				next_posts_link(' » ');
				if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> END </a>";}}
}
/* 访问计数 */
function record_visitors()
{
	if (is_singular())
	{
		global $post;
		$post_ID = $post->ID;
		if($post_ID)
		{
			$post_views = (int)get_post_meta($post_ID, 'views', true);
			if(!update_post_meta($post_ID, 'views', ($post_views+1)))
			{
				add_post_meta($post_ID, 'views', 1, true);
			}
		}
	}
}
add_action('wp_head', 'record_visitors');
/// 函数名称：post_views
/// 函数作用：取得文章的阅读次数
function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
	global $post;
	$post_ID = $post->ID;
	$views = (int)get_post_meta($post_ID, 'views', true);
	if ($echo) echo $before, number_format($views), $after;
	else return $views;
}
/// get_most_viewed_format
/// 函数作用：取得阅读最多的文章
function get_most_viewed_format($mode = '', $limit = 10, $show_date = 0, $term_id = 0, $beforetitle= '(', $aftertitle = ')', $beforedate= '(', $afterdate = ')', $beforecount= '(', $aftercount = ')') {
	global $wpdb, $post;
	$output = '';
	$mode = ($mode == '') ? 'post' : $mode;
	$type_sql = ($mode != 'both') ? "AND post_type='$mode'" : '';
	$term_sql = (is_array($term_id)) ? "AND $wpdb->term_taxonomy.term_id IN (" . join(',', $term_id) . ')' : ($term_id != 0 ? "AND $wpdb->term_taxonomy.term_id = $term_id" : '');
	$term_sql.= $term_id ? " AND $wpdb->term_taxonomy.taxonomy != 'link_category'" : '';
	$inr_join = $term_id ? "INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)" : '';
	// database query
	$most_viewed = $wpdb->get_results("SELECT ID, post_date, post_title, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) $inr_join WHERE post_status = 'publish' AND post_password = '' $term_sql $type_sql AND meta_key = 'views' GROUP BY ID ORDER BY views DESC LIMIT $limit");
	if ($most_viewed) {
		foreach ($most_viewed as $viewed) {
			$post_ID    = $viewed->ID;
			$post_views = number_format($viewed->views);
			$post_title = esc_attr($viewed->post_title);
			$get_permalink = esc_attr(get_permalink($post_ID));
			$output .= "<li>$beforetitle$post_title$aftertitle";
			if ($show_date) {
				$posted = date(get_option('date_format'), strtotime($viewed->post_date));
				$output .= "$beforedate $posted $afterdate";
			}
			$output .= "$beforecount $post_views $aftercount</li>";
		}
	} else {
		$output = "<li>N/A</li>n";
	}
	echo $output;
}
?>

