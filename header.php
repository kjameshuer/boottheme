<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset') ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header class="site-header">
    <div class="container-fluid">
      <div class="top-bar">
        <div class="top-bar__mobile">
          <span class=""><i class="fa fa-search" aria-hidden="true"></i></span>
          <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="top-bar__desktop">
          <?php
          $topbarArgs = array(
            'theme_location' => 'topbar-menu',
            'container' => 'ul',
            'menu_class' => 'nav'
          );
          wp_nav_menu($topbarArgs);
          ?>
        </div>
      </div>
      <div class="main-menu">
        <div class="container main-menu__menu-holder">
          <div class="main-menu__site-info">
            <h1 class=""><a href="<?php echo site_url() ?>"><strong><?php echo bloginfo('name'); ?></a></strong></h1>
          </div>
          <div class="main-menu__menu">
            <nav class="main-navigation">
              <?php
              $navArgs = array(
                'theme_location' => 'header-menu',
                'container' => 'ul',
                'menu_class' => 'nav'
              );
              wp_nav_menu($navArgs);
              ?>
            </nav>
          </div>
          <div id="main-menu__search"><input type="text" placeholder="search" id="header-search"></div>
        </div> <!-- .container -->
      </div><!-- .main-menu  -->
    </div>
  </header>
  <!-- .main-menu-search-trigger -->