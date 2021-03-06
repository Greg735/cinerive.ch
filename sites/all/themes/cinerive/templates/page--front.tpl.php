<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728148
 */
?>


  <header class="header" role="banner"> 
    <div class="layout-center">

      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="header__logo">
        <img src="/<?php print path_to_theme(); ?>/img/logo.svg" alt="<?php print t('Home'); ?>" class="header__logo-image" />
      </a>

      <?php if ($site_name || $site_slogan): ?>
        <div class="header__name-and-slogan">
          <?php if ($site_name): ?>
            <h1 class="header__site-name">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" class="header__site-link" rel="home"><span><?php print $site_name; ?></span></a>
            </h1>
          <?php endif; ?>

          <?php if ($site_slogan): ?>
            <div class="header__site-slogan"><?php print $site_slogan; ?></div>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <?php if ($secondary_menu): ?>
        <nav class="header__secondary-menu" role="navigation">
          <?php print theme('links__system_secondary_menu', array(
            'links' => $secondary_menu,
            'attributes' => array(
              'class' => array('links', 'inline', 'clearfix'),
            ),
            'heading' => array(
              'text' => $secondary_menu_heading,
              'level' => 'h2',
              'class' => array('visually-hidden'),
            ),
          )); ?>
        </nav>
      <?php endif; ?>

      <?php print render($page['header']); ?>

      <a class="iframe mon-compte desktop" href="http://ticketonline.cinerive.com/ticketweb.php?UserCenterID=182&amp;sign=30&amp;callbackURL=<?php print 'http://'. $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" data-fancybox-type="iframe">Mon compte</a>
      <a class="iframe mon-compte mobile" href="http://ticketonline.cinerive.com/mobile/v2/index.php?UserCenterID=182&amp;sign=30&amp;callbackURL=<?php print 'http://'. $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" data-fancybox-type="iframe">Mon compte</a>

      
    </div>
  </header>

<div class="full-top">
  <div class="layout-center">
    <?php print render($page['content_left']); ?>
    <?php print render($page['content_right']); ?>
  </div>
</div>

  <?php      
    $top  = render($page['top_full']); 
    if ($top):
        print $top; 
    endif; 
  ?>

  
  <div class="layout-center">

  <div class="layout-3col layout-swap">

    <?php
      // Render the sidebars to see if there's anything in them.
      $sidebar_first  = render($page['sidebar_first']);
      $sidebar_second = render($page['sidebar_second']);
      // Decide on layout classes by checking if sidebars have content.
      $content_class = 'layout-3col__full';
      $sidebar_first_class = $sidebar_second_class = '';
      if ($sidebar_first && $sidebar_second):
        $content_class = 'layout-3col__right-content';
        $sidebar_first_class = 'layout-3col__first-left-sidebar';
        $sidebar_second_class = 'layout-3col__second-left-sidebar';
      elseif ($sidebar_second):
        $content_class = 'layout-3col__left-content';
        $sidebar_second_class = 'layout-3col__right-sidebar';
      elseif ($sidebar_first):
        $content_class = 'layout-3col__right-content';
        $sidebar_first_class = 'layout-3col__left-sidebar';
      endif;
    ?>

    <main class="<?php print $content_class; ?>" role="main">
      <?php print render($page['highlighted']); ?>
      <?php print $breadcrumb; ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>


      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </main>

    <div class="layout-swap__top layout-3col__full">

      <a href="#skip-link" class="visually-hidden visually-hidden--focusable" id="main-menu" tabindex="-1">Back to top</a>

      <?php print render($page['navigation']); ?>

    </div>

    <?php if ($sidebar_first): ?>
      <aside class="<?php print $sidebar_first_class; ?>" role="complementary">
        <?php print $sidebar_first; ?>
      </aside>
    <?php endif; ?>

    <?php if ($sidebar_second): ?>
      <aside class="<?php print $sidebar_second_class; ?>" role="complementary">
        <?php print $sidebar_second; ?>
      </aside>
    <?php endif; ?>

  </div>


</div>
  <?php      
    $bottom  = render($page['bottom_full']); 
    if ($bottom):
        print $bottom; 
    endif; 
  ?>

<?php include('footer.tpl.php'); ?>
