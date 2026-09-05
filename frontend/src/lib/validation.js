export function validateFirstName(v) {
  if (!v || !v.trim()) return 'Pole wymagane';
  if (v.length > 50) return 'Maksymalnie 50 znaków';
  return null;
}

export function validateLastName(v) {
  if (!v || !v.trim()) return 'Pole wymagane';
  if (v.length > 50) return 'Maksymalnie 50 znaków';
  return null;
}

export function validateMiddleName(v) {
  if (v && v.length > 50) return 'Maksymalnie 50 znaków';
  return null;
}

export function validateBirthDate(v) {
  if (!v) return 'Pole wymagane';
  const date = new Date(v);
  if (isNaN(date.getTime())) return 'Nieprawidłowa data';
  if (date > new Date()) return 'Data nie może być w przyszłości';
  const minDate = new Date();
  minDate.setFullYear(minDate.getFullYear() - 120);
  if (date < minDate) return 'Nieprawidłowa data';
  return null;
}

export function validateEmail(v) {
  if (!v) return null;
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(v) ? null : 'Nieprawidłowy email';
}

export function validatePhone(v, country = 'BY') {
  if (!v) return null;
  const digits = v.replace(/\D/g, '');
  const codeLen = country === 'BY' ? 3 : 1;
  const localDigits = digits.length - codeLen;
  const expected = country === 'BY' ? 9 : 10;
  if (localDigits === 0) return null;
  return localDigits === expected ? null : `Nieprawidłowy numer (${expected} cyfr)`;
}

export function validateAbout(v) {
  if (v && v.length > 1000) return 'Maksymalnie 1000 znaków';
  return null;
}
