<h2><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>

<?php if (empty($entries)): ?>
  <p>No diary entries found.</p>
<?php else: ?>
  <ul>
    <?php foreach ($entries as $entry): ?>
      <li>
        <a href="/personal/diary/view?objid=<?= $entry['objid'] ?>">
          <?= htmlspecialchars($entry['objid'], ENT_QUOTES, 'UTF-8') ?>
        </a>
        |
        <a href="/personal/diary/edit?objid=<?= $entry['objid'] ?>">Edit</a>
        —
        <?= htmlspecialchars((string) ($entry['title'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
        —
        <?= htmlspecialchars((string) ($entry['keywords'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>