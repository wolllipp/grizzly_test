<footer class="site-footer">
	<div class="footer-content">
		<div class="footer-column">
			<img class='nemer-logo' src= "/logos/logo.svg" alt="Nemer">
			<div class="first-column-info">
				<div class="footer-contact">
					<div class="phone">
						<img class='phone_img' src="/logos/phone_icon.svg" alt="phone_logo">
						<p>+48690590089</p>
					</div>
					<div class="phone-link">
						<a href="#form">Zamów rozmowę</a>
					</div>
				</div>
				<div class="mail">
					<img class='mail_img' src="/logos/mail_icon.svg" alt="Mail_logo">
					<p>info@enemer.pl</p>
				</div>
				<div class="map">
					<img class='map_img' src="/logos/map_logo.svg" alt="Map_logo">
					<p>Błonie, Pass 20I, budynek 15, 05-870</p>
				</div>
			</div>
		</div>
		<div class="footer-column">
			<div class="second-column">
				<div class="second-column-header">
					<h2>Usługi</h2>
				</div>
				<div class='second-column-info'>
					<p>Usługi logistyczne dla e-commerce</p>
					<p>Outsourcing magazynu</p>
					<p>Outsourcing logistyczny</p>
					<p>Obsługa logistyczna sklepów internetowych</p>
					<p>Logistyka kontraktowa</p>
				</div>
				<div class="second-column-footer">
					<p>Zobacz wszystkie</p>
					<img src="/logos/strelka.svg" alt="Strelka">
				</div>
			</div>
		</div>
		<div class="footer-column">
			<div class="third-column">
				<h3>O nas</h3>
				<h3>Cennik</h3>
				<h3>Pytania i odpowiedzi</h3>
				<h3>Kontakt</h3>
				<h3>Blog</h3>
			</div>
		</div>
		<div class="footer-column">
			<div class="forfth-column">
				<p>Space Logistics Sp.z.o.o. 02-727</p>
				<p>Warszawa ul. Wołodyjowskiego 67A</p>
				<p>KRS: 0000824771 NIP: 5213888029</p>
				<p>REGON: 385377605</p>
			</div>
		</div>
	</div>
	<div class="footer-ending">
		<div class="footer-ending-info">
			<div class='footer-ending-header'>
				<p>Polityka prywatności</p>
			</div>
			<div class="site-footer-info">
				<p class="site-footer-info-text" >dev.grizzly.by</p>
				<img src="/logos/grizzly_logo.svg" alt="grizzly_logo">
				<p class="site-footer-info-text">seo.grizzly.by</p>
			</div>
		</div>
	</div>
</footer>

