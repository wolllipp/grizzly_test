<script>
  import FormField from '$lib/components/FormField.svelte'
  import PhoneField from '$lib/components/PhoneField.svelte'
  import MaritalStatusField from '$lib/components/MaritalStatusField.svelte'

  let firstName = $state('')
  let lastName = $state('')
  let middleName = $state('')
  let birthDate = $state('')
  let email = $state('')
  let about = $state('')
  let isRulesAccepted = $state(false)

  let isFormValid = $derived(
    isRulesAccepted && firstName && lastName && middleName && birthDate && email && about
  )
</script>

<div class='main'>
  <div class='content'>
    <div class='boxes'>
      <h2>Nasi kurierzy</h2>
      <div class='couriers-grid'>
        <div class='courier-card'>
          <img src='/boxed/dpd.svg' alt='DPD' />
        </div>
        <div class='courier-card'>
          <img src='/boxed/gls.svg' alt='GLS' />
        </div>
        <div class='courier-card'>
          <img src='/boxed/dhl.svg' alt='DHL' />
        </div>
        <div class='courier-card'>
          <img src='/boxed/shopify.svg' alt='Shopify' />
        </div>
        <div class='courier-card'>
          <img src='/boxed/woocommerce.svg' alt='WooCommerce' />
        </div>
        <div class='courier-card'>
          <img src='/boxed/prestashop.svg' alt='PrestaShop' />
        </div>
        <div class='courier-card'>
          <img src='/boxed/ppl.svg' alt='PPL' />
        </div>
        <div class='courier-card'>
          <img src='/boxed/slovenska-posta.svg' alt='Slovenska Posta' />
        </div>
        <div class='courier-card'>
          <img src='/boxed/magento.svg' alt='Magento' />
        </div>
      </div>
    </div>
    <div class='photo'>
      <img src='/content/Rectangle 1.png' alt='Kurier przygotowujący przesyłkę' />
    </div>
  </div>
  <div class='form'>
    <div class='form-box'>
      <div class='form-header'>
        <h2>Szukasz najlepszej oferty?</h2>
        <p>Zostaw aplikację, a nasz menedżer skontaktuje się z Tobą w celu konsultacji</p>
      </div>
      <form class='form-content' action=''>
        <div class='form-row'>
          <FormField name='firstName' placeholder='Twoje imię' bind:value={firstName} />
          <FormField name='lastName' placeholder='Twoje nazwisko' bind:value={lastName} />
          <FormField name='middleName' placeholder='Twoje drugie imię' bind:value={middleName} />
        </div>
        <div class='form-column'>
          <FormField type='date' name='birthDate' placeholder='Twoja data urodzenia' bind:value={birthDate} />
          <FormField name='email' type='email' placeholder='E-mail' bind:value={email} />
          <PhoneField />
          <MaritalStatusField />
        </div>
        <div class='textarea-field'>
          <textarea name='O mnie' id='1' class='textarea-omnie' placeholder='O mnie' bind:value={about}></textarea>
        </div>
        <div class='form-submitting'>
          <div class='form-checkbox'>
            <label class='form-checkbox__label'>
              <input type='checkbox' id='rules' bind:checked={isRulesAccepted}>
              <span class='form-checkbox__box'></span>
              <span class='form-checkbox__text'>Przeczytałem zasady</span>
            </label>
          </div>
          <button type='submit' class='form-button__submit' class:form-button__submit--active={isFormValid}>
            Wysłać
          </button>
        </div>
      </form>
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

  .boxes {
    align-self: center;
    width: 100%;
  }

  .boxes h2 {
    color: #2e2e2e;
    font-family: 'Averta CY', sans-serif;
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
    height: 700px;
    padding: 35px 860px 35px 340px;
    width: 100%;
  }

  .form-box {
    background-color: #343434cc;
    border-radius: 5px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    gap: 48px;
    height: 630px;
    padding: 40px;
    position: static;
    width: 720px;
  }

  .form-header {
    display: flex;
    flex-direction: column;
    gap: 10px;
    height: 82px;
    width: 640px;
  }

  .form-header h2 {
    color: #ffffff;
    font-family: 'Averta CY', Arial, sans-serif;
    font-size: 32px;
    font-weight: 700;
    letter-spacing: -0.2px;
    line-height: 170%;
    margin: 0;
  }

  .form-header p {
    color: #ffffff;
    font-family: 'Averta CY', Arial, sans-serif;
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

  .textarea-field {
    border-bottom: 1px solid #ffffff80;
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
    color: #ffffff;
    font-family: 'Averta CY', Arial, sans-serif;
    font-size: 16px;
    font-weight: 400;
    height: 32px;
    letter-spacing: 0;
    line-height: 150%;
    overflow: hidden;
    resize: none;
    width: 100%;
  }

  textarea::placeholder {
    background-color: transparent;
    color: #ffffff;
    font-family: 'Averta CY', Arial, sans-serif;
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
    align-items: center;
    cursor: pointer;
    display: flex;
    gap: 8px;
  }

  .form-checkbox__label {
    align-items: center;
    cursor: pointer;
    display: flex;
    gap: 8px;
  }

  .form-checkbox__label input {
    display: none;
  }

  .form-checkbox__box {
    align-items: center;
    background-color: transparent;
    border: 1px solid #ffffff80;
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
    border-color: #ffffff;
  }

  .form-checkbox__box::after {
    background-color: #ffffff;
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
    color: #ffffff;
    font-family: 'Averta CY', Arial, sans-serif;
    font-size: 13px;
    font-weight: 400;
    letter-spacing: 0;
    line-height: 150%;
  }

  .form-button__submit {
    background-color: #78599c;
    border: 0;
    border-radius: 4px;
    color: #ffffff;
    cursor: pointer;
    font-family: 'Averta CY', Arial, sans-serif;
    font-size: 16px;
    height: 48px;
    opacity: 0.8;
    padding: 12px 40px;
    transition: background-color 0.3s ease, opacity 0.3s ease;
    width: 200px;
  }

  .form-button__submit--active {
    opacity: 1;
  }

  .form-button__submit--active:hover {
    background-color: #6f39ae;
  }
</style>
