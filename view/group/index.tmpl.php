<h1 class="page-header"><?php _('Modify Personel Groups'); ?></h1>

<?php if(count($this->errors)): ?>
    <div class="bg-danger">
        <ul>
            <?php foreach($this->errors as $error) echo "<li>$error</li>"; ?>
        </ul>
    </div>
<?php endif; ?>

<?php foreach($this->objs as $id => $obj): ?>
<p>
    <form class="form-inline" id="group-form-<?php echo $id ?>" action="<?php eUrl('group','index'); ?>" method="post">
        <div class="form-group">
            <label for="short_name"><?php _('Short Name'); ?></label>
            <input type="text" class="form-control" id="short_name" name="short_name" value="<?php echo $obj->short_name; ?>">
        </div>
        <div class="form-group">
            <label for="name"><?php _('Name'); ?></label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $obj->name; ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-primary"><?php _('Modify'); ?></button>
        <a class="btn btn-danger" href="<?php eUrl('group','delete',$id); ?>" role="button"
            onclick="return confirm('<?php _('Are you sure you want to delete this item'); ?> ?')">
            <?php _('Delete'); ?>
        </a>
    </form>
</p>
<?php endforeach; ?>

<p>
<form class="form-inline" id="group-form-new" action="<?php eUrl('group','index'); ?>" method="post">
    <div class="form-group">
        <label for="short_name"><?php _('Short Name'); ?></label>
        <input type="text" class="form-control" id="short_name" name="short_name" placeholder="<?php _('Short Name'); ?>">
    </div>
    <div class="form-group">
        <label for="name"><?php _('Name'); ?></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="<?php _('Name'); ?>">
    </div>
    <input type="hidden" name="id" value="">
    <button type="submit" class="btn btn-primary"><?php _('Add'); ?></button>
</form>
</p>
