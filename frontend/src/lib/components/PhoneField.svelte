<script>
  let {
    country = $bindable('BY'),
    value = $bindable(''),
    canAdd = false,
    canRemove = false,
    onAdd = () => {},
    onRemove = () => {},
    onblur = () => {},
    error = null
  } = $props();

  let selectingCountry = $state(false);
  let closingCountry = $state(false);
  let fieldRef = $state(null);

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
    country = code;
    value = (code === 'BY' ? '+375' : '+7') + ' ';
    closeCountryList();
  }

  function handleWindowKeydown(e) {
    if (e.key === 'Escape' && selectingCountry) closeCountryList();
  }

  function handleWindowClick(e) {
    if (selectingCountry && fieldRef && !fieldRef.contains(e.target)) {
      closeCountryList();
    }
  }

  let placeholder = $derived(country === 'BY' ? '+375 (__) ___ - __ - __' : '+7 (___) ___-__-__');
  let phoneCode = $derived(country === 'BY' ? '+375' : '+7');
  let maxDigits = $derived(country === 'BY' ? 9 : 10);

  function handlePhoneInput(e) {
    const code = phoneCode;
    let val = e.currentTarget.value;
    if (!val.startsWith(code)) {
      val = code + ' ';
    }
    const digits = val.replace(/\D/g, '').replace(/^7/, '').replace(/^375/, '');
    if (digits.length > maxDigits) {
      return;
    }
    e.currentTarget.value = val;
    value = val;
  }

  function handlePhoneFocus(e) {
    if (!e.currentTarget.value) {
      e.currentTarget.value = phoneCode + ' ';
    }
  }
</script>

<svelte:window onclick={handleWindowClick} onkeydown={handleWindowKeydown} />

<div class="phone-field" class:phone-field--error={!!error} bind:this={fieldRef}>
  {#if selectingCountry}
		<div
			class="phone-field__country-select"
			class:phone-field__country-select--closing={closingCountry}
			role="listbox"
			aria-label="Wybierz kraj"
			tabindex="-1"
		>
			<button type="button" class="phone-field__country-header" onclick={(e) => { e.stopPropagation(); closeCountryList(); }}>
				<span>Wybierz swój kraj</span>
				<img class="phone-field__arrow" src="/input_icons/vpravo.svg" alt="" />
			</button>

			<button
				type="button"
				class="phone-field__country-option"
				class:phone-field__country-option--selected={country === 'BY'}
				aria-pressed={country === 'BY'}
				onclick={(e) => { e.stopPropagation(); selectCountry('BY'); }}
			>
				<span class="phone-field__radio"></span>
				<img src="/input_icons/belarus.svg" alt="Białoruś" />
			</button>

			<button
				type="button"
				class="phone-field__country-option"
				class:phone-field__country-option--selected={country === 'RU'}
				aria-pressed={country === 'RU'}
				onclick={(e) => { e.stopPropagation(); selectCountry('RU'); }}
			>
				<span class="phone-field__radio"></span>
				<img src="/input_icons/Russia.svg" alt="Rosja" />
			</button>
		</div>
		<input class="phone-field__input-shifted" type="tel" name="phone" placeholder={placeholder} oninput={handlePhoneInput} onfocus={handlePhoneFocus} onblur={onblur} />
	{:else}
    <div class="phone-field__phone-view">
      <button type="button" class="phone-field__flag-btn" onclick={(e) => { e.stopPropagation(); openCountryList(); }}>
        <img class="phone-field__flag" src="/input_icons/{country === 'BY' ? 'belarus' : 'Russia'}.svg" alt="" />
        <img class="phone-field__chevron" src="/input_icons/Vector 9.svg" alt="" />
      </button>
      <input type="tel" name="phone" placeholder={placeholder} oninput={handlePhoneInput} onfocus={handlePhoneFocus} onblur={onblur} />
    </div>
  {/if}

  {#if canRemove}
    <button type="button" class="phone-field__remove" aria-label="Usuń numer" onclick={onRemove}>&minus;</button>
  {/if}
  {#if canAdd}
    <button type="button" class="phone-field__plus" aria-label="Dodaj numer" onclick={onAdd}>
      <img src="/input_icons/Vector.svg" alt="" />
    </button>
  {/if}
</div>

{#if error}
  <span class="phone-field-error">{error}</span>
{/if}

<style>
  .phone-field {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    gap: 8px;
    border-bottom: 1px solid var(--color-border);
  }

  input {
    box-sizing: border-box;
    width: 100%;
    height: 32px;
    padding: 0;
    border: 0;
    outline: none;
    background: transparent;
    color: var(--color-white);
    font-family: var(--font-primary);
    font-size: 16px;
    letter-spacing: -0.12px;
    flex: 1;
  }

  input::placeholder {
    color: #ffffff;
    opacity: 1;
  }

  .phone-field:focus-within {
    border-bottom-color: #ffffff;
  }

  .phone-field__phone-view {
    display: flex;
    align-items: center;
    width: 100%;
    gap: 16px;
    animation: slideLeft 0.3s ease;
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

  .phone-field__flag,
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

  .phone-field__country-option {
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 0;
    border: 0;
    background: transparent;
    cursor: pointer;
  }

  .phone-field__country-option:first-of-type { margin-right: 4px; }
  .phone-field__country-option:last-of-type { margin-right: 24px; }
  .phone-field__country-option img { width: 16px; height: 16px; }

  .phone-field__radio {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #ffffff;
    background: transparent;
    position: relative;
    flex-shrink: 0;
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
  color: var(--color-white);
  font-family: var(--font-primary);
  font-size: 14px;
}

.phone-field__arrow {
  width: 4px !important;
  height: 8px !important;
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

  .phone-field__country-option--selected .phone-field__radio::after {
    transform: translate(-50%, -50%) scale(1);
  }

  .phone-field__input-shifted {
    flex: 1;
  }

  .phone-field__plus,
  .phone-field__remove {
    display: grid;
    place-items: center;
    flex-shrink: 0;
    width: 24px;
    height: 24px;
    padding: 0;
    border: 0;
    background: transparent;
    cursor: pointer;
    transition: opacity 0.3s ease;
  }

  .phone-field__plus img {
    width: 24px;
    height: 24px;
  }

  .phone-field__plus:hover,
  .phone-field__remove:hover {
    opacity: 0.7;
  }

  .phone-field__remove {
    color: #ffffff;
    font-size: 20px;
    line-height: 1;
  }

  @keyframes slideRight {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
  }

  @keyframes slideRightReverse {
    from { opacity: 1; transform: translateX(0); }
    to { opacity: 0; transform: translateX(-20px); }
  }

  @keyframes slideLeft {
    from { opacity: 0; transform: translateX(20px); }
    to { opacity: 1; transform: translateX(0); }
  }

  .phone-field--error {
    border-bottom-color: var(--color-error);
  }

  .phone-field-error {
    display: block;
    margin-top: 4px;
    color: var(--color-error);
    font-size: 12px;
    font-family: var(--font-primary);
  }
</style>
