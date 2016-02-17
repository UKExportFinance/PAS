<div id="global-cookie-message">
  <p>GOV.UK uses cookies to make the site simpler. <a href="https://www.gov.uk/help/cookies">Find out more about cookies</a></p>
</div>
<!--end global-cookie-message-->

<header role="banner" id="global-header">
  <div class="header-wrapper">
    <div class="header-global">
      <div class="header-logo">
        <a href="https://www.gov.uk/" title="Go to the GOV.UK homepage" id="logo" class="content">
          <img src="sites/all/themes/ukef/assets/img/gov.uk_logotype_crown_invert.png" width="35" height="31" alt="">GOV.UK
        </a>
      </div>
      <div class="header-proposition">
        <div class="content">
          <a href="/" id="proposition-name">Submit an application to UK Export Finance</a>
        </div>
      </div>
    </div> 
  </div>
</header>
<!--end header-->

<div id="global-header-bar">
</div>
<div class="container">
  <div class="phase-banner-alpha">
      <p>
        <strong class="phase-tag">ALPHA</strong>
        <span>This is a new service – your <a href="#">feedback</a> will help us to improve it.</span>
      </p>
  </div>
</div>
<div class="container">
  <div class="grid-row">
    <div class="logo column-two-thirds ">
      <span class="organisation-logo organisation-logo-stacked-single-identity organisation-logo-stacked-single-identity-large">
      <span>UK Export <br>Finance</span>
    </div>
    <?php if ($bean->variables['user_details']['logged_in']): ?>
      <div class="column-third">
        <div class="user_container">
          <p class="heading-medium user_name">Signed in as <?php print $bean->variables['user_details']['full_name']; ?></p>
          <ul class="list">
              <li>
                  <a href="/">Dashboard</a>
              </li>
              <li>
                  <a href="#">Account settings</a>
              </li>
              <li>
                  <a href="/user/logout">Logout</a>
              </li>
          </ul>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
<!--end global-header-bar-->