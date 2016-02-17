<?php
/**
 * @file
 * User Password.
 */
?>

<h1>Password reset</h1>
<div class="grid-row">
  <div class="column-two-thirds">
    <p>Enter your email address for a new password.</p>
    <?php
    print drupal_render_children($form);
    ?>
    <a href="/user/register">Register for an account</a>
  </div>
</div>