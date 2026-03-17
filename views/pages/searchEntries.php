<h2><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>

<form method="get" action="/personal/diary/search">
  <div>
    <label for="keyword">Keyword</label>
    <input
      type="text"
      id="keyword"
      name="keyword"
      value="<?= htmlspecialchars($keyword ?? '', ENT_QUOTES, 'UTF-8') ?>"
    >
    <button type="submit">Search</button>
  </div>
</form>

<?php if (($keyword ?? '') !== ''): ?>
  <h3>Results for: <?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8') ?></h3>

  <?php if (empty($entries)): ?>
    <p>No matching diary entries found.</p>
  <?php else: ?>
    <ul>
      <?php foreach ($entries as $entry): ?>
        <li>
          <a href="/personal/diary/view?objid=<?= urlencode((string) $entry['objid']) ?>">
            <strong>#<?= htmlspecialchars((string) $entry['objid'], ENT_QUOTES, 'UTF-8') ?></strong>
          </a>
          |
          <a href="/personal/diary/edit?objid=<?= urlencode((string) $entry['objid']) ?>">
            Edit
          </a>
          —
          <?= htmlspecialchars((string) ($entry['title'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
          —
          <?= htmlspecialchars((string) ($entry['keywords'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
<?php endif; ?>