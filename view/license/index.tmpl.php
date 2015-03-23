<h1 class="page-header"><?php _('Modify Licenses'); ?></h1>

<?php if(count($this->errors)): ?>
    <div class="bg-danger">
        <ul>
            <?php foreach($this->errors as $error) echo "<li>$error</li>"; ?>
        </ul>
    </div>
<?php endif; ?>

<?php foreach($this->objs as $id => $obj): ?>
<p>
    <form class="form-inline" id="group-form-<?php echo $id ?>" action="<?php eUrl('license','index'); ?>" method="post">
        <div class="form-group">
            <label for="name"><?php _('Name'); ?></label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $obj->name; ?>">
        </div>
        <div class="form-group">
            <label for="description"><?php _('Description'); ?></label>
            <input type="text" class="form-control" id="description" name="description" value="<?php echo $obj->description; ?>">
        </div>
        <div class="checkbox">
            <label>
                <input name="trailer" value="1" type="checkbox" <?php if($obj->trailer){ echo 'checked="checked"'; } ?>> <?php _('Trailer'); ?>
            </label>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-primary"><?php _('Modify'); ?></button>
        <a class="btn btn-danger" href="<?php eUrl('license','delete',$id); ?>" role="button"
            onclick="return confirm('<?php _('Are you sure you want to delete this item'); ?> ?')">
            <?php _('Delete'); ?>
        </a>
    </form>
</p>
<?php endforeach; ?>

<p>
<form class="form-inline" id="group-form-new" action="<?php eUrl('license','index'); ?>" method="post">
    <div class="form-group">
        <label for="name"><?php _('Name'); ?></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="<?php _('Name'); ?>">
    </div>
    <div class="form-group">
        <label for="description"><?php _('Description'); ?></label>
        <input type="text" class="form-control" id="description" name="description" placeholder="<?php _('Description'); ?>">
    </div>
    <div class="checkbox">
        <label>
            <input name="trailer" value="1" type="checkbox"> <?php _('Trailer'); ?>
        </label>
    </div>
    <input type="hidden" name="id" value="">
    <button type="submit" class="btn btn-primary"><?php _('Add'); ?></button>
</form>
</p>
