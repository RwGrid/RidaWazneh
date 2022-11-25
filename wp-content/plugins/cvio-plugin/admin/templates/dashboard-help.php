<?php

/**
* Template for theme dashboard welcome page
*/
?>
<div class="cvio-dashboard-help">
  <div class="image-container">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_amiibtte.json"  background="transparent"  speed="1"  style="width: 100%; height: auto;"  loop  autoplay></lottie-player>
  </div>
  <div class="content-container">
    <h2><?php echo esc_html__( 'Help Center & Support', 'cvio-plugin' ); ?></h2>
    <p><?php echo sprintf( __( 'Here you can find some usefull links and information. Didn\'t find what you were looking for. Please check our <a href="%s" target="_blank">official website</a> and product page on <a href="%s" target="_blank">Envato Market</a>.', 'cvio-plugin' ),  'https://bslthemes.com/', 'https://1.envato.market/264zM' ); ?></p>
    <div class="cvio-dashboard-list">
      <ul>
        <li>
          <h4><span class="dashicons dashicons-admin-settings"></span> <?php echo esc_html__( 'Theme Settings', 'cvio-plugin' ); ?></h4>
          <p><?php echo esc_html__( 'Customize the appearance of your theme and configure global theme settings.', 'cvio-plugin' ); ?></p>
          <p><a href="<?php echo admin_url( 'admin.php?page=theme-options' ); ?>"><?php echo esc_html__( 'Go to Theme Settings', 'cvio-plugin' ); ?></a></p>
          <p>&nbsp;</p>
        </li>

        <li>
          <h4><span class="dashicons dashicons-book"></span> <?php echo esc_html__( 'Documentation', 'cvio-plugin' ); ?></h4>
          <p><?php echo esc_html__( 'Having questions? Learn our detailed instructions how to install and customize themes with fast video guides.', 'cvio-plugin' ); ?></p>
          <p><a href="https://bslthemes.gitbook.io/cvio-wp-doc/" target="_blank"><?php echo esc_html__( 'Go to Documentation', 'cvio-plugin' ); ?></a></p>
          <p>&nbsp;</p>
        </li>

        <li>
          <h4><span class="dashicons dashicons-sos"></span> <?php echo esc_html__( '24/7 Support', 'cvio-plugin' ); ?></h4>
          <p><?php echo esc_html__( 'Have some problems and need help? Don\'t worry, you can always submit a support ticket, and our team will help you resolve any issues.', 'cvio-plugin' ); ?></p>
          <p><a href="https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/cvio-cv-resume-wordpress-theme/25607381/support" target="_blank"><?php echo esc_html__( 'Submit a ticket', 'cvio-plugin' ); ?></a></p>
          <p>&nbsp;</p>
          <p>
            <i>Saved your time and you want to thank me? You can</i>
            <a href="https://www.buymeacoffee.com/bslthemes" target="_blank">
              <img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="vertical-align: middle;height: 41px !important;width: 174px !important;box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;-webkit-box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;" />
            </a>
            <img draggable="false" role="img" class="emoji" alt="" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f60a.svg" />
          </p>
        </li>
      </ul>
    </div>
  </div>
</div>
