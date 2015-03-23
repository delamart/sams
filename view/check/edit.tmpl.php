<h1 class="page-header"><?php _('Modify Personel Check Types'); ?></h1>

<div>
    <a class="btn btn-default" href="<?php eUrl('check','index'); ?>" role="button"><?php _('Back to Checks'); ?></a>
</div>

<?php if(count($this->errors)): ?>
    <div class="bg-danger">
        <ul>
            <?php foreach($this->errors as $error) echo "<li>$error</li>"; ?>
        </ul>
    </div>
<?php endif; ?>

<?php foreach($this->checks as $id => $check): ?>
<p>
    <form class="form-inline" id="check-form-<?php echo $id ?>" action="<?php eUrl('check','edit'); ?>" method="post">
        <div class="form-group">
            <label for="name"><?php _('Name'); ?></label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $check->name; ?>">
        </div>
        <div class="form-group">
            <label for="description"><?php _('Description'); ?></label>
            <input type="text" class="form-control" id="description" name="description" value="<?php echo $check->description; ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-primary"><?php _('Modify'); ?></button>
        <a class="btn btn-danger" href="<?php eUrl('check','delete',$id); ?>" role="button"
            onclick="return confirm('<?php _('Are you sure you want to delete this item'); ?> ?')">
            <?php _('Delete'); ?>
        </a>
    </form>
</p>
<?php endforeach; ?>

<p>
<form class="form-inline" id="check-form-new" action="<?php eUrl('check','edit'); ?>" method="post">
    <div class="form-group">
        <label for="name"><?php _('Name'); ?></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="<?php _('Type Name'); ?>">
    </div>
    <div class="form-group">
        <label for="description"><?php _('Description'); ?></label>
        <input type="text" class="form-control" id="description" name="description" placeholder="<?php _('Type Description'); ?>">
    </div>
    <input type="hidden" name="id" value="">
    <button type="submit" class="btn btn-primary"><?php _('Add'); ?></button>
</form>
</p>
