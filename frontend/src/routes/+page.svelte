<script>
  import { fade } from 'svelte/transition'
  import FormField from '$lib/components/FormField.svelte'
  import PhoneField from '$lib/components/PhoneField.svelte'
  import MaritalStatusField from '$lib/components/MaritalStatusField.svelte'
  import {
    validateFirstName, validateLastName, validateMiddleName,
    validateBirthDate, validateEmail, validatePhone, validateAbout
  } from '$lib/validation.js'

  const API_URL = import.meta.env.PUBLIC_API_URL || 'http://localhost:8000/submit.php'

  let firstName = $state('')
  let lastName = $state('')
  let middleName = $state('')
  let birthDate = $state('')
  let email = $state('')
  let about = $state('')
  let isRulesAccepted = $state(false)
  let maritalStatus = $state('')

  let phones = $state([])

  function addPhone() {
    if (phones.length < 5) phones = [...phones, { country: 'BY', phone: '' }]
  }
  function removePhone(index) {
    phones = phones.filter((_, i) => i !== index)
  }

  let touched = $state({})
  function markTouched(field) {
    touched = { ...touched, [field]: true }
  }
  let phonesTouched = $state(false)

  let errors = $derived({
    firstName: validateFirstName(firstName),
    lastName: validateLastName(lastName),
    middleName: validateMiddleName(middleName),
    birthDate: validateBirthDate(birthDate),
    email: validateEmail(email),
    about: validateAbout(about),
    phone: (() => {
      const filledPhones = phones.filter(p => p.phone.trim())
      if (filledPhones.length === 0) return null
      for (const p of filledPhones) {
        const err = validatePhone(p.phone, p.country)
        if (err) return err
      }
      return null
    })(),
    maritalStatus: maritalStatus ? null : 'Wybierz stan cywilny',
    rules: isRulesAccepted ? null : 'Zaakceptuj zasady',
    contact: (email.trim() || phones.some(p => p.phone.trim()))
      ? null
      : 'Podaj email lub telefon'
  })

  let isFormValid = $derived((() => {
    const { contact, ...rest } = errors
    const hasContact = !!(email.trim() || phones.some(p => p.phone.trim()))
    return hasContact && Object.values(rest).every(e => e === null)
  })())

  let submitted = $state(false)
  let submitting = $state(false)
  let submitError = $state(null)
  let serverErrors = $state({})

  function handleFormKeydown(e) {
    if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
      e.preventDefault()
    }
  }

  async function handleSubmit(e) {
    e.preventDefault()
    touched = Object.fromEntries(Object.keys(errors).map(k => [k, true]))
    phonesTouched = true
    if (!isFormValid) return

    submitting = true
    submitError = null
    serverErrors = {}

    const payload = {
      firstName,
      lastName,
      middleName,
      birthDate,
      email,
      maritalStatus,
      about,
      rulesAccepted: isRulesAccepted,
      phones: phones.map(p => ({ country: p.country, phone: p.phone }))
    }

    try {
      const response = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      })

      const data = await response.json()

      if (response.ok) {
        submitted = true
      } else if (response.status === 422) {
        serverErrors = data.errors || {}
        submitError = 'Sprawdź poprawność wypełnionych pól'
      } else {
        submitError = 'Błąd serwera, spróbuj później'
      }
    } catch (err) {
      submitError = 'Nie udało się wysłać formularza. Sprawdź połączenie.'
      console.error(err)
    } finally {
      submitting = false
    }
  }

  function handleTextareaInput(e) {
    e.target.style.height = 'auto'
    e.target.style.height = Math.min(e.target.scrollHeight, 168) + 'px'
  }
</script>

