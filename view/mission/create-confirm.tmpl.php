<div class="">
    <dl class="dl-horizontal">
        <dt><?php _('Start'); ?></dt>
        <dd><?php ePost('start','error'); ?></dd>
        <dt><?php _('End'); ?></dt>
        <dd><?php ePost('end','error'); ?></dd>
        <dt><?php _('Vehicle'); ?></dt>
        <dd><?php echo ($this->vehicle) ? $this->vehicle->getFullName() : _('none'); ?></dd>
        <dt><?php _('Personel'); ?></dt>
        <dd><?php echo ($this->personel) ? $this->personel->getFullName() : _('none'); ?></dd>
        <dt><?php _('Load'); ?></dt>
        <dd><?php ePost('load',''); ?></dd>
        <dt><?php _('Origin'); ?></dt>
        <dd><?php ePost('origin',''); ?></dd>
        <dt><?php _('Destination'); ?></dt>
        <dd><?php ePost('destination',''); ?></dd>
        <dt><?php _('Contact Name'); ?></dt>
        <dd><?php ePost('contact_name',''); ?></dd>
        <dt><?php _('Contact Tel'); ?></dt>
        <dd><?php ePost('contact_tel',''); ?></dd>
        <dt><?php _('Summary'); ?></dt>
        <dd><?php ePost('summary',''); ?></dd>
        <dt><?php _('Description'); ?></dt>
        <dd><?php echo nl2br(rPost('description','')); ?></dd>
    </dl>
</div>

<form action="<?php eUrl('mission','create'); ?>" method="post">

    <?php if(count($this->errors)): ?>
        <div class="">
            <ul>
                <?php foreach($this->errors as $error) echo "<li>$error</li>"; ?>
            </ul>
        </div>
    <?php endif; ?>

    <input name="start" type="hidden" id="start" value="<?php ePost('start',dt(time())); ?>">
    <input name="end" type="hidden" id="end" value="<?php ePost('end',dt(strtotime('+1 hour'))); ?>">
    <input name="vehicle_id" type="hidden" id="vehicle_id" value="<?php ePost('vehicle_id',''); ?>">
    <input name="personel_id" type="hidden" id="personel_id" value="<?php ePost('personel_id',''); ?>">
    <input name="summary" type="hidden" id="summary" value="<?php ePost('summary',''); ?>">
    <textarea name="description" class="hidden" id="description" ><?php ePost('description',''); ?></textarea>

    <input name="step" type="hidden" id="step" value="confirm">

    <div class="text-right">
        <a class="btn btn-default" href="<?php eUrl('mission','index'); ?>" role="button"><?php _('Cancel'); ?></a>
        <a class="btn btn-default" href="<?php eUrl('mission','create'); ?>" role="button"><?php _('Reset'); ?></a>
        <button type="submit" class="btn btn-primary"><?php _('Create'); ?></button>
    </div>
</form>