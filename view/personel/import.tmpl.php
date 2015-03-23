<h1 class="page-header"><?php _('Import Personel'); ?></h1>

<div>
    <a class="btn btn-default" href="<?php eUrl('personel','index'); ?>" role="button"><?php _('Back to Personel'); ?></a>
</div>

<br />
<?php if(!$this->file): ?>

    <form action="<?php eUrl('personel','import'); ?>" method="post" enctype="multipart/form-data">

        <?php if(count($this->errors)): ?>
            <div class="">
                <ul>
                    <?php foreach($this->errors as $error) echo "<li>$error</li>"; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label for="import_file"><?php _('File input'); ?></label>
            <input type="file" id="import_file" name="import_file">
            <p class="help-block">Fichier au format CSV.</p>
        </div>

        <div class="text-right">
            <a class="btn btn-default" href="<?php eUrl('personel','index'); ?>" role="button"><?php _('Cancel'); ?></a>
            <button type="submit" class="btn btn-primary"><?php _('Import'); ?></button>
        </div>
    </form>

<?php else: ?>

    <h2><?php echo basename($this->file); ?></h2>
    <ul>
        <?php foreach($this->lines as $line): ?>
        <li><?php echo $line; ?></li>
        <?php endforeach; ?>
    </ul>

    <div class="text-right">
        <a class="btn btn-default" href="<?php eUrl('personel','import'); ?>" role="button"><?php _('New import'); ?></a>
    </div>

<?php endif; ?>