<footer>
  <div class="row footer-content">
    <div class="footer-section">
      <div class="footer-logo">
        <img
          src="https://www.officialgazette.gov.ph/wp-content/themes/govph/assets/images/footlogo.png"
          alt="Government Logo" />
      </div>
      <div class="footer-text">
        <h4>Republic of the Philippines</h4>
        <p>All content is in the public domain unless otherwise stated.</p>
        <ul>
          <li><a href="feedback-survey.php">Feedback Form</a></li>
          <li>
            <a href="https://www.officialgazette.gov.ph/privacy-policy/">Privacy Policy</a>
          </li>
          <li>
            <a href="<?= isset($_SESSION['is_logged_in']) ? "../frequently-asked-questions.php" : "frequently-asked-questions.php" ?>">Frequently Asked Questions</a>
          </li>
        </ul>
        <p>
          Contact numbers/Trunk lines: 8733-36-30 | 8734-56-11 Local 401
        </p>
      </div>
    </div>

    <div class="footer-section">
      <h4>About GOVPH</h4>
      <p>
        Learn more about the Philippine government, its structure, how
        government works, and the people behind it.
      </p>
      <ul>
        <li><a href="https://www.gov.ph/">GOV.PH</a></li>
        <li>
          <a href="https://www.officialgazette.gov.ph/">Official Gazette</a>
        </li>
        <li><a href="https://data.gov.ph/">Open Data Portal</a></li>
      </ul>
    </div>

    <div class="footer-section">
      <h4>Government Links</h4>
      <ul>
        <li><a href="http://president.gov.ph/">The President</a></li>
        <li>
          <a href="http://op-proper.gov.ph/">Office of the President</a>
        </li>
        <li>
          <a href="https://ovp.gov.ph/">Office of the Vice President</a>
        </li>
        <li>
          <a href="http://senate.gov.ph/">Senate of the Philippines</a>
        </li>
        <li>
          <a href="http://www.congress.gov.ph/">House of Representatives</a>
        </li>
        <li><a href="http://sc.judiciary.gov.ph/">Supreme Court</a></li>
        <li><a href="http://ca.judiciary.gov.ph/">Court of Appeals</a></li>
        <li><a href="http://sb.judiciary.gov.ph/">Sandiganbayan</a></li>
        <li><a href="/brgy_tx_prot/views/helpdesk/index.php">Brgy Employee Portal</a></li>
      </ul>
    </div>
  </div>

  <div class="row">
    <div class="small-12 columns">
      <p class="text-center attribution">
        <span class="mobile-block">Managed by ICT Division of the </span><a
          href="https://pco.gov.ph"
          target="_blank"
          rel="noopener noreferrer">Presidential Communications Office (PCO)</a>
      </p>
    </div>
  </div>
</footer>