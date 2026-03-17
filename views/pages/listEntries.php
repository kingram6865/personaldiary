<h2><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>

<?php if (empty($entries)): ?>
  <p>No diary entries found.</p>
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