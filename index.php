<!DOCTYPE html>
<html lang="en">
<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php wp_title(''); ?></title>

<link rel="stylesheet" media="screen" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/style.css" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php bloginfo('template_directory'); ?>/style.css" />
<?php if (get_field('favicon', 'option')) { echo '<link rel="shortcut icon" href="'.get_field('favicon', 'option').'" />'; } ?>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script type="text/javascript">
	var siteurl = '<?php echo bloginfo('url'); ?>', 
	templatedir = '<?php echo bloginfo('template_directory'); ?>', 
	ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>

<?php wp_enqueue_script('theme', get_bloginfo('template_directory').'/js/min/site.js', array('jquery'), '1.0', true ); ?>

<?php wp_head(); ?>

</head>

<body <?php echo body_class(); ?>>

<div id="header" class="container">
	<div class="row">
		<div class="logo-panel col-lg-6">
			<img src="<?php echo bloginfo('template_directory'); ?>/img/logo.png" id="logo" alt="Logo">
		</div>
		<div class="text-panel col-lg-6">
			<div class="tag-line">
				<h1>Hello!</h1>
				<p>We are Tiny Press, a micropublisher of literary postcards.</p>
				<p>We select excepts of South African writing and then commission local artists to illustrate the text.</p>
				<p>We publish a new postcard every month.</p>
			</div>
		</div>
	</div>
</div>


<?php wp_footer(); ?>

<?php if (get_field('analytics', 'option')) { echo get_field('analytics', 'option'); } ?>

</body>
</html>
