<script>
	let {
		type = 'text',
		name,
		placeholder,
		required = false,
		value = $bindable('')
	} = $props();

let inputType = $state(type === 'date' ? 'text' : type);

	function handleFocus() {
		if (type === 'date') {
			inputType = 'date';
		}
	}

	function handleBlur(event) {
		if (type === 'date' && !event.currentTarget.value) {
			inputType = 'text';
		}
	}
</script>

<label class="field">
	<span class="visually-hidden">{placeholder}</span>

	<input
		type={inputType}
		{name}
		{placeholder}
		{required}
		bind:value
		onfocus={handleFocus}
		onblur={handleBlur}
	/>
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

	.visually-hidden {
		position: absolute;
		width: 1px;
		height: 1px;
		overflow: hidden;
		clip: rect(0 0 0 0);
		white-space: nowrap;
	}
</style>
