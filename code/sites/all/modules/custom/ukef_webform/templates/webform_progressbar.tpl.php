<?php
/**
 * @file
 * Display the progress bar for multipage forms
 *
 * Available variables:
 * - $node: The webform node.
 * - $progressbar_page_number: TRUE if the actual page number should be
 *   displayed.
 * - $progressbar_percent: TRUE if the percentage complete should be displayed.
 * - $progressbar_bar: TRUE if the bar should be displayed.
 * - $progressbar_pagebreak_labels: TRUE if the page break labels shoud be
 *   displayed.
 * - $page_num: The current page number.
 * - $page_count: The total number of pages in this form.
 * - $page_labels: The labels for the pages. This typically includes a label for
 *   the starting page (index 0), each page in the form based on page break
 *   labels, and then the confirmation page (index number of pages + 1).
 * - $percent: The percentage complete.
 */
?>
<div class="webform-progressbar proposal-submission">   
    
    <aside>
        <div class="inner">
            <nav role="navigation" class="grid-row page-navigation page-navigation-closed" aria-label="parts to this guide">
              
                <?php 
                  $set1end = floor($page_count/2) + 1;
                ?>
                <!-- If items are in first half of pages -->
                <ol class="column-half">
                    <?php for ($n = 1; $n <  $set1end ; $n++): ?>
                        <?php if ($n == $page_num): ?>
                            <li class="active <?php print $steps[$n - 1]['class']; ?>">
                                <div class="active-block">
                                    <span class="active-text step">
                                        <span class="progress-number"><?php print $n; ?></span><span class="active-text-name step-name"><?php print check_plain($page_labels[$n - 1]); ?></span>
                                    </span>
                                </div>
                            </li>
                        <?php else: ?>
                            <li class="<?php print $steps[$n - 1]['class']; ?>">
                                <div>
                                    <button class="step button-link button-no-underline" name="op" type="submit" formnovalidate="formnovalidate" value="<?php print $n; ?>. <?php print check_plain($page_labels[$n - 1]); ?>">
                                        <span class="progress-number"><?php print $n; ?></span>
                                        <span class="step-name">
                                            <?php print check_plain($page_labels[$n - 1]); ?>
                                        </span>
                                    </button>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>
                </ol>
                <!-- second half of pages-->
                <ol class="column-half" start="<?php echo $set1end ?>">
                    <?php for ($n =  $set1end ; $n <= $page_count; $n++): ?>
                        <?php if ($n == $page_num): ?>
                            <li class="active <?php print $steps[$n - 1]['class']; ?>">
                                <div class="active-block ">
                                    <span class="active-text step">
                                        <span class="progress-number"><?php print $n; ?></span><span class="active-text-name step-name"><?php print check_plain($page_labels[$n - 1]); ?></span>
                                    </span>
                                </div>
                            </li>
                        <?php else: ?>
                            <li class="<?php print $steps[$n - 1]['class']; ?>">
                                <div>
                                    <button class="step button-link button-no-underline" name="op" type="submit" formnovalidate="formnovalidate" value="<?php print $n; ?>. <?php print check_plain($page_labels[$n - 1]); ?>">
                                        <span class="progress-number"><?php print $n; ?></span>
                                        <span class="step-name">
                                            <?php print check_plain($page_labels[$n - 1]); ?>
                                        </span>
                                    </button>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>
                </ol>
            </nav>
        </div>
    </aside>
    <h2 class="heading-medium">
        <?php print $page_num . ". " . $page_labels[$page_num-1]; ?>
    </h2>
    <p>
        Step <?php print $page_num; ?> of <?php print $page_count; ?>
    </p>
</div>
