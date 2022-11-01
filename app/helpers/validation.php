<?php

function validateLoginInput(array &$data, Users $users): void {
    // Sanitize input
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $data = [
        'email' => trim($_POST['email']),
        'pass' => sha1(trim($_POST['pass'])),
    ];

    // Check email errors
    if (empty($data['email'])) {
        $data['email_err'] = 'Please, enter your email';
    }
    // Validate password
    if (empty($data['pass'])) {
        $data['pass_err'] = 'Please, enter your password';
    }

    $emailExists = $users->getUserModel()->emailExists($data['email']);
    $correctPassword = $users->getUserModel()->correctPassword($data['email'], $data['pass']);

    if (!$emailExists) {
        $data['email_err'] = 'User with this email does not exist';
        $data['email'] = '';
    } else if (!$correctPassword) {
        $data['pass_err'] = 'Incorrect password';
        echo "<audio autoplay='true' style='display:none;'>
                <source src='" . URL_ROOT . "/audio/reminder.mp3" . "' type='audio/mpeg'>
              </audio>";
    }
}

function validUser(array $data): bool {
    return empty($data['email_err']) and
        empty($data['pass_err']);
}

function validateRegisterInput(array &$data, Users $users): void {
    // Sanitize input
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $data = [
        'first_name' => trim($_POST['first_name']),
        'last_name' => trim($_POST['last_name']),
        'email' => trim($_POST['email']),
        'pass' => trim($_POST['pass']),
        'pass_repeat' => trim($_POST['pass_repeat']),
    ];

    // Check email errors
    if (empty($data['email'])) {
        $data['email_err'] = 'Please, enter your email';
    } else if ($users->getUserModel()->emailExists($data['email'])) {
        $data['email_err'] = 'Email is already taken';
    }

    // Validate first name
    if (empty($data['first_name'])) {
        $data['fname_err'] = 'Please, enter your first name';
    }

    // Validate last name
    if (empty($data['last_name'])) {
        $data['lname_err'] = 'Please, enter your last name';
    }

    // Validate password
    if (empty($data['pass'])) {
        $data['pass_err'] = 'Please, enter your password';
    } else if (strlen($data['pass']) < 8) {
        $data['pass_err'] = 'Password must be at least 8 characters';
    }

    // Validate repeat password
    if (empty($data['pass_repeat'])) {
        $data['pass_repeat_err'] = 'Please, confirm your password';
    } else if ($data['pass'] != $data['pass_repeat']) {
        $data['pass_repeat_err'] = 'Passwords do not match';
    }
}

function validRegisterInput(array $data): bool {
    return empty($data['email_err']) and
        empty($data['fname_err']) and
        empty($data['lname_err']) and
        empty($data['pass_err']) and
        empty($data['pass_repeat_err']);
}
