
<form action="<?php eUrl('mission','create'); ?>" method="post">

    <?php if(count($this->errors)): ?>
        <div class="">
            <ul>
                <?php foreach($this->errors as $error) echo "<li>$error</li>"; ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <label for="start"><?php _('Start'); ?></label>
        <input name="start" type="datetime" class="form-control" id="start" value="<?php ePost('start',dt(time())); ?>">
        <script type="text/javascript">jQuery('#start').datetimepicker();</script>
    </div>
    <div class="form-group">
        <label for="end"><?php _('End'); ?></label>
        <input name="end" type="datetime" class="form-control" id="end" value="<?php ePost('end',dt(strtotime('+1 hour'))); ?>">
        <script type="text/javascript">jQuery('#end').datetimepicker();</script>
    </div>
    <div class="form-group">
        <label for="load"><?php _('Load'); ?></label>
        <input name="load" type="text" class="form-control" id="load" placeholder="<?php _('Enter passenger or material'); ?>" value="<?php ePost('load',''); ?>">
    </div>
    <div class="form-group">
        <label for="origin"><?php _('Origin'); ?></label>
        <input name="origin" type="text" class="form-control" id="origin" placeholder="<?php _('Enter point of origin'); ?>" value="<?php ePost('origin',''); ?>">
    </div>
    <div class="form-group">
        <label for="destination"><?php _('Destination'); ?></label>
        <input name="destination" type="text" class="form-control" id="destination" placeholder="<?php _('Enter point of arrival'); ?>" value="<?php ePost('destination',''); ?>">
    </div>
    <div class="form-group">
        <label for="contact_name"><?php _('Contact Name'); ?></label>
        <input name="contact_name" type="text" class="form-control" id="contact_name" placeholder="<?php _('Enter name of contact'); ?>" value="<?php ePost('contact_name',''); ?>">
    </div>
    <div class="form-group">
        <label for="contact_tel"><?php _('Contact Tel'); ?></label>
        <input name="contact_tel" type="text" class="form-control" id="contact_tel" placeholder="<?php _('Enter phone number of contact'); ?>" value="<?php ePost('contact_tel',''); ?>">
    </div>
    <div class="form-group">
        <label for="summary"><?php _('Summary'); ?></label>
        <input name="summary" type="text" class="form-control" id="summary" placeholder="<?php _('Enter short summary'); ?>" value="<?php ePost('summary',''); ?>">
    </div>
    <div class="form-group">
        <label for="description"><?php _('Description'); ?></label>
        <textarea name="description" class="form-control" id="description" placeholder="<?php _('Enter fulll description'); ?>"><?php ePost('description',''); ?></textarea>
    </div>

    <input name="vehicle_id" type="hidden" id="vehicle_id" value="<?php ePost('vehicle_id',''); ?>">
    <input name="personel_id" type="hidden" id="personel_id" value="<?php ePost('personel_id',''); ?>">
    <input name="step" type="hidden" id="step" value="start">

    <div class="text-right">
        <a class="btn btn-default" href="<?php eUrl('mission','index'); ?>" role="button"><?php _('Cancel'); ?></a>
        <button type="submit" class="btn btn-primary"><?php _('Continue'); ?></button>
    </div>
</form>