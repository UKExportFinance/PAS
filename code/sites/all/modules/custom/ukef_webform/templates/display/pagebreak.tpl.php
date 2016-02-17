<?php
/**
 * @file
 * Page break display template.
 *
 * @author
 * Marek Maciusowicz <marek.maciusowicz@readingroom.com>
 */
?>
<details role="group" class="webform-page-wrapper">
	<summary class="webform-page" role="button" aria-expanded="false" aria-controls="details-content-<?php print $element['#webform_component']['page_num']; ?>">
		<span class="summary">
			<?php print $element['#title']; ?>
		</span>
	</summary>


