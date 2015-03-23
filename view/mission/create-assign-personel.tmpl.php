<div class="">
    <dl class="dl-horizontal">
        <dt><?php _('Start'); ?></dt>
        <dd><?php ePost('start','error'); ?></dd>
        <dt><?php _('End'); ?></dt>
        <dd><?php ePost('end','error'); ?></dd>
        <dt><?php _('Vehicle'); ?></dt>
        <dd><?php echo ($this->vehicle) ? $this->vehicle->getFullName() : _('none'); ?></dd>
        <dt><?php _('Summary'); ?></dt>
        <dd><?php ePost('summary',''); ?></dd>
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

    <table id="assign-personel-table" class="table table-striped">
        <thead>
        <tr>
            <th></th>
            <th><?php _('Rank'); ?></th>
            <th><?php _('Name'); ?></th>
            <th><?php _('Personel Group'); ?></th>
            <th><?php _('Mission'); ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><input type="radio" name="personel_id" <?php echo (rPost('personel_id','') == '')?'checked="checked"':'' ?>
                       value=""></td>
            <td><?php _('none'); ?></td>
            <td><?php _('none'); ?></td>
            <td><?php _('none'); ?></td>
            <td><?php _('none'); ?></td>
        </tr>
        <?php foreach($this->personels as $id => $personel): ?>
            <tr>
                <td><input type="radio" name="personel_id" <?php echo (rPost('personel_id','') == $id)?'checked="checked"':'' ?>
                           value="<?php echo $id; ?>"></td>
                <td><?php echo $personel->getRankName(); ?></td>
                <td><?php echo $personel->name; ?></td>
                <td><?php echo $personel->getPersonelgroupShort(); ?></td>
                <td><?php echo $personel->getMissionHTML(); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#assign-personel-table').dataTable();
        } );
    </script>

    <input name="vehicle_id" type="hidden" id="vehicle_id" value="<?php ePost('vehicle_id',''); ?>">
    <input name="load" type="hidden" id="load" value="<?php ePost('load',''); ?>">
    <input name="origin" type="hidden" id="origin" value="<?php ePost('origin',''); ?>">
    <input name="destination" type="hidden" id="destination" value="<?php ePost('destination',''); ?>">
    <input name="contact_name" type="hidden" id="contact_name" value="<?php ePost('contact_name',''); ?>">
    <input name="contact_tel" type="hidden" id="contact_tel" value="<?php ePost('contact_tel',''); ?>">
    <input name="summary" type="hidden" id="summary" value="<?php ePost('summary',''); ?>">
    <textarea name="description" class="hidden" id="description" ><?php ePost('description',''); ?></textarea>

    <input name="step" type="hidden" id="step" value="assign-personel">

    <div class="text-right">
        <a class="btn btn-default" href="<?php eUrl('mission','index'); ?>" role="button"><?php _('Cancel'); ?></a>
        <a class="btn btn-default" href="<?php eUrl('mission','create'); ?>" role="button"><?php _('Reset'); ?></a>
        <button type="submit" class="btn btn-primary"><?php _('Continue'); ?></button>
    </div>
</form>