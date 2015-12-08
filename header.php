<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon" />	
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by default ?>
	<script type="text/javascript">
	$({property: 0}).animate({property: 100}, {
        duration: 3000,
        step: function() {
            var percentage = Math.round(this.property);
            $('#progress').css('width',  percentage+"%");
             if(percentage == 100) {
                    $("#progress").addClass("done");//完成，隐藏进度条
                }
        }
     });
	</script>
	<?php wp_head(); ?>
</head>
<body>
<div id="wrapper">
<div id="progress">
            <span></span>
</div>
<div id="header">
     
    <div id="headerimg">
	<div class="logo"><a href="<?php bloginfo('siteurl');?>"><img  src="<?php bloginfo('template_directory'); ?>/images/logo.jpg" alt="主页" /><?php bloginfo('description');?> </a></div>
	</div>
	
</div>
     <div class="navmenu">
	     <?php wp_nav_menu('depth=2&title_li=0&sort_column=menu_order'); ?>
	 </div>























