<?php

/**
 * @file
 * Customize the display of a complete webform.
 *
 * This file may be renamed "webform-form-[nid].tpl.php" to target a specific
 * webform on your site. Or you can leave it "webform-form.tpl.php" to affect
 * all webforms on your site.
 *
 * Available variables:
 * - $form: The complete form array.
 * - $nid: The node ID of the Webform.
 *
 * The $form array contains two main pieces:
 * - $form['submitted']: The main content of the user-created form.
 * - $form['details']: Internal information stored by Webform.
 *
 * If a preview is enabled, these keys will be available on the preview page:
 * - $form['preview_message']: The preview message renderable.
 * - $form['preview']: A renderable representing the entire submission preview.
 */
?>
<?php if (isset($form['preview_message'])): ?>
  <div class="messages warning">
    <?php print drupal_render($form['preview_message']); ?>
  </div>
<?php endif; ?>
<?php if (isset($form['#current_page_errors']) && count($form['#current_page_errors'])): ?>
  <div class="messages error">
    <h2>Your submission contains the following errors:</h2>
    <ul class="list">
      <?php foreach ($form['#current_page_errors'] as $step_key => $step_errors): ?>
        <!-- heading for a given section goes here -->
        <?php foreach ($step_errors as $error): ?>
          <li>
            <?php if ($form['preview']): ?>
              <?php print $error['message']; ?>
            <?php else: ?>
              <a href="#webform_element_wrapper_<?php print $error['form_key']; ?>"><?php print $error['message']; ?></a>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>
<?php print drupal_render($form['progressbar']); ?>
<?php print drupal_render($form['form_build_id']); ?>
<?php print drupal_render($form['form_token']); ?>
<?php print drupal_render($form['form_id']); ?>
<?php print drupal_render($form['submitted']); ?>
<?php if (isset($form['preview'])): ?>
  <?php print drupal_render($form['preview']); ?>
<?php endif; ?>
<?php print drupal_render($form['actions']);
