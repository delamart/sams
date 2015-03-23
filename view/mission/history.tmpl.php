<h1 class="page-header"><?php _('Missions (History)'); ?></h1>

<div>
    <a class="btn btn-default" href="<?php eUrl('mission','create'); ?>" role="button">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <?php _('Add Mission'); ?>
    </a>
    <a class="btn btn-default" href="<?php eUrl('mission','index'); ?>" role="button"><?php _('Back to Missions'); ?></a>
</div>

<div class="table-responsive">
    <table id="mission-table" class="table table-striped">
        <thead>
        <tr>
            <th><?php _('Start'); ?></th>
            <th><?php _('End'); ?></th>
            <th><?php _('Vehicle'); ?></th>
            <th><?php _('Personel'); ?></th>
            <th><?php _('Summary'); ?></th>
            <th class="text-right"><?php _('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($this->missions as $id => $mission): ?>
            <tr>
                <td data-order="<?php echo $mission->start; ?>"><?php echo dt($mission->start,'medium'); ?></td>
                <td data-order="<?php echo $mission->end; ?>" title="<?php echo dt($mission->end,'long'); ?>"><?php echo dt($mission->end,'short'); ?></td>
                <td><?php echo $mission->getVehicleFull(); ?></td>
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