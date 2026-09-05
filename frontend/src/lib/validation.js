export function validateFirstName(v) {
  if (!v || !v.trim()) return 'Обязательное поле';
  if (v.length > 50) return 'Максимум 50 символов';
  return null;
}

export function validateLastName(v) {
  if (!v || !v.trim()) return 'Обязательное поле';
  if (v.length > 50) return 'Максимум 50 символов';
  return null;
}

export function validateMiddleName(v) {
  if (v && v.length > 50) return 'Максимум 50 символов';
  return null;
}

export function validateBirthDate(v) {
  if (!v) return 'Обязательное поле';
  const date = new Date(v);
  if (isNaN(date.getTime())) return 'Некорректная дата';
  if (date > new Date()) return 'Дата не может быть в будущем';
  const minDate = new Date();
  minDate.setFullYear(minDate.getFullYear() - 120);
  if (date < minDate) return 'Некорректная дата';
  return null;
}

export function validateEmail(v) {
  if (!v) return null;
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(v) ? null : 'Некорректный email';
}

export function validatePhone(v) {
  if (!v) return null;
  const digits = v.replace(/\D/g, '');
  return digits.length >= 9 ? null : 'Некорректный номер';
}

export function validateAbout(v) {
  if (v && v.length > 1000) return 'Максимум 1000 символов';
  return null;
}
