<script>
	let active = $state(false);
	let selectingCountry = $state(false);
	let closingCountry = $state(false);
	let selectedCountry = $state('BY');
	let phoneInput = $state('');
	let countryListRef = $state(null);

	function activate() {
		active = true;
	}

	function handleBlur(event) {
		if (!event.currentTarget.value) {
			active = false;
		}
	}

	function openCountryList() {
		selectingCountry = true;
		closingCountry = false;
	}

	function closeCountryList() {
		closingCountry = true;
		setTimeout(() => {
			selectingCountry = false;
			closingCountry = false;
		}, 300);
	}

	function selectCountry(code) {
		selectedCountry = code;
		phoneInput = '';
	}

	function handleKeydown(e) {
		if (e.key === 'Escape') {
			closeCountryList();
		}
	}

	function handleClickOutside(e) {
		if (countryListRef && !countryListRef.contains(e.target)) {
			closeCountryList();
		}
	}

	let placeholder = $derived(selectedCountry === 'BY' ? '+375 (__) ___ - __ - __' : '+7 (___) ___-__-__');
</script>

<label class="phone-field">
	<span class="visually-hidden">Telefon</span>

	{#if !active}
		<input type="text" name="phone" placeholder="Telefon" readonly />
		<button type="button" class="phone-field__plus" aria-label="Add phone number" onclick={activate}>
			<img src="/input_icons/Vector.svg" alt="" />
		</button>
	{:else}
		<div class="phone-field__active">
			{#if selectingCountry}
				<div
					class="phone-field__country-select"
					class:phone-field__country-select--closing={closingCountry}
					bind:this={countryListRef}
					onclick={handleClickOutside}
					onkeydown={handleKeydown}
					role="listbox"
					aria-label="Wybierz kraj"
				>
					<button type="button" class="phone-field__country-header" onclick={closeCountryList}>
						<span>Wybierz swój kraj</span>
						<img class="phone-field__arrow" src="/input_icons/vpravo.svg" alt="" />
					</button>

					<label class="phone-field__country-option" onclick={(e) => { e.stopPropagation(); selectCountry('BY'); }}>
						<input type="radio" name="country" value="BY" checked={selectedCountry === 'BY'} />
						<span class="phone-field__radio"></span>
						<img src="/input_icons/belarus.svg" alt="" />
					</label>

					<label class="phone-field__country-option" onclick={(e) => { e.stopPropagation(); selectCountry('RU'); }}>
						<input type="radio" name="country" value="RU" checked={selectedCountry === 'RU'} />
						<span class="phone-field__radio"></span>
						<img src="/input_icons/Russia.svg" alt="" />
					</label>
				</div>
				<input class="phone-field__input-shifted" type="tel" name="phone" placeholder={placeholder} bind:value={phoneInput} />
			{:else}
				<div class="phone-field__phone-view">
					<button type="button" class="phone-field__flag-btn" onclick={openCountryList}>
						<img class="phone-field__flag" src="/input_icons/{selectedCountry === 'BY' ? 'belarus' : 'Russia'}.svg" alt="" />
						<img class="phone-field__chevron" src="/input_icons/Vector 9.svg" alt="" />
					</button>
					<input type="tel" name="phone" placeholder={placeholder} onblur={handleBlur} bind:value={phoneInput} />
				</div>
			{/if}
		</div>
	{/if}
</label>

<style>
	.phone-field {
		position: relative;
		display: flex;
		align-items: center;
		width: 100%;
	}

	input {
		box-sizing: border-box;
		width: 100%;
		height: 32px;
		padding: 0;
		border: 0;
		border-bottom: 1px solid #ffffff99;
		outline: none;
		background: transparent;
		color: #ffffff;
		font-family: 'Averta CY', Arial, sans-serif;
		font-size: 16px;
		letter-spacing: -0.12px;
	}

	input::placeholder {
		color: #ffffff;
		opacity: 1;
	}

	input:focus {
		border-bottom-color: #ffffff;
	}

	.phone-field__plus {
		position: absolute;
		right: 0;
		bottom: 4px;
		display: grid;
		place-items: center;
		padding: 0 0 8px 0;
		border: 0;
		background: transparent;
		cursor: pointer;
		transition: opacity 0.3s ease;
	}

	.phone-field__plus img {
		width: 24px;
		height: 24px;
	}

	.phone-field__active {
		display: flex;
		align-items: center;
		width: 100%;
		border-bottom: 1px solid #ffffff99;
	}

	.phone-field__active > input {
		border-bottom: 0;
	}

	.phone-field__phone-view {
		display: flex;
		align-items: center;
		width: 100%;
		animation: slideLeft 0.3s ease;
	}

	.phone-field__phone-view > input {
		border-bottom: 0;
	}

	.phone-field__flag-btn {
		display: flex;
		align-items: center;
		gap: 4px;
		padding: 0;
		border: 0;
		background: transparent;
		cursor: pointer;
	}

	.phone-field__flag {
		width: 16px;
		height: 16px;
		flex-shrink: 0;
	}

	.phone-field__chevron {
		width: 16px;
		height: 16px;
		flex-shrink: 0;
	}

	.phone-field__country-select {
		display: flex;
		align-items: center;
		gap: 8px;
		animation: slideRight 0.3s ease;
		flex-shrink: 0;
	}

	.phone-field__country-select--closing {
		animation: slideRightReverse 0.3s ease forwards;
	}

	.phone-field__country-header {
		display: flex;
		align-items: center;
		gap: 4px;
		cursor: pointer;
		padding: 0;
		border: 0;
		background: transparent;
		white-space: nowrap;
	}

	.phone-field__country-header img {
		width: 16px;
		height: 16px;
	}

	.phone-field__country-header span {
		color: #ffffff;
		font-family: 'Averta CY', Arial, sans-serif;
		font-size: 14px;
	}

	.phone-field__arrow {
		width: 4px !important;
		height: 8px !important;
	}

	.phone-field__country-option {
		display: flex;
		align-items: center;
		gap: 4px;
		cursor: pointer;
	}

	.phone-field__country-option:first-of-type {
		margin-right: 4px;
	}

	.phone-field__country-option:last-of-type {
		margin-right: 24px;
	}

	.phone-field__country-option img {
		width: 16px;
		height: 16px;
	}

	.phone-field__radio {
		width: 12px;
		height: 12px;
		border-radius: 50%;
		border: 2px solid #ffffff;
		background: transparent;
		position: relative;
		flex-shrink: 0;
	}

	.phone-field__radio::after {
		content: '';
		width: 6px;
		height: 6px;
		border-radius: 50%;
		background: #ffffff;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%) scale(0);
		transition: transform 0.2s ease;
	}

	.phone-field__country-option input {
		display: none;
	}

	.phone-field__country-option input:checked + .phone-field__radio::after {
		transform: translate(-50%, -50%) scale(1);
	}

	.phone-field__input-shifted {
		border-bottom: 0;
		flex: 1;
	}

	.visually-hidden {
		position: absolute;
		width: 1px;
		height: 1px;
		overflow: hidden;
		clip: rect(0 0 0 0);
		white-space: nowrap;
	}

	@keyframes slideRight {
		from {
			opacity: 0;
			transform: translateX(-20px);
		}
		to {
			opacity: 1;
			transform: translateX(0);
		}
	}

	@keyframes slideRightReverse {
		from {
			opacity: 1;
			transform: translateX(0);
		}
		to {
			opacity: 0;
			transform: translateX(-20px);
		}
	}

	@keyframes slideLeft {
		from {
			opacity: 0;
			transform: translateX(20px);
		}
		to {
			opacity: 1;
			transform: translateX(0);
		}
	}
</style>
