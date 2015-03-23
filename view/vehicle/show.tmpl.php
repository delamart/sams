<h1 class="page-header"><?php _('Vehicle'); ?> <em><?php echo $this->vehicle->getFullName(); ?></em></h1>

<div>
    <a class="btn btn-default" href="<?php eUrl('vehicle','index'); ?>" role="button"><?php _('Back to Vehicles'); ?></a>
    <a class="btn btn-primary" href="<?php eUrl('vehicle','edit',$this->vehicle->id); ?>" role="button"><?php _('Edit Vehicle'); ?></a>
</div>

<br />

<div class="">
    <dl class="dl-horizontal">
        <dt><?php _('Type'); ?></dt>
        <dd><?php echo $this->vehicle->getVtypeName(); ?></dd>
        <dt><?php _('Number'); ?></dt>
        <dd><?php echo $this->vehicle->number; ?></dd>
    </dl>
</div>
<h2><?php _('Vehicle Missions'); ?></h2>
<div class="table-responsive">
    <table id="mission-table" class="table table-striped">
        <thead>
        <tr>
            <th><?php _('Start'); ?></th>
            <th><?php _('End'); ?></th>
            <th><?php _('Personel'); ?></th>
            <th><?php _('Summary'); ?></th>
            <th class="text-right"><?php _('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($this->missions as $id => $mission): ?>
            <tr>
                <td data-order="<?php echo $mission->start; ?>"><?php $mission->startHTML(); ?></td>
                <td data-order="<?php echo $mission->end; ?>"><?php $mission->endHTML(); ?></td>
                <td><?php echo $mission->getPersonelFull();; ?></td>
                <td><?php echo $mission->summary; ?></td>
                <td class="text-right">
                    <a href="<?php eUrl('mission','show',$id); ?>" class="btn btn-default btn-xs glyphicon glyphicon-search">
                        <span class="sr-only">Show</span>
                    </a>
                    <a href="<?php eUrl('mission','edit',$id); ?>" class="btn btn-primary btn-xs glyphicon glyphicon-pencil">
                        <span class="sr-only">Edit</span>
                    </a>
                    <a href="<?php eUrl('mission','delete',$id); ?>"
                       class="btn btn-danger btn-xs glyphicon glyphicon-remove"
                       onclick="return confirm('<?php _('Are you sure you want to delete this item'); ?> ?')">
                        <span class="sr-only">Delete</span>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mission-table').dataTable();
        } );
    </script>
</div>