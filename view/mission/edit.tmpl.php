<h1 class="page-header"><?php _('Edit'); ?> <em><?php echo $this->mission->summary; ?></em></h1>

<form action="<?php eUrl('mission','edit',$this->mission->id); ?>" method="post">

    <?php if(count($this->errors)): ?>
        <div class="">
            <ul>
                <?php foreach($this->errors as $error) echo "<li>$error</li>"; ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <label for="start"><?php _('Start'); ?></label>
        <input name="start" type="datetime" class="form-control" id="start" value="<?php ePost('start',dt($this->mission->start)); ?>">
        <script type="text/javascript">jQuery('#start').datetimepicker();</script>
    </div>
    <div class="form-group">
        <label for="end"><?php _('End'); ?></label>
        <input name="end" type="datetime" class="form-control" id="end" value="<?php ePost('end',dt($this->mission->end)); ?>">
        <script type="text/javascript">jQuery('#end').datetimepicker();</script>
    </div>

    <div class="form-group">
        <label for="vehicle_id"><?php _('Vehicle'); ?></label>
        <select id="vehicle_id" name="vehicle_id" class="form-control">
            <?php foreach($this->vehicles as $id => $vehicle): ?>
                <option <?php echo (rPost('vehicle_id',$this->mission->vehicle_id) == $id)?'selected="selected"':'' ?>
                    value="<?php echo $id; ?>">
                    <?php echo $vehicle->getFullName(); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="personel_id"><?php _('Personel'); ?></label>
        <select id="personel_id" name="personel_id" class="form-control">
            <?php foreach($this->personels as $id => $personel): ?>
                <option <?php echo (rPost('personel_id',$this->mission->personel_id) == $id)?'selected="selected"':'' ?>
                    value="<?php echo $id; ?>">
                    <?php echo $personel->getFullName(); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="load"><?php _('Load'); ?></label>
        <input name="load" type="text" class="form-control" id="load" placeholder="<?php _('Enter passenger or material'); ?>" value="<?php ePost('load',$this->mission->load); ?>">
    </div>
    <div class="form-group">
        <label for="origin"><?php _('Origin'); ?></label>
        <input name="origin" type="text" class="form-control" id="origin" placeholder="<?php _('Enter point of origin'); ?>" value="<?php ePost('origin',$this->mission->origin); ?>">
    </div>
    <div class="form-group">
        <label for="destination"><?php _('Destination'); ?></label>
        <input name="destination" type="text" class="form-control" id="destination" placeholder="<?php _('Enter point of arrival'); ?>" value="<?php ePost('destination',$this->mission->destination); ?>">
    </div>
    <div class="form-group">
        <label for="contact_name"><?php _('Contact Name'); ?></label>
        <input name="contact_name" type="text" class="form-control" id="contact_name" placeholder="<?php _('Enter name of contact'); ?>" value="<?php ePost('contact_name',$this->mission->contact_name); ?>">
    </div>
    <div class="form-group">
        <label for="contact_tel"><?php _('Contact Tel'); ?></label>
        <input name="contact_tel" type="text" class="form-control" id="contact_tel" placeholder="<?php _('Enter phone number of contact'); ?>" value="<?php ePost('contact_tel',$this->mission->contact_tel); ?>">
    </div>
    <div class="form-group">
        <label for="summary"><?php _('Summary'); ?></label>
        <input name="summary" type="text" class="form-control" id="summary" placeholder="<?php _('Enter short summary'); ?>" value="<?php ePost('summary',$this->mission->summary); ?>">
    </div>
    <div class="form-group">
        <label for="description"><?php _('Description'); ?></label>
        <textarea name="description" class="form-control" id="description" placeholder="<?php _('Enter fulll description'); ?>"><?php ePost('description',$this->mission->description); ?></textarea>
    </div>

    <div class="text-right">
        <a class="btn btn-default" href="<?php eUrl('mission','index'); ?>" role="button"><?php _('Cancel'); ?></a>
        <button type="submit" class="btn btn-primary"><?php _('Edit'); ?></button>
    </div>
</form>