<?php
/**
 * @file
 * Theme functionality.
 *
 * @author
 * Marek Maciusowicz <marek.maciusowicz@readingroom.com>
 */

/**
 * Implements hook_theme().
 */
function ukef_theme() {
  $items = array();
  $items['user_login'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'ukef') . '/templates/user',
    'template' => 'user_login',
  );
  $items['user_register_form'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'ukef') . '/templates/user',
    'template' => 'user_register_form',
    'preprocess functions' => array(
      'mod_cde_preprocess_user_register_form',
    ),
  );
  $items['user_pass'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'ukef') . '/templates/user',
    'template' => 'user_reset_password',
  );
  return $items;
}

/**
 * Implements hook_preprocess_page().
 */
function ukef_preprocess_page(&$variables) {
  $variables['header_html'] = render($variables['page']['header']);
  $variables['content_html'] = render($variables['page']['content']);
  $variables['footer_html'] = render($variables['page']['footer']);
}