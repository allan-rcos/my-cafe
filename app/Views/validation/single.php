<?php
$session_error = session('error');
if (!isset($error))
    $error = null;
if ($session_error)
    if (!$error)
        $error = $session_error;
?>

<?php if (isset($error)): ?>
    <div class="alert alert-danger" role="alert"><?= esc($error) ?></div>
<?php endif; ?>