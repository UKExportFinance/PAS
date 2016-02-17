<?php
/**
 * @file
 * Template for Standard content page.
 */
?>
<div class="grid-row">
  <!--<div class="clear column-two-thirds"> original - commented out CFH to show full width-->
  <div class="clear column-two-thirds">
    <h1>
      <?php print $node->variables['title']; ?>
    </h1>
    <?php if ($node->variables['intro_section']): ?>
      <section>
        <?php print $node->variables['intro_section']; ?>
      </section>
    <?php endif; ?>
    <?php if ($node->variables['upper_body_section_heading']
    && $node->variables['upper_body_section']): ?>
      <section>
        <?php if ($node->variables['upper_body_section_heading']): ?>
        <h2>
          <?php print $node->variables['upper_body_section_heading']; ?>
        </h2>
        <?php endif; ?>
        <?php if ($node->variables['upper_body_section']): ?>
          <?php print $node->variables['upper_body_section']; ?>
        <?php endif; ?>
      </section>
    <?php endif; ?>
    <?php if ($node->variables['call_to_action_button_text']
    && $node->variables['call_to_action_button_link']): ?>
      <a class="button button-primary" href="/<?php print $node->variables['call_to_action_button_link']; ?>"><?php print $node->variables['call_to_action_button_text']; ?></a>
    <?php endif; ?>
    <?php if ($node->variables['lower_body_section_heading']
    && $node->variables['lower_body_section']): ?>
      <setion>
        <?php if ($node->variables['lower_body_section_heading']): ?>
        <h2>
          <?php print $node->variables['lower_body_section_heading']; ?>
        </h2>
        <?php endif; ?>
        <?php if ($node->variables['lower_body_section']): ?>
          <?php print $node->variables['lower_body_section']; ?>
        <?php endif; ?>
      </section>
    <?php endif; ?>
    <?php if ($node->variables['extra_components']['components']['applications']): ?>
        <h2 class="applications-header">Draft applications</h2>
        <div class="dashboard-applications dashboard-modules">
            <?php foreach ($node->variables['extra_components']['components']['applications']['draft'] as $application): ?>
            <div class="application module">
                <h3 class="heading-small title"><?php print $application['title']; ?></h3>
                <div class="grid-row">
                    <div class="column-two-thirds">
                        Author: <span class="bold"><?php print $application['author']['full_name']; ?></span>
                    </div>
                    <div class="column-third">
                        ID: <b><?php print $application['id']; ?></b>
                    </div>
                </div>
                <a class="button button-start" href="/<?php print $application['link']; ?>">Continue</a>
            </div>

            <?php endforeach; ?>
        </div>
      
      <div>
        <h2 class="applications-header">Submitted applications</h2>
        <div class="dashboard-modules">
          <?php foreach ($node->variables['extra_components']['components']['applications']['completed'] as $application): ?>
            <div class="application module">
              <h3 class="heading-small title"><?php print $application['title']; ?></h3>
              <div class="grid-row">
                <div class="column-two-thirds">
                </div>
                <div class="column-third">
                  <span>ID: </span>
                  <b><?php print $application['id']; ?></b>
                </div>
              </div>
              <a class="button button-start" disabled="disabled">View</a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
    <?php if ($node->variables['extra_components']['components']['products']): ?>
      <?php print $node->variables['extra_components']['components']['products']['markup']; ?>
    <?php endif; ?>
  </div>
</div>