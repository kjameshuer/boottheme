<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset') ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
    <div class="container">
      <h1 class=""><a href="<?php echo site_url() ?>"><strong><?php echo bloginfo('name'); ?></a></strong></h1>
      <span class=""><i class="fa fa-search" aria-hidden="true"></i></span>
      <i class="fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation"> 
          <?php 
            $navArgs = array(
              'theme_location' => 'header-menu'
            );
            wp_nav_menu($navArgs);
          ?>
        </nav>
        <div class="site-header__util">
          <a href="#" class="btn">Login</a>
          <a href="#" class="btn">Sign Up</a>
          <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
      </div>
    </div>
  </header>
