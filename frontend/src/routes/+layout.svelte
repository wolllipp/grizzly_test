<script>
	import Header from "$lib/components/Header.svelte";
	import Footer from "$lib/components/Footer.svelte";
	let { children } = $props();
</script>

<Header />

<main>
	{@render children()}
</main>

<Footer />

<style>

	:global(body) {
		margin: 0;
	}

	@font-face {
		font-family: 'Averta CY W01 Bold';
		src: url('https://db.onlinewebfonts.com/t/ace51fb0e489a977bed8a67511865c11.woff2')
			format('woff2');
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
