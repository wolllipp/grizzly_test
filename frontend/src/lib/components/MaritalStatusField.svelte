<script>
  import { slide } from 'svelte/transition';

  let { value = $bindable(''), error = null, onblur = () => {} } = $props();

  const options = ['Samotny/niezamężny', 'Żonaty', 'Rozwiedziony', 'Wdowiec/wdowa'];

  let open = $state(false);
  let fieldRef = $state(null);

  function toggle() {
    open = !open;
  }

  function selectOption(option) {
    value = option;
    open = false;
  }

  function handleClickOutside(e) {
    if (fieldRef && !fieldRef.contains(e.target)) {
      open = false;
    }
  }
</script>

<svelte:window onclick={handleClickOutside} />

<label class="status-field" bind:this={fieldRef}>
  <span class="visually-hidden">Stan cywilny</span>
  <button class="status-button" type="button" onclick={toggle} onblur={onblur} class:field--error={!!error}>
    <span>{value || 'Stan cywilny'}</span>
    <img src="/input_icons/Vector 9.svg" alt="" class:open />
  </button>

  {#if open}
    <div class="status-options" transition:slide>
      {#each options as option}
        <label class="status-option">
          <input type="radio" name="maritalStatus" value={option} checked={value === option} onchange={() => selectOption(option)} />
          <span class="status-radio"></span>
          {option}
        </label>
      {/each}
    </div>
  {/if}
</label>

{#if error}
  <span class="status-field-error">{error}</span>
{/if}

<style>
  .status-field {
    position: relative;
    display: block;
    width: 100%;
    color: var(--color-white);
    font-family: var(--font-primary);
    font-size: 16px;
  }

  .status-button {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    height: 32px;
    padding: 0;
    border: 0;
    border-bottom: 1px solid var(--color-border);
    background: transparent;
    color: inherit;
    font: inherit;
    text-align: left;
    cursor: pointer;
  }

  .status-button.field--error {
    border-bottom-color: var(--color-error);
  }

  .status-button span {
    color: #ffffff;
    opacity: 1;
  }

  .status-button img {
    width: 16px;
    height: 16px;
    transition: transform 0.2s ease;
  }

  .status-button img.open {
    transform: rotate(180deg);
  }

  .status-options {
    position: absolute;
    z-index: 2;
    top: calc(100% + 12px);
    left: 0;
    right: 0;
    padding: 12px 0;
    background: #ffffff;
    border-radius: 4px;
    box-shadow: 0 8px 24px #00000040;
  }

  .status-option {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 16px;
    cursor: pointer;
    color: #000000;
    font-family: 'Averta CY', Arial, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 150%;
  }

  .status-option:hover {
    background: #f5f5f5;
  }

  .status-option input {
    display: none;
  }

  .status-radio {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid var(--color-purple);
    background: transparent;
    position: relative;
    flex-shrink: 0;
  }

  .status-radio::after {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--color-purple);
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    transition: transform 0.2s ease;
  }

  .status-option input:checked + .status-radio::after {
    transform: translate(-50%, -50%) scale(1);
  }

  .status-button:hover {
    border-bottom-color: #ffffff;
  }

  .status-field-error {
    display: block;
    margin-top: 4px;
    color: var(--color-error);
    font-size: 12px;
    font-family: var(--font-primary);
  }

  .visually-hidden {
    position: absolute;
    width: 1px;
    height: 1px;
    overflow: hidden;
    clip: rect(0 0 0 0);
    white-space: nowrap;
  }
</style>