<style>
	.footer-content{
		display: flex;
		gap: 48px;
		padding-top: 60px;
		padding-bottom: 56px;
		padding-left: 340px;
		padding-right: 340px;
	}

	.nemer-logo{
		width: 221px;
		height: 50px;
		padding-bottom: 60px;
	}

	.first-column-info{
		display:grid;
		gap: 24px;
		width: 267px;
	}

	.phone {
		display: flex;
		align-items: center;
		gap:16px
	}

	.phone_img{
		width: 19px;
		height: 19px;
	}

	.phone p {
		margin: 0;
		font-family: var(--font-primary);
		font-size: 16px;
		color: var(--color-text);
		line-height: 120%;
	}
	.phone p{
		margin: 0;
	}
	
	.footer-contact{
		display: grid;
		gap:16px;
	}

	.phone-link {
		margin: 0;
		font-family: var(--font-primary);
		font-size: 16px;
		color: var(--color-purple);
		line-height: 180%;
		height: 24px;
	}

	.phone-link a {
		color: inherit;
		text-decoration: underline;
		transition: color 0.2s ease;
	}

	.phone-link a:hover {
		color: var(--color-text);
	}

	.mail{
		display: grid;
		grid-template-columns: 24px 1fr;
		align-items: center;
		gap: 12px;
		height: 24px;
		width: 100%;
	}

	.mail p {
		margin: 0;
		font-family: var(--font-primary);
		font-size: 16px;
		color: var(--color-text);
		line-height: 170%;
	}

	.map{
		display: grid;
		grid-template-columns: 24px 1fr;
		gap:12px;
	}
	
	.map p{
		margin: 0;
		font-family: var(--font-primary);
		font-size: 16px;
		color: var(--color-text);
		line-height: 1.5;
	}

	.second-column{
		width: 282px;
		height: 296px;
	}

	.second-column-header h2{
		font-family: var(--font-primary);
		font-weight: 700;
		font-size: 16px;
		line-height: 150%;
		letter-spacing: 0%;
		color: var(--color-text);
		margin: 0;
		padding-bottom: 32px;
	}

	.second-column-info{
		display: grid;
		gap:16px;
		padding-bottom: 32px;
	}

	.second-column-info p{
		font-family: var(--font-primary);
		font-weight: 400;
		font-size: 16px;
		line-height: 130%;
		letter-spacing: 0%;
		color: var(--color-text);
		margin: 0;
		transition: color 0.2s ease;
		cursor: pointer;
	}

	.second-column-info p:hover {
		color: var(--color-purple);
	}

	.second-column-footer{
		display: flex;
		gap: 15px;
	}

	.second-column-footer p{
		font-family: var(--font-primary);
		font-weight: 400;
		font-size: 16px;
		line-height: 130%;
		letter-spacing: 0%;
		color: var(--color-purple);
		margin: 0;
	}

	.third-column{
		width: 282px;
		height: 169px;
		display: grid;
		gap: 16px;
	}

	.third-column h3{
		margin: 0;
		font-family: var(--font-primary);
		font-weight: 700;
		font-size: 16px;
		line-height: 1.35;
		letter-spacing: 0%;
		color: var(--color-text);
		transition: color 0.2s ease;
		cursor: pointer;
	}

	.third-column h3:hover {
		color: var(--color-purple);
	}

	.forfth-column{
		width: 266px;
		height: 132px;
		display: grid;
		gap: 16px;
	}

	.footer-ending-header{
		padding-top: 28.5px;
		padding-bottom: 28.5px;
	}

	.forfth-column p{
		font-family: var(--font-primary);
		font-weight: 400;
		font-size: 16px;
		line-height: 130%;
		color: var(--color-gray-light);
		margin: 0;
	}
	
	.footer-ending{
		padding-left: 340px;
		padding-right: 340px;
	}

	.footer-ending-info{
		width: 100%;
		box-sizing: border-box;
		border-top: 1px solid var(--color-gray-border);
		display: flex;
		justify-content: space-between;
	}

	.footer-ending-header p{
		
		text-decoration: underline;
		margin: 0;
		font-family: var(--font-primary);
		font-weight: 400;
		font-size: 16px;
		color: var(--color-gray);
		transition: color 0.2s ease;
		cursor: pointer;
	}

	.footer-ending-header p:hover {
		color: var(--color-purple);
	}

	.site-footer-info{
		width: 248px;
		height: 30px;
		padding-top: 24px;
		padding-bottom: 24px;
		display:flex;
		gap: 16px;
	}

	.site-footer-info img{
		width: 30px;
		height: 29px;
	}

	.site-footer-info p{
		margin: 0;
		font-family: var(--font-primary);
		font-weight: 400;
		line-height: 2;
		font-size: 16px;
		color: var(--color-gray);
	}

	@media (max-width: 900px) {
		.footer-content {
			flex-direction: column;
			padding: 40px 16px;
			gap: 32px;
		}

		.footer-ending {
			padding: 0 16px;
		}

		.footer-ending-info {
			flex-direction: column;
			gap: 16px;
		}

		.nemer-logo {
			padding-bottom: 24px;
		}

		.second-column,
		.third-column,
		.forfth-column {
			width: 100%;
			height: auto;
		}
	}
</style>
