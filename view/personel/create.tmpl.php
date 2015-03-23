<h1 class="page-header"><?php _('New Personel'); ?></h1>

<form action="<?php eUrl('personel','create'); ?>" method="post">

    <?php if(count($this->errors)): ?>
        <div class="">
            <ul>
                <?php foreach($this->errors as $error) echo "<li>$error</li>"; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <label for="rank_id"><?php _('Rank'); ?></label>
        <select id="rank_id" name="rank_id" class="form-control">
            <?php foreach($this->ranks as $rank): ?>
                <option value="<?php echo $rank->id; ?>"><?php echo $rank->name; ?> (<?php echo $rank->short_name; ?>)</option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="name"><?php _('Name'); ?></label>
        <input name="name" type="text" class="form-control" id="name" placeholder="<?php _('Enter Name'); ?>">
    </div>
    <div class="form-group">
        <label for="group_id"><?php _('Personel Group'); ?></label>
        <select id="group_id" name="group_id" class="form-control">
            <?php foreach($this->groups as $id => $group): ?>
                <option value="<?php echo $id; ?>"><?php echo $group->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="tel"><?php _('Tel'); ?></label>
        <input name="tel" type="text" class="form-control" id="tel" placeholder="<?php _('Tel'); ?>">
    </div>
    <div class="form-group">
        <label for="vehicle_licences_id"><?php _('License'); ?></label>
        <select id="vehicle_licences_id" name="vehicle_licences_id[]" class="form-control" multiple="multiple">
            <?php foreach($this->vehicle_licenses as $id => $license): ?>
                <option value="<?php echo $id; ?>"><?php echo $license->getFullName(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="trailer_licences_id"><?php _('Trailer License'); ?></label>
        <select id="trailer_licences_id" name="trailer_licences_id[]" class="form-control" multiple="multiple">
            <?php foreach($this->trailer_licenses as $id => $license): ?>
                <option value="<?php echo $id; ?>"><?php echo $license->getFullName(); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="personel_checks_id"><?php _('Personel Checks'); ?></label>
        <select id="personel_checks_id" name="personel_checks_id[]" class="form-control" multiple="multiple">
            <?php foreach($this->checks as $id => $check): ?>
                <option value="<?php echo $id; ?>"><?php echo $check->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="discharged"><?php _('Discharged'); ?></label>
        <input name="discharged" type="datetime" class="form-control" id="discharged" value="<?php ePost('discharged',''); ?>">
        <script type="text/javascript">jQuery('#discharged').datetimepicker();</script>
    </div>


    <div class="text-right">
        <a class="btn btn-default" href="<?php eUrl('personel','index'); ?>" role="button"><?php _('Cancel'); ?></a>
        <button type="submit" class="btn btn-primary"><?php _('Create'); ?></button>
    </div>
</form>