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
  :global(html, body) {
    height: 100%;
    margin: 0;
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
