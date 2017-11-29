<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
//print_r($row);
$node = node_load($row->node_field_data_field_film_nid);
//print_r($node);

if(isset($node->title)): 
?>
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
      <a href="#inline<?php print $node->nid ?>" class="fancybox" >
      <?php endif; ?>
      
      <?php /* AMAif(isset($node->field_poster[LANGUAGE_NONE])):
       
        //$field_collection = field_collection_field_get_entity($item); 
        //print_r($field_collection);
        //$image = image_load(file_load($field_collection->field_slider_images['und'][0]['fid'])->uri);
        
        $file = file_load($node->field_poster[LANGUAGE_NONE][0]['fid']);
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
        if(isset($node->field_ext_id[LANGUAGE_NONE])):
        $file = $node->field_ext_id[LANGUAGE_NONE][0]['value'] . ".jpg";
                //$image = image_load($file);
                $content = array(
                  'file' => array(
                    '#theme' => 'image_style',
                    '#style_name' => 'dolphin_detail',
                    '#path' => $file,
                    '#width' => 363,
                    '#height' => 540,
                  ),
                );
        print $image = drupal_render($content); 

        else: ?>
        <img src="/<?php print path_to_theme(); ?>/img/movie_default.jpg" />
      <?php endif; ?>
      <?php if(isset($source)): ?>
      </a>
      <div style="display:none">
        <div id="inline<?php print $node->nid ?>" class="fancycontent modal2">
	        <div class="video"><?php print $source ?></div>
        </div>
      </div>
    <?php endif; ?>
    </div>
  </div>
</div>
<h2><?php print $node->title ?></h2>
<?php endif; ?>
