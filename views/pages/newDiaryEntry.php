<h2>New Diary Entry</h2>

<?php if ($message !== null): ?>
  <div style="padding: 0.75rem 1rem; margin-bottom: 1rem; border: 1px solid #8bc48b; background: #e8f7e8;">
    <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
  </div>
<?php endif; ?>

<?php if ($error !== null): ?>
  <div style="padding: 0.75rem 1rem; margin-bottom: 1rem; border: 1px solid #d88; background: #fdeaea;">
    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
  </div>
<?php endif; ?>

<form method="post" action="">
  <div style="margin-bottom: 1rem;">
    <label for="title" style="display:block; font-weight:bold; margin-bottom:0.35rem;">Title</label>
    <input
      type="text"
      id="title"
      name="title"
      maxlength="255"
      value="<?= htmlspecialchars($formData['title'], ENT_QUOTES, 'UTF-8') ?>"
      style="width:100%; padding:0.6rem; box-sizing:border-box;"
    >
  </div>

  <div style="margin-bottom: 1rem;">
    <label for="keywords" style="display:block; font-weight:bold; margin-bottom:0.35rem;">Keywords</label>
    <input
      type="text"
      id="keywords"
      name="keywords"
      maxlength="255"
      required
      value="<?= htmlspecialchars($formData['keywords'], ENT_QUOTES, 'UTF-8') ?>"
      style="width:100%; padding:0.6rem; box-sizing:border-box;"
    >
  </div>

  <div style="margin-bottom: 1rem;">
    <label for="full_text" style="display:block; font-weight:bold; margin-bottom:0.35rem;">Full Text</label>
    <textarea
      id="full_text"
      name="full_text"
      style="width:100%; min-height:140px; padding:0.6rem; box-sizing:border-box; resize:vertical;"
    ><?= htmlspecialchars($formData['full_text'], ENT_QUOTES, 'UTF-8') ?></textarea>
  </div>

  <div style="margin-bottom: 1rem;">
    <label for="note" style="display:block; font-weight:bold; margin-bottom:0.35rem;">Note</label>
    <textarea
      id="note"
      name="note"
      style="width:100%; min-height:140px; padding:0.6rem; box-sizing:border-box; resize:vertical;"
    ><?= htmlspecialchars($formData['note'], ENT_QUOTES, 'UTF-8') ?></textarea>
  </div>

  <button type="submit" style="padding:0.7rem 1.2rem; cursor:pointer;">
    Save Entry
  </button>
</form>