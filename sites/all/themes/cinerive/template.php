<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function cinerive_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  cinerive_preprocess_html($variables, $hook);
  cinerive_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function cinerive_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  $variables['classes_array'] = array_diff($variables['classes_array'],
    array('class-to-remove')
  );
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function cinerive_preprocess_page(&$variables, $hook) {
  //$variables['sample_variable'] = t('Lorem ipsum.');
  if (isset($variables['node']->type)) {
        $nodetype = $variables['node']->type;
        $variables['theme_hook_suggestions'][] = 'page__' . $nodetype;
    }
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function cinerive_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--no-wrapper.tpl.php template for sidebars.
  if (strpos($variables['region'], 'sidebar_') === 0) {
    $variables['theme_hook_suggestions'] = array_diff(
      $variables['theme_hook_suggestions'], array('region__no_wrapper')
    );
  }
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function cinerive_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  if ($variables['block_html_id'] == 'block-system-main') {
    $variables['theme_hook_suggestions'] = array_diff(
      $variables['theme_hook_suggestions'], array('block__no_wrapper')
    );
  }
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function cinerive_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // cinerive_preprocess_node_page() or cinerive_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param array $variables
 *   Variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function cinerive_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

function cinerive_page_alter($page){
  $path = '/' . drupal_get_path('theme', 'cinerive');
  
  $apple = array(
    array(
      'rel' => 'apple-icon',
      'sizes' => '57x57',
      'href' => $path . '/img/icons/apple-icon-57x57.png',
    ),
    array(
      'rel' => 'apple-icon',
      'sizes' => '114x114',
      'href' => $path . '/img/icons/apple-icon-114x114.png',
    ),
    array(
      'rel' => 'apple-icon',
      'sizes' => '72x72',
      'href' => $path . '/img/icons/apple-icon-72x72.png',
    ),
    array(
      'rel' => 'apple-icon',
      'sizes' => '144x144',
      'href' => $path . '/img/icons/apple-icon-144x144.png',
    ),
    array(
      'rel' => 'apple-icon',
      'sizes' => '60x60',
      'href' => $path . '/img/icons/apple-icon-60x60.png',
    ),
    array(
      'rel' => 'apple-icon',
      'sizes' => '120x120',
      'href' => $path . '/img/icons/apple-icon-120x120.png',
    ),
    array(
      'rel' => 'apple-icon',
      'sizes' => '76x76',
      'href' => $path . '/img/icons/apple-icon-76x76.png',
    ),
    array(
      'rel' => 'apple-icon',
      'sizes' => '152x152',
      'href' => $path . '/img/icons/apple-icon-152x152.png',
    ),
    array(
      'rel' => 'apple-icon',
      'sizes' => '180x180',
      'href' => $path . '/img/icons/apple-icon-180x180.png',
    ),    
    array(
      'rel' => 'icon',
      'sizes' => '192x192',
      'type' => 'image/png',
      'href' => $path . '/img/icons/apple-icon.png',
    ),     
    array(
      'rel' => 'icon',
      'sizes' => '96x96',
      'type' => 'image/png',
      'href' => $path . '/img/icons/favicon-96x96.png',
    ), 
    array(
      'rel' => 'icon',
      'sizes' => '32x32',
      'type' => 'image/png',
      'href' => $path . '/img/icons/favicon-32x32.png',
    ),    
    array(
      'rel' => 'icon',
      'sizes' => '16x16',
      'type' => 'image/png',
      'href' => $path . '/img/icons/favicon-16x16.png',
    ),

    // etc.
  );
  foreach ($apple as $link) {
    drupal_add_html_head_link($link);
  }
}

