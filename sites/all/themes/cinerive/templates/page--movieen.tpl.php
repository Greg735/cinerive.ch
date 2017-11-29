<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728148
 */
//print_r($node);
//setlocale(LC_TIME, "fr_FR");

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

  <div class="region region-top-full">
    <div class="movie-header-img" style="background:url(/<?php print path_to_theme(); ?>/img/header-movie.jpg) no-repeat top center;"></div>
  </div>

  
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


      <div class="right">
        <div class="header-movie-txt">
          <?php
            $year = '';
            $length = '';
            $genre = '';
            $pdocutioncountry = '';

            if(isset($node->field_productionyear[LANGUAGE_NONE])):
             // $year = "(".date('Y', strtotime($node->field_productionyear[LANGUAGE_NONE][0]['value'])).")";
            endif;
            if(isset($node->field_length[LANGUAGE_NONE])):
              $length = $node->field_length[LANGUAGE_NONE][0]['value']."'";
            endif;
            if(isset($node->field_genre[LANGUAGE_NONE])):
              $genre = " | ".$node->field_genre[LANGUAGE_NONE][0]['value'];
              foreach ($node->field_genre[LANGUAGE_NONE] as $key => $value) {
                if($key == 0) continue;
                $genre .= ", ".$value['value'];
              }
            endif;
            if(isset($node->field_productioncountry[LANGUAGE_NONE])):
              $pdocutioncountry = " | ". $node->field_productioncountry[LANGUAGE_NONE][0]['value'];

            endif;
          ?>
          <h1><?php print $title .' '.$year ?></h1>
          <div class="movie-infos"><?php print $length.$genre.$pdocutioncountry ?></div>
        </div>

      <?php if(isset($node->field_director[LANGUAGE_NONE])): ?>
        <div class="field field-name-field-director field-type-text field-label-above">
          <h3>Director</h3>
          <div class="field-items">
            <div class="field-item even">
              <?php print $node->field_director[LANGUAGE_NONE][0]['safe_value'];  ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <?php if(isset($node->field_actors[LANGUAGE_NONE])): ?>
        <div class="field field-name-field-actors field-type-text field-label-above">
          <h3>Cast</h3>
          <div class="field-items">
            <div class="field-item even">
              <?php print $node->field_actors[LANGUAGE_NONE][0]['safe_value'];  ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
           
        <div class="field field-name-body field-type-text-with-summary field-label-hidden">
          <h2>Storyline</h2> 
          <div class="border"> </div>        
          <div class="field-items">
            <div class="field-item even" property="content:encoded">
              <?php 
              if(isset($node->body[LANGUAGE_NONE])):
                print $node->body[LANGUAGE_NONE][0]['safe_value']; 
              endif;              
              ?>
            </div>
          </div>

        </div>

        <?php if(isset($node->field_headline[LANGUAGE_NONE])): ?>
          <div class="field field-name-field-headline field-type-text field-label-above">
            <div class="field-items">
              <div class="field-item even">
                <?php print $node->field_headline[LANGUAGE_NONE][0]['safe_value'];  ?>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <?php if(isset($node->field_comments[LANGUAGE_NONE])): ?>
          <div class="field field-name-field-comments field-type-text field-label-above">
            <div class="field-items">
              <div class="field-item even">
                <span style="background-color:#a20028; color:#FFFFFF; padding:0.5em;">Attention!</span>
                <?php print $node->field_comments[LANGUAGE_NONE][0]['safe_value'];  ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
        
      </div>

      <div class="left">

        <div class="field field-name-field-img-url field-type-text field-label-above">

          <?php // check if trailer 
            if(isset($node->field_trailer_url[LANGUAGE_NONE])):
              //get url
              //$youtube = $node->field_trailer_url[LANGUAGE_NONE][0]['value'];
              //$youtube = 'http://www.youtube=123123-213';
              //$youtubesplit = explode("=", $youtube);
              $source = $node->field_trailer_url[LANGUAGE_NONE][0]['value'];
            endif;
          ?>

          <div class="field-items">
            <div class="field-item even">
              <?php if(isset($source)): ?>
             <!-- <a class="youtube cboxElement" href="http://www.youtube.com/embed/<?php // print $youtubesplit[1] ?>?rel=0&amp;wmode=transparent">
              -->
              <a class="youtube cboxElement" id="openColorbox">
              <div style='display:none'>
                <div id='inlinevideocontent' >
                  <?php 
                  if (strpos($source, '.mp4') !== false) {
                  ?>
                  <video id="video" controls="controls" src="<?php print $source ?>"> </video>

                  <?php }else if(strpos($source, 'youtube')!== false){ 
                    //get youtube code
                    $array = explode("/", $source);
                    $code = end($array);
                  ?>
                  <iframe frameborder="0" allowfullscreen="" mozallowfullscreen="" webkitallowfullscreen="" src="https://www.youtube.com/embed/<?php print $code ?>"></iframe>
                  
                  <?php }else if(strpos($source, 'vimeo')!== false){ 
                  	if(strpos($source, 'https://vimeo.com/')!== false){
                  		$source = str_replace('https://vimeo.com/', 'https://player.vimeo.com/video/', $source);
                  	}
                  	?>
                  <iframe frameborder="0" allowfullscreen="" mozallowfullscreen="" webkitallowfullscreen="" src="<?php print $source ?>"></iframe>

                    ?>

                  <?php } ?>
                  <!-- <source src="<?php print $source ?>" type="video/mp4">-->

                  <!--  <object width="720" height="405" type="application/x-shockwave-flash" data="/sites/all/themes/cinerive/flash/flash-video/VideoMediaElement.as">
                      <param name="movie" value="/sites/all/themes/cinerive/flash/flash-video/VideoMediaElement.as" />
                      <param name="flashvars" value="controls=true&amp;file=<?php print $source ?>" />
                    </object>-->
                </div>
              </div>

              <?php endif; ?>
              
              <?php //if(isset($node->field_poster[LANGUAGE_NONE])): 
              if(isset($node->field_ext_id)):

                /* AMA $file = file_load($node->field_poster[LANGUAGE_NONE][0]['fid']);
                $image = image_load($file->uri);             
                
                $content = array(
                  'file' => array(
                    '#theme' => 'image_style',
                    '#style_name' => 'poster',
                    '#path' => $image->source,
                    '#width' => $image->info['width'],
                    '#height' => $image->info['height'],
                  ),
                ); AMA*/
                
                //$field_collection = field_collection_field_get_entity($item); 
                //print_r($field_collection);
                //$image = image_load(file_load($field_collection->field_slider_images['und'][0]['fid'])->uri);
                $file = str_replace("EventsEN", "Events", $node->field_ext_id[LANGUAGE_NONE][0]['value']). ".jpg";
                //$image = image_load($file);
                $content = array(
                  'file' => array(
                    '#theme' => 'image_style',
                    '#style_name' => 'dolphin_detail',
                    '#path' => $file,
                    '#width' => 322,
                    '#height' => 500,
                  ),
                );
                print $image = drupal_render($content); 

                else: ?>
                <img src="/<?php print path_to_theme(); ?>/img/movie_default.jpg" />
              <?php endif; ?>
              <?php if(isset($source)): ?>
              </a>
            <?php endif; ?>
            </div>
          </div>
        </div>



      <?php if(isset($node->field_ratingshortcut[LANGUAGE_NONE])): ?>
        <div class="field field-name-field-rating field-type-text field-label-above">
          <div class="field-items">
            <div class="field-item even">Rating: 
              <?php print $node->field_ratingshortcut[LANGUAGE_NONE][0]['safe_value'];  ?>
            </div>
          </div>
        </div>
      <?php endif; ?>




      </div>

      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </main>

    <!-- <div class="layout-swap__top layout-3col__full">

      <a href="#skip-link" class="visually-hidden visually-hidden--focusable" id="main-menu" tabindex="-1">Back to top</a>

      <?php print render($page['navigation']); ?>

    </div>---->

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