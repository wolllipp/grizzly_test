<script>
  let {
    type = 'text',
    name,
    placeholder,
    required = false,
    value = $bindable(''),
    error = null,
    maxlength = null,
    onblur = () => {}
  } = $props();

  let isDateFocused = $state(false);

  let inputType = $derived(
    type === 'date' ? (isDateFocused || value ? 'date' : 'text') : type
  );

  function handleFocus() {
    if (type === 'date') isDateFocused = true;
  }

  function handleBlur(event) {
    if (type === 'date' && !event.currentTarget.value) isDateFocused = false;
    onblur();
  }
</script>

<label class="field">
  <span class="visually-hidden">{placeholder}</span>

  <input
    type={inputType}
    {name}
    {placeholder}
    {required}
    {maxlength}
    class:field--error={!!error}
    bind:value
    onfocus={handleFocus}
    onblur={handleBlur}
  />

  {#if error}
    <span class="field-error">{error}</span>
  {/if}
</label>

<style>
  .field {
    display: block;
    width: 100%;
  }

  input {
    box-sizing: border-box;
    width: 100%;
    height: 32px;
    border: 0;
    padding: 0;
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

  input.field--error {
    border-bottom-color: #ff4d4f;
  }

  .field-error {
    display: block;
    margin-top: 4px;
    color: #ff4d4f;
    font-size: 12px;
    font-family: 'Averta CY', Arial, sans-serif;
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