<div class='main'>
  <div class='content'>
    <div class='boxes'>
      <h2>Nasi kurierzy</h2>
      <div class='couriers-grid'>
        <div class='courier-card'><img src='/boxed/dpd.svg' alt='DPD' /></div>
        <div class='courier-card'><img src='/boxed/gls.svg' alt='GLS' /></div>
        <div class='courier-card'><img src='/boxed/dhl.svg' alt='DHL' /></div>
        <div class='courier-card'><img src='/boxed/shopify.svg' alt='Shopify' /></div>
        <div class='courier-card'><img src='/boxed/woocommerce.svg' alt='WooCommerce' /></div>
        <div class='courier-card'><img src='/boxed/prestashop.svg' alt='PrestaShop' /></div>
        <div class='courier-card'><img src='/boxed/ppl.svg' alt='PPL' /></div>
        <div class='courier-card'><img src='/boxed/slovenska-posta.svg' alt='Slovenska Posta' /></div>
        <div class='courier-card'><img src='/boxed/magento.svg' alt='Magento' /></div>
      </div>
    </div>
    <div class='photo'>
      <img src='/content/Rectangle 1.png' alt='Kurier przygotowujący przesyłkę' />
    </div>
  </div>

  <div class='form'>
    <div class='form-box'>
      {#if submitted}
        <div class='form-success' transition:fade>
          <p>Wysłano pomyślnie</p>
        </div>
      {:else}
        <div class='form-header'>
          <div class='form-header__first'>
            <h2>Szukasz najlepszej oferty?</h2>
          </div>
          <p>Zostaw aplikację, a nasz menedżer skontaktuje się z Tobą w celu konsultacji</p>
        </div>
        <!-- svelte-ignore a11y_no_noninteractive_element_interactions -->
        <form class='form-content' onsubmit={handleSubmit} onkeydown={handleFormKeydown}>
          <div class='form-row'>
            <FormField name='firstName' placeholder='Twoje imię' bind:value={firstName}
              error={touched.firstName ? (errors.firstName || serverErrors.firstName) : null} onblur={() => markTouched('firstName')} />
            <FormField name='lastName' placeholder='Twoje nazwisko' bind:value={lastName}
              error={touched.lastName ? (errors.lastName || serverErrors.lastName) : null} onblur={() => markTouched('lastName')} />
            <FormField name='middleName' placeholder='Twoje drugie imię' bind:value={middleName}
              error={touched.middleName ? (errors.middleName || serverErrors.middleName) : null} onblur={() => markTouched('middleName')} />
          </div>

          <div class='form-column'>
            <FormField type='date' name='birthDate' placeholder='Twoja data urodzenia' bind:value={birthDate}
              error={touched.birthDate ? (errors.birthDate || serverErrors.birthDate) : null} onblur={() => markTouched('birthDate')} />
            <FormField name='email' type='email' placeholder='E-mail' bind:value={email}
              error={touched.email ? (errors.email || errors.contact || serverErrors.email) : null} onblur={() => markTouched('email')} />
            <div class='phones-list'>
              {#if phones.length === 0}
                <div class="phone-field phone-field--inert">
                  <input type="text" placeholder="Telefon" readonly />
                  <button type="button" class="phone-field__plus" aria-label="Dodaj numer" onclick={addPhone}>
                    <img src="/input_icons/Vector.svg" alt="" />
                  </button>
                </div>
              {:else}
                {#each phones as _, i}
                  <PhoneField
                    bind:country={phones[i].country}
                    bind:value={phones[i].phone}
                    canAdd={i === phones.length - 1 && phones.length < 5}
                    canRemove={true}
                    onAdd={addPhone}
                    onRemove={() => removePhone(i)}
                    onblur={() => { phonesTouched = true }}
                    error={phonesTouched ? errors.phone : null}
                  />
                {/each}
              {/if}
            </div>
            {#if (touched.email || touched.contact || phones.some(p => p.phone.trim())) && errors.contact}
              <p class='field-error'>{errors.contact}</p>
            {/if}

            <MaritalStatusField bind:value={maritalStatus}
              error={touched.maritalStatus ? errors.maritalStatus : null}
              onblur={() => markTouched('maritalStatus')} />
          </div>

          <div class='textarea-field'>
            <textarea
              name='about'
              maxlength="1000"
              class='textarea-omnie'
              class:field--error={touched.about && errors.about}
              bind:value={about}
              oninput={handleTextareaInput}
              onblur={() => markTouched('about')}
              placeholder='O mnie'
            ></textarea>
          </div>
          {#if touched.about && errors.about}
            <p class='field-error'>{errors.about}</p>
          {/if}

          {#if submitError}
            <p class='field-error'>{submitError}</p>
          {/if}

          <div class='form-submitting'>
            <div class='form-checkbox'>
              <label class='form-checkbox__label'>
                <input type='checkbox' id='rules' bind:checked={isRulesAccepted} onblur={() => markTouched('rules')}>
                <span class='form-checkbox__box'></span>
                <span class='form-checkbox__text'>Przeczytałem zasady</span>
              </label>
              {#if touched.rules && errors.rules}
                <p class='field-error'>{errors.rules}</p>
              {/if}
            </div>
            <button type='submit' class='form-button__submit' class:form-button__submit--active={isFormValid}
              disabled={!isFormValid || submitting}>
              {submitting ? 'Wysyłanie...' : 'Wysłać'}
            </button>
          </div>
        </form>
      {/if}
    </div>
  </div>
</div>

<style>
  .main {
    display: grid;
    gap: 120px;
    padding-top: 120px;
  }

  .courier-card {
    align-items: center;
    background-color: transparent;
    border-radius: 4px;
    box-shadow: 0 0 24px 0 #0000001A;
    box-sizing: border-box;
    display: flex;
    height: 104px;
    justify-content: center;
    width: 232px;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
  }

  .courier-card:hover {
    box-shadow: 0 4px 32px 0 #00000033;
    transform: translateY(-2px);
  }

  .courier-card img {
    height: auto;
    max-height: 80%;
    max-width: 80%;
    object-fit: contain;
    width: auto;
  }

  .photo {
    width: fit-content;
  }

  .photo img { 
    display: block; 
    height: auto; 
    width: auto; 
  }

  .boxes { align-self: center; width: 100%; }

  .boxes h2 {
    color: var(--color-text);
    font-family: var(--font-primary);
    font-size: 40px;
    font-weight: 600;
    letter-spacing: 0;
    line-height: 130%;
    margin: 0;
    padding-bottom: 48px;
  }

  .couriers-grid {
    display: grid;
    gap: 20px;
    grid-template-columns: repeat(3, 232px);
  }

  .content {
    align-items: start;
    display: grid;
    gap: 80px;
    grid-template-columns: 736px minmax(0, 1fr);
    padding-left: 340px;
    padding-right: 104px;
  }

  .form {
    background-image: url('/content/form.svg');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    box-sizing: border-box;
    padding: 35px 860px 35px 340px;
    width: 100%;
  }

  .form-box {
    background-color: var(--color-form-bg);
    border-radius: 5px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    gap: 48px;
    min-height: 630px;
    padding: 40px;
    width: 720px;
  }

  .form-success {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 400px;
  }

  .form-success p {
    color: var(--color-white);
    font-family: var(--font-primary);
    font-size: 32px;
    font-weight: 700;
  }

  .form-header {
    display: flex;
    flex-direction: column;
    gap: 10px;
       height: 82px;
    width: 640px;
  }

  .form-header h2 {
    color: var(--color-white);
    font-family: var(--font-primary);
    font-size: 32px;
    font-weight: 700;
    margin: 0;
    letter-spacing: -0.2px;
    line-height: 170%;
    margin: 0;
  }

  .form-header p {
    color: var(--color-white);
    font-family: var(--font-primary);
    font-size: 16px;
    font-weight: 400;
    letter-spacing: -0.07px;
    line-height: 100%;
    margin: 0;
  }

  .form-row {
    display: grid;
    gap: 20px;
    grid-template-columns: repeat(3, 1fr);
    width: 100%;
  }

  .form-column {
    display: flex;
    flex-direction: column;
    gap: 30px;
    padding-bottom: 30px;
    padding-top: 30px;
    width: 100%;
  }

  .phones-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .phone-field--inert {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    border-bottom: 1px solid var(--color-border);
  }

  .phone-field--inert input {
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
    cursor: default;
  }

  .phone-field--inert input::placeholder {
    color: #ffffff;
    opacity: 1;
  }

  .phone-field--inert .phone-field__plus {
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

  .phone-field--inert .phone-field__plus img {
    width: 24px;
    height: 24px;
  }

  .phone-field--inert .phone-field__plus:hover {
    opacity: 0.7;
  }

  .field-error {
    margin: 0;
    color: var(--color-error);
    font-size: 12px;
    font-family: var(--font-primary);
  }

  .textarea-field {
    border-bottom: 1px solid var(--color-border);
    box-sizing: border-box;
    display: flex;
    height: 32px;
    justify-content: space-between;
    width: 100%;
  }

  .textarea-omnie {
    background-color: transparent;
    border: none;
    box-sizing: border-box;
    color: var(--color-white);
    font-family: var(--font-primary);
    font-size: 16px;
    min-height: 32px;
    max-height: 168px;
    line-height: 150%;
    overflow-y: auto;
    resize: none;
    width: 100%;
  }

  .textarea-omnie.field--error {
    border-bottom: 1px solid var(--color-error);
  }

  textarea::placeholder {
    background-color: transparent;
    color: var(--color-white);
    font-family: var(--font-primary);
    font-size: 16px;
    font-weight: 400;
    letter-spacing: 0;
    line-height: 150%;
    opacity: 1;
  }

  .form-submitting {
    align-items: center;
    display: flex;
    justify-content: space-between;
    padding-top: 30px;
  }

  .form-checkbox {
    align-items: flex-start;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .form-checkbox__label {
    align-items: center;
    cursor: pointer;
    display: flex;
    gap: 8px;
  }

  .form-checkbox__label input { display: none; }

  .form-checkbox__box {
    align-items: center;
    background-color: transparent;
    border: 1px solid var(--color-border);
    border-radius: 3px;
    box-sizing: border-box;
    display: flex;
    flex-shrink: 0;
    height: 16px;
    justify-content: center;
    transition: border-color 0.3s ease;
    width: 16px;
  }

  .form-checkbox__label:hover .form-checkbox__box {
    border-color: var(--color-white);
  }

  .form-checkbox__box::after {
    background-color: var(--color-white);
    border-radius: 2px;
    content: '';
    height: 8px;
    opacity: 0;
    transform: scale(0.5);
    transition: opacity 0.2s ease, transform 0.2s ease;
    width: 8px;
  }

  .form-checkbox__label input:checked + .form-checkbox__box::after {
    opacity: 1;
    transform: scale(1);
  }

  .form-checkbox__text {
    color: var(--color-white);
    font-family: var(--font-primary);
    font-size: 13px;
    font-weight: 400;
    letter-spacing: 0;
    line-height: 150%;
  }

  .form-button__submit {
    background-color: var(--color-purple);
    border: 0;
    border-radius: 4px;
    color: var(--color-white);
    cursor: not-allowed;
    font-family: var(--font-primary);
    font-size: 16px;
    height: 48px;
    opacity: 0.5;
    padding: 12px 40px;
    transition: background-color 0.3s ease, opacity 0.3s ease;
    width: 200px;
  }

  .form-button__submit--active {
    cursor: pointer;
    opacity: 1;
  }

  .form-button__submit--active:hover {
    background-color: var(--color-purple-hover);
  }

  @media (max-width: 1200px) {
    .content {
      padding-left: 24px;
      padding-right: 24px;
    }

    .form {
      padding: 35px 24px;
    }

    .form-box {
      width: 100%;
    }

    .form-header {
      width: 100%;
    }
  }

  @media (max-width: 900px) {
    .content {
      grid-template-columns: 1fr;
      gap: 40px;
    }

    .photo {
      display: none;
    }

    .form {
      padding: 35px 16px;
    }

    .form-box {
      width: 100%;
      min-height: auto;
      padding: 24px;
    }

    .form-row {
      grid-template-columns: 1fr;
    }

    .couriers-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .courier-card {
      width: 100%;
    }

    .main {
      padding-top: 40px;
      gap: 40px;
    }
  }

  @media (max-width: 600px) {
    .couriers-grid {
      grid-template-columns: 1fr;
    }

    .form-submitting {
      flex-direction: column;
      gap: 16px;
      align-items: flex-start;
    }
  }
</style>
