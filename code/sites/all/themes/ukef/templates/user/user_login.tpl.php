<?php
/**
 * @file
 * User Login.
 */
?>

<h1>Sign in</h1>
<div class="grid-row">
  <div class="column-two-thirds">
<?php
print drupal_render_children($form);
?>
<p><a href="/user/password">Forgot your password?</a></p>
<p><a href="/user/register">Register for an account</a></p>
  </div>
</div>