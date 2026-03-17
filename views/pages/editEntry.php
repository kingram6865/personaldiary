<h2><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>

<?php if (($message ?? null) !== null): ?>
  <div>
    <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
  </div>
<?php endif; ?>

<?php if (($error ?? null) !== null): ?>
  <div>
    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
  </div>
<?php endif; ?>

<?php if (($objid ?? 0) <= 0): ?>
  <p>No entry id was provided.</p>
<?php elseif ($entry === false): ?>
  <p>No diary entry was found for objid <?= htmlspecialchars((string) $objid, ENT_QUOTES, 'UTF-8') ?>.</p>
<?php else: ?>
  <form method="post" action="/personal/diary/edit?objid=<?= urlencode((string) $objid) ?>">
    <div>
      <label for="title">Title</label>
      <input
        type="text"
        id="title"
        name="title"
        maxlength="255"
        value="<?= htmlspecialchars($formData['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
      >
    </div>

    <div>
      <label for="keywords">Keywords</label>
      <input
        type="text"
        id="keywords"
        name="keywords"
        maxlength="255"
        required
        value="<?= htmlspecialchars($formData['keywords'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
      >
    </div>

    <div>
      <label for="full_text">Full Text</label>
      <textarea id="full_text" name="full_text"><?= htmlspecialchars($formData['full_text'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
    </div>

    <div>
      <label for="note">Note</label>
      <textarea id="note" name="note"><?= htmlspecialchars($formData['note'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
    </div>

    <button type="submit">Save Changes</button>
  </form>
<?php endif; ?>