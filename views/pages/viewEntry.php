<h2><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>

<?php if (($objid ?? 0) <= 0): ?>
  <p>No entry id was provided.</p>
<?php elseif ($entry === false): ?>
  <p>No diary entry was found for objid <?= htmlspecialchars((string) $objid, ENT_QUOTES, 'UTF-8') ?>.</p>
<?php else: ?>
  <p>
    <a href="/personal/diary/edit?objid=<?= $objid ?>">Edit Entry</a>
  </p>
  <dl>
    <dt>Objid</dt>
    <dd><?= htmlspecialchars((string) ($entry['objid'] ?? ''), ENT_QUOTES, 'UTF-8') ?></dd>

    <dt>Entry Date</dt>
    <dd><?= htmlspecialchars((string) ($entry['entry_date'] ?? ''), ENT_QUOTES, 'UTF-8') ?></dd>

    <dt>Title</dt>
    <dd><?= htmlspecialchars((string) ($entry['title'] ?? ''), ENT_QUOTES, 'UTF-8') ?></dd>

    <dt>Keywords</dt>
    <dd><?= htmlspecialchars((string) ($entry['keywords'] ?? ''), ENT_QUOTES, 'UTF-8') ?></dd>

    <dt>Full Text</dt>
    <dd><?= nl2br(htmlspecialchars((string) ($entry['full_text'] ?? ''), ENT_QUOTES, 'UTF-8')) ?></dd>

    <dt>Note</dt>
    <dd><?= nl2br(htmlspecialchars((string) ($entry['note'] ?? ''), ENT_QUOTES, 'UTF-8')) ?></dd>
  </dl>
<?php endif; ?>
