<html lang="en">
<head>
    <meta name="encoding" charset="utf-8">
    <title>Task</title>
    <link rel="stylesheet" href="<?= asset('css/app.css'); ?>" type="text/css">
</head>

<body>
<div class="container">
    <h1>Create New User</h1>

    <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
    <?php endif; ?>

    <?php include dirname(__FILE__) . "/form.php"; ?>
    <?php include dirname(__FILE__) . "/preview.php"; ?>
</div>

<script src="<?= asset('js/app.js'); ?>"></script>
</body>
</html>