<?php

/**
* Template for theme dashboard activation page
*/
?>

<div class="image-container">
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_amiibtte.json"  background="transparent"  speed="1"  style="width: 100%; height: auto;"  loop  autoplay></lottie-player>
</div>
<div class="content-container">
  <?php do_action( 'cvio_theme_dashboard_activation_form' ); ?>
</div>
