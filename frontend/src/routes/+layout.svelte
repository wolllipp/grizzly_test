<script>
  import Header from "$lib/components/Header.svelte";
  import Footer from "$lib/components/Footer.svelte";
  let { children } = $props();
</script>

<div class="page-wrapper">
  <Header />
  <main class="page-main">
    {@render children()}
  </main>
  <Footer />
</div>

<style>
  :root {
    /* Шрифты */
    --font-primary: 'Averta CY', Arial, sans-serif;
    --font-nav: 'Work Sans', sans-serif;
    --font-bold: 'Averta CY W01 Bold', Arial, sans-serif;

    /* Цвета */
    --color-text: #2e2e2e;
    --color-white: #ffffff;
    --color-purple: #78599c;
    --color-purple-hover: #6f39ae;
    --color-error: #ff4d4f;
    --color-border: #ffffff99;
    --color-border-hover: #ffffff;
    --color-form-bg: #343434cc;
    --color-placeholder: #ffffff;
    --color-gray: #333333;
    --color-gray-light: #BCBCBC;
    --color-gray-border: #E8E8E8;

    /* Размеры */
    --font-size-sm: 13px;
    --font-size-base: 16px;
    --font-size-lg: 32px;
    --font-size-xl: 40px;
    --input-height: 32px;
    --border-radius: 4px;
  }

  :global(html, body) {
    height: 100%;
    margin: 0;
  }

  :global(*:focus-visible) {
    outline: 2px solid var(--color-purple);
    outline-offset: 2px;
  }

  .page-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  .page-main {
    flex: 1 0 auto;
  }

  @font-face {
    font-family: 'Averta CY W01 Bold';
    src: url('https://db.onlinewebfonts.com/t/ace51fb0e489a977bed8a67511865c11.woff2') format('woff2');
    font-weight: 700;
    font-style: normal;
  }

  @font-face {
    font-family: 'Averta CY';
    src: url('/fonts/Averta-Semibold.woff2') format('woff2');
    font-weight: 600;
    font-style: normal;
  }

  @font-face {
    font-family: 'Averta CY';
    src: url('/fonts/CY_Regular.woff2') format('woff2');
    font-weight: 400;
    font-style: normal;
  }
</style>
