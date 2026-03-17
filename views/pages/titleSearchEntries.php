<h2><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>

<form method="get" action="/personal/diary/title-search">
  <div>
    <label for="title">Partial Title</label>
    <input
      type="text"
      id="title"
      name="title"
      value="<?= htmlspecialchars($titleQuery ?? '', ENT_QUOTES, 'UTF-8') ?>"
    >
    <button type="submit">Search</button>
  </div>
</form>

<?php if (($titleQuery ?? '') !== ''): ?>
  <h3>Results for title containing: <?= htmlspecialchars($titleQuery, ENT_QUOTES, 'UTF-8') ?></h3>

  <?php if (empty($entries)): ?>
    <p>No matching diary entries found.</p>
  <?php else: ?>
    <ul>
      <?php foreach ($entries as $entry): ?>
        <li>
          <strong>#<?= htmlspecialchars((string) $entry['objid'], ENT_QUOTES, 'UTF-8') ?></strong>
          —
          <?= htmlspecialchars((string) ($entry['title'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
          —
          <?= htmlspecialchars((string) ($entry['keywords'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
<?php endif; ?>