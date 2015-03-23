<div class="form-group">
    <label for="license_id"><?php _('License'); ?></label>
    <select id="license_id" name="license_id" class="form-control">
        <?php foreach($this->vehicle_licenses as $id => $license): ?>
            <option <?php echo ($this->vehicle->license_id == $id)?'selected="selected"':'' ?> value="<?php echo $id; ?>"><?php echo $license->getFullName(); ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <label for="license_trailer_id"><?php _('Trailer License'); ?></label>
    <select id="license_trailer_id" name="license_trailer_id" class="form-control">
        <?php foreach($this->trailer_licenses as $id => $license): ?>
            <option <?php echo ($this->vehicle->license_trailer_id == $id)?'selected="selected"':'' ?> value="<?php echo $id; ?>"><?php echo $license->getFullName(); ?></option>
        <?php endforeach; ?>
    </select>
</div>
