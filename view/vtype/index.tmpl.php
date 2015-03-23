<h1 class="page-header"><?php _('Modify Vehicle Types'); ?></h1>

<?php if(count($this->errors)): ?>
    <div class="bg-danger">
        <ul>
            <?php foreach($this->errors as $error) echo "<li>$error</li>"; ?>
        </ul>
    </div>
<?php endif; ?>

<?php foreach($this->objs as $id => $obj): ?>
<p>
    <form class="form-inline" id="group-form-<?php echo $id ?>" action="<?php eUrl('vtype','index'); ?>" method="post">
        <div class="form-group">
            <label for="name"><?php _('Name'); ?></label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $obj->name; ?>">
        </div>
        <div class="form-group">
            <label for="license_id"><?php _('License'); ?></label>
            <select id="license_id" name="license_id" class="form-control">
                <option value=""></option>
                <?php foreach($this->vehicle_licenses as $lid => $license): ?>
                    <option <?php echo ($obj->license_id == $lid)?'selected="selected"':'' ?> value="<?php echo $lid; ?>"><?php echo $license->getFullName(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="license_trailer_id"><?php _('Trailer License'); ?></label>
            <select id="license_trailer_id" name="license_trailer_id" class="form-control">
                <option value=""></option>
                <?php foreach($this->trailer_licenses as $lid => $license): ?>
                    <option <?php echo ($obj->license_trailer_id == $lid)?'selected="selected"':'' ?> value="<?php echo $lid; ?>"><?php echo $license->getFullName(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-primary"><?php _('Modify'); ?></button>
        <a class="btn btn-danger" href="<?php eUrl('vtype','delete',$id); ?>" role="button"
            onclick="return confirm('<?php _('Are you sure you want to delete this item'); ?> ?')">
            <?php _('Delete'); ?>
        </a>
    </form>
</p>
<?php endforeach; ?>

<p>
<form class="form-inline" id="group-form-new" action="<?php eUrl('vtype','index'); ?>" method="post">
    <div class="form-group">
        <label for="name"><?php _('Name'); ?></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="<?php _('Name'); ?>">
    </div>
    <div class="form-group">
        <label for="license_id"><?php _('License'); ?></label>
        <select id="license_id" name="license_id" class="form-control">
            <option value=""></option>
            <?php foreach($this->vehicle_licenses as $lid => $license): ?>
                <option value="<?php echo $lid; ?>"><?php echo $license->getFullName(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="license_trailer_id"><?php _('Trailer License'); ?></label>
        <select id="license_trailer_id" name="license_trailer_id" class="form-control">
            <option value=""></option>
            <?php foreach($this->trailer_licenses as $lid => $license): ?>
                <option value="<?php echo $lid; ?>"><?php echo $license->getFullName(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="hidden" name="id" value="">
    <button type="submit" class="btn btn-primary"><?php _('Add'); ?></button>
</form>
</p>
