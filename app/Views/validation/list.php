<?php
helper('html');

$session_errors = session('errors');
if ($session_errors) {
    if (isset($errors) && $errors != $session_errors)
        $errors = [...array_values($errors), ...array_values($session_errors)];
    else
        $errors = $session_errors;
} else {
    if (!isset($errors))
        $errors = [];
}
if ($errors !== []):
    $errors = count($errors) === 1 ? array_pop($errors) : $errors;
?>
	<div class="alert alert-danger" role="alert">
        <?= is_array($errors) ? ul($errors) : $errors; ?>
	</div>
<?php endif ?>
