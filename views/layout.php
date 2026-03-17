<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($title ?? 'Untitled', ENT_QUOTES, 'UTF-8') ?></title>
</head>
<body>
  <?php require __DIR__ . '/partials/nav.php'; ?>
  <header>
    <h1>My Site</h1>
  </header>

  <main>
    <?php require $contentView; ?>
  </main>

  <footer>
    <small>Footer content</small>
  </footer>
</body>
</html>