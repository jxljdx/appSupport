<?php
/**
 * Title: FAQ section
 * Slug: bluemorrow/faq
 * Categories: batchora
 * Description: Visible FAQ content compatible with FAQ structured data.
 */
?>
<!-- wp:group {"align":"wide","className":"batchora-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide batchora-section">
  <!-- wp:heading -->
  <h2 class="wp-block-heading">Frequently asked questions</h2>
  <!-- /wp:heading -->
  <!-- wp:html -->
  <div class="batchora-faq">
    <details>
      <summary>Does Batchora upload photos or videos?</summary>
      <p>No. Media processing happens on your device. Batchora does not upload your selected media to its own servers.</p>
    </details>
    <details>
      <summary>Will Batchora replace my originals?</summary>
      <p>No. Batchora saves successful copies first. Originals only change if you explicitly request deletion and confirm Apple’s separate Photos prompt.</p>
    </details>
    <details>
      <summary>Which formats can Batchora create?</summary>
      <p>Photo output supports HEIC, JPEG, and PNG. Compressed video output uses compatible H.264 MP4.</p>
    </details>
  </div>
  <!-- /wp:html -->
</div>
<!-- /wp:group -->
