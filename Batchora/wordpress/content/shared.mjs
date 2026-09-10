const escapeHtml = (value) =>
  value
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;");

export const answer = (text) => `<!-- wp:paragraph {"className":"batchora-answer"} -->
<p class="batchora-answer">${text}</p>
<!-- /wp:paragraph -->`;

export const heading = (text, level = 2) => `<!-- wp:heading {"level":${level}} -->
<h${level} class="wp-block-heading">${text}</h${level}>
<!-- /wp:heading -->`;

export const paragraph = (text) => `<!-- wp:paragraph -->
<p>${text}</p>
<!-- /wp:paragraph -->`;

export const bullets = (items) => `<!-- wp:list -->
<ul class="wp-block-list">${items
  .map((item) => `<li>${item}</li>`)
  .join("")}</ul>
<!-- /wp:list -->`;

export const steps = (items) => `<!-- wp:list {"ordered":true} -->
<ol class="wp-block-list">${items
  .map((item) => `<li>${item}</li>`)
  .join("")}</ol>
<!-- /wp:list -->`;

export const section = (title, ...blocks) => `<!-- wp:group {"className":"batchora-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group batchora-section">
${heading(title)}
${blocks.join("\n")}
</div>
<!-- /wp:group -->`;

export const faq = (questions) => `<!-- wp:html -->
<div class="batchora-faq">
${questions
  .map(
    ({ question, response }) => `<details>
  <summary>${escapeHtml(question)}</summary>
  <p>${response}</p>
</details>`
  )
  .join("\n")}
</div>
<!-- /wp:html -->`;

export const cta = (title, text) => `<!-- wp:group {"align":"wide","className":"batchora-cta","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide batchora-cta">
${heading(title)}
${paragraph(text)}
<!-- wp:batchora/app-store-cta /-->
</div>
<!-- /wp:group -->`;

export const pageContent = (summary, ...sections) =>
  [answer(summary), ...sections].join("\n");
