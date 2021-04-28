  <header>
  <?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])) : ?>
                    <?php foreach ($_SESSION['messages'] as $type => $messages) : ?>
                        <?php foreach ($messages as $message) : ?>
                            <div class="alert alert-<?= $type ?>"><?= $message ?></div>
                            <?php ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <?php unset($_SESSION['messages']); ?>
                <?php endif; ?>
</header>