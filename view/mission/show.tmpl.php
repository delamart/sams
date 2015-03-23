<h1 class="page-header"><?php _('Mission'); ?> <em><?php echo $this->mission->summary; ?></em></h1>

<div>
    <a class="btn btn-default" href="<?php eUrl('mission','index'); ?>" role="button"><?php _('Back to Missions'); ?></a>
    <a class="btn btn-primary" href="<?php eUrl('mission','edit',$this->mission->id); ?>" role="button"><?php _('Edit Mission'); ?></a>
    <a class="btn btn-danger" href="<?php eUrl('mission','delete',$this->mission->id); ?>" role="button"
       onclick="return confirm('<?php _('Are you sure you want to delete this item'); ?> ?')"><?php _('Delete Mission'); ?></a>
</div>

<br />

<div class="">
    <dl class="dl-horizontal">
        <dt><?php _('Start'); ?></dt>
        <dd><?php echo dt($this->mission->start); ?> <br> <?php $this->mission->startHTML(); ?></dd>
        <dt><?php _('End'); ?></dt>
        <dd><?php echo dt($this->mission->end); ?> <br> <?php $this->mission->endHTML(); ?></dd>
        <dt><?php _('Vehicle'); ?></dt>
        <dd><?php echo $this->mission->getVehicleFull(); ?></dd>
        <dt><?php _('Personel'); ?></dt>
        <dd><?php echo $this->mission->getPersonelFull(); ?></dd>
        <dt><?php _('Load'); ?></dt>
        <dd><?php echo $this->mission->load; ?></dd>
        <dt><?php _('Origin'); ?></dt>
        <dd><?php echo $this->mission->origin; ?></dd>
        <dt><?php _('Destination'); ?></dt>
        <dd><?php echo $this->mission->destination; ?></dd>
        <dt><?php _('Contact Name'); ?></dt>
        <dd><?php echo $this->mission->contact_name; ?></dd>
        <dt><?php _('Contact Tel'); ?></dt>
        <dd><?php echo $this->mission->contact_tel; ?></dd>
        <dt><?php _('Summary'); ?></dt>
        <dd><?php echo $this->mission->summary; ?></dd>
        <dt><?php _('Description'); ?></dt>
        <dd><?php echo nl2br($this->mission->description); ?></dd>
    </dl>
</div>
