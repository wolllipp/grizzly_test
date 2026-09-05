<header class='site-header'>
  <div class='site-header__content'>
    <a class='site-header__logo' href='/'>
      <img class='site-header__logo-image' src='/logos/logo.svg' alt='Enemer' />
    </a>

    <nav class='site-header__navigation' aria-label='Główna nawigacja'>
      <a class='site-header__link' href='/about'>O nas</a>
      <a class='site-header__link' href='/services'>Usługi</a>
      <a class='site-header__link' href='/pricing'>Cennik</a>
      <a class='site-header__link' href='/contact'>Kontakt</a>
      <a class='site-header__link' href='/reviews'>Opinie</a>
      <a class='site-header__link' href='/faq'>Pytania i odpowiedzi</a>
    </nav>

    <div class='site-header__contacts'>
      <a class='site-header__phone' href='tel:+48690590089'>+48690590089</a>
      <a class='site-header__call-link' href='/call'>Zamów rozmowę</a>
    </div>

    <button class='site-header__language' type='button'>
      <span>PL</span>
      <img class='site-header__language-icon' src='/logos/down_icon.svg' alt='' />
    </button>
  </div>
</header>

<style>
  .site-header__content {
    align-items: center;
    box-sizing: border-box;
    display: flex;
    gap: 90px;
    margin-left: 0;
    padding: 12px 340px 12px 339px;
  }

  .site-header__logo {
    flex: 0 0 186px;
  }

  .site-header__logo-image {
    display: block;
    height: 42px;
    width: 186px;
  }

  .site-header__navigation {
    align-items: center;
    display: flex;
    font-family: 'Work Sans', sans-serif;
    font-size: 16px;
    font-weight: 400;
    gap: 43px;
    justify-content: center;
    line-height: 150%;
    white-space: nowrap;
    
  }

  .site-header__navigation a {
	  letter-spacing: 0.1px;
  }

  .site-header__link {
    color: #2e2e2e;
    cursor: pointer;
    text-decoration: none;
  }

  .site-header__contacts {
    display: flex;
    flex: 0 0 auto;
    flex-direction: column;
    font-family: 'Averta CY', Arial, sans-serif;
    gap: 5px;
    white-space: nowrap;
  }

  .site-header__phone,
  .site-header__call-link {
    color: #2e2e2e;
    cursor: pointer;
    text-decoration: none;
  }

  .site-header__phone {
    font-family: 'Averta CY W01 Bold', Arial, sans-serif;
    font-size: 16px;
    font-weight: 700;
    letter-spacing: -0.1px;
    line-height: 150%;
  }

  .site-header__call-link {
    font-family: 'Averta CY W01 Bold', Arial, sans-serif;
    font-size: 13px;
    font-weight: 400;
    line-height: 150%;
  }

  .site-header__language {
    align-items: center;
    background: transparent;
    border: 0;
    color: #2e2e2e;
    cursor: pointer;
    display: flex;
    font-family: 'Averta CY', Arial, sans-serif;
    font-size: 13px;
    font-weight: 400;
    gap: 4px;
    line-height: 150%;
    padding: 0;
    white-space: nowrap;
  }

  .site-header__language-icon {
    height: 16px;
    width: 16px;
  }

  @media (max-width: 1500px) {
    .site-header__content {
      gap: 32px;
    }

    .site-header__navigation {
      gap: 16px;
    }
  }
</style>
