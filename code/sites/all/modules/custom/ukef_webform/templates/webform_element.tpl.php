<?php
/**
 * @file
 * Template for webform elements.
 *
 * @author
 * Adam Bushell <adam.bushell@readingroom.com>
 * Marek Maciusowicz <marek.maciusowicz@readingroom.com>
 */
?>
<?php if (isset($element['#wrapper_attributes'])): ?>
  <div <?php print drupal_attributes($element['#wrapper_attributes']); ?> >
<?php endif; ?>
  <?php switch ($element['#title_display']): ?><?php case 'inline': case 'before': case 'invisible': ?>
    <?php print $element['#label']; ?>
    <?php if (isset($element['#description'])): ?>
       <p class="form-hint"><?php print $element['#description']; ?></p>
    <?php endif; ?>
    <?php if (isset($element['#field_prefix'])): ?>
      <span class="field-prefix"><?php print webform_filter_xss($element['#field_prefix']); ?></span>
    <?php endif; ?>
      <?php print $element['#children']; ?>
    <?php if (isset($element['#field_suffix'])): ?>
      <span class="field-prefix"><?php print webform_filter_xss($element['#field_suffix']); ?></span>
    <?php endif; ?>
    <?php if (isset($element['#webform_component']['extra']) && isset($element['#webform_component']['extra']['guidance'])): ?>
      <div class="guidance"><?php print $element['#webform_component']['extra']['guidance']['value']; ?></div>
    <?php endif; ?>
    <?php break;

    case 'after': ?>
    <?php if (isset($element['#description'])): ?>
       <p class="form-hint"><?php print $element['#description']; ?></p>
    <?php endif; ?>
    <?php if (isset($element['#field_prefix'])): ?>
      <span class="field-prefix"><?php print webform_filter_xss($element['#field_prefix']); ?></span>
    <?php endif; ?>
    <?php print $element['#children']; ?>
    <?php if (isset($element['#field_suffix'])): ?>
      <span class="field-prefix"><?php print webform_filter_xss($element['#field_suffix']); ?></span>
    <?php endif; ?>
    <?php if (isset($element['#webform_component']['extra']) && isset($element['#webform_component']['extra']['guidance'])): ?>
      <div class="guidance"><?php print $element['#webform_component']['extra']['guidance']['value']; ?></div>
    <?php endif; ?>
    <?php print $element['#label']; ?>
  <?php break;

  case 'none': case 'attribute': ?>
    <?php if (isset($element['#description'])): ?>
       <p class="form-hint"><?php print $element['#description']; ?></p>
    <?php endif; ?>
    <?php if (isset($element['#field_prefix'])): ?>
      <span class="field-prefix"><?php print webform_filter_xss($element['#field_prefix']); ?></span>
    <?php endif; ?>
    <?php print $element['#children']; ?>
    <?php if (isset($element['#field_suffix'])): ?>
      <span class="field-prefix"><?php print webform_filter_xss($element['#field_suffix']); ?></span>
    <?php endif; ?>
    <?php if (isset($element['#webform_component']['extra']) && isset($element['#webform_component']['extra']['guidance'])): ?>
      <div class="guidance"><?php print $element['#webform_component']['extra']['guidance']['value']; ?></div>
    <?php endif; ?>
    <?php break; ?>
  <?php endswitch; ?>
</div>