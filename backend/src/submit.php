<?php

require_once __DIR__ . '/db.php';

header('Content-Type: application/json; charset=utf-8');
$corsOrigin = getenv('CORS_ORIGIN') ?: '*';
header("Access-Control-Allow-Origin: $corsOrigin"); 
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if ($data === null) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}


function fail(array $errors, array $data): void
{
    http_response_code(422);
    echo json_encode([
        'errors' => $errors,
        'submitted' => $data, 
    ]);
    exit;
}

$errors = [];

$firstName = trim($data['firstName'] ?? '');
if ($firstName === '') {
    $errors['firstName'] = 'Pole wymagane';
} elseif (mb_strlen($firstName) > 50) {
    $errors['firstName'] = 'Maksymalnie 50 znaków';
}

$lastName = trim($data['lastName'] ?? '');
if ($lastName === '') {
    $errors['lastName'] = 'Pole wymagane';
} elseif (mb_strlen($lastName) > 50) {
    $errors['lastName'] = 'Maksymalnie 50 znaków';
}

$middleName = trim($data['middleName'] ?? '');
if ($middleName !== '' && mb_strlen($middleName) > 50) {
    $errors['middleName'] = 'Maksymalnie 50 znaków';
}

$birthDate = $data['birthDate'] ?? '';
$birthDateObj = DateTime::createFromFormat('Y-m-d', $birthDate);
if (!$birthDateObj) {
    $errors['birthDate'] = 'Pole wymagane';
} else {
    $today = new DateTime();
    $minDate = (new DateTime())->modify('-120 years');
    if ($birthDateObj > $today) {
        $errors['birthDate'] = 'Data nie może być w przyszłości';
    } elseif ($birthDateObj < $minDate) {
        $errors['birthDate'] = 'Nieprawidłowa data';
    }
}

$email = trim($data['email'] ?? '');
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Nieprawidłowy email';
}

$maritalStatus = trim($data['maritalStatus'] ?? '');
$allowedStatuses = ['Samotny/niezamężny', 'Żonaty', 'Rozwiedziony', 'Wdowiec/wdowa'];
if (!in_array($maritalStatus, $allowedStatuses, true)) {
    $errors['maritalStatus'] = 'Wybierz stan cywilny';
}

$about = trim($data['about'] ?? '');
if (mb_strlen($about) > 1000) {
    $errors['about'] = 'Maksymalnie 1000 znaków';
}

$rulesAccepted = (bool) ($data['rulesAccepted'] ?? false);
if (!$rulesAccepted) {
    $errors['rules'] = 'Zaakceptuj zasady';
}

$phones = $data['phones'] ?? [];
if (!is_array($phones)) {
    $phones = [];
}
if (count($phones) > 5) {
    $errors['phones'] = 'Maksymalnie 5 telefonów';
}

$validPhones = [];
$phoneIndex = 0;
foreach ($phones as $p) {
    $phoneValue = trim($p['phone'] ?? '');
    $countryCode = $p['country'] ?? '';
    if ($phoneValue === '') {
        $phoneIndex++;
        continue;
    }
    if (!in_array($countryCode, ['BY', 'RU'], true)) {
        $errors["phones[$phoneIndex]"] = 'Nieprawidłowy kod kraju';
        $phoneIndex++;
        continue;
    }
    $digits = preg_replace('/\D/', '', $phoneValue);
    if (strlen($digits) < 9) {
        $errors["phones[$phoneIndex]"] = 'Nieprawidłowy numer telefonu';
        $phoneIndex++;
        continue;
    }
    $validPhones[] = ['country' => $countryCode, 'phone' => $phoneValue];
    $phoneIndex++;
}

if ($email === '' && count($validPhones) === 0) {
    $errors['contact'] = 'Podaj email lub telefon';
}

if (!empty($errors)) {
    fail($errors, $data);
}

try {
    $pdo = getDbConnection();
    $pdo->beginTransaction();

    $stmt = $pdo->prepare(
        'INSERT INTO applications (first_name, last_name, middle_name, birth_date, email, marital_status, about, rules_accepted)
         VALUES (:first_name, :last_name, :middle_name, :birth_date, :email, :marital_status, :about, :rules_accepted)
         RETURNING id'
    );
    $stmt->execute([
        'first_name' => $firstName,
        'last_name' => $lastName,
        'middle_name' => $middleName !== '' ? $middleName : null,
        'birth_date' => $birthDate,
        'email' => $email !== '' ? $email : null,
        'marital_status' => $maritalStatus,
        'about' => $about !== '' ? $about : null,
        'rules_accepted' => $rulesAccepted,
    ]);
    $applicationId = $stmt->fetchColumn();

    if (!empty($validPhones)) {
        $phoneStmt = $pdo->prepare(
            'INSERT INTO phones (application_id, country_code, phone) VALUES (:application_id, :country_code, :phone)'
        );
        foreach ($validPhones as $p) {
            $phoneStmt->execute([
                'application_id' => $applicationId,
                'country_code' => $p['country'],
                'phone' => $p['phone'],
            ]);
        }
    }

    $pdo->commit();

    echo json_encode(['success' => true, 'id' => $applicationId]);
} catch (Throwable $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    http_response_code(500);
    echo json_encode(['error' => 'Server error, please try again', 'submitted' => $data]);
}
