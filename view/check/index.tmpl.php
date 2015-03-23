<h1 class="page-header"><?php _('Personel Checks'); ?></h1>

<div>
    <a class="btn btn-default" href="<?php eUrl('check','edit'); ?>" role="button">
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        <?php _('Modify Personel Check Types'); ?>
    </a>
</div>

<div class="table-responsive">
    <table id="checks-table" class="table table-striped">
        <thead>
        <tr>
            <th><?php _('Rank'); ?></th>
            <th><?php _('Personel'); ?></th>
            <?php foreach($this->checks as $id => $check): ?>
            <th><?php echo $check->name; ?></th>
            <?php endforeach; ?>
            <th><?php _('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($this->personels as $id => $personel): ?>
            <tr>
                <td data-sort="<?php echo $personel->getRankOrder(); ?>"
                    data-search="<?php echo $personel->getRankName().'|'.$personel->getRankShort(); ?>"
                    ><?php echo $personel->getRankShort(); ?></td>
                <td data-search="<?php echo $personel->getSearchName(); ?>"><?php echo $personel->name; ?></td>
                <?php
                    $ids = $personel->getPersonelchecksId();
                    foreach($this->checks as $cid => $check): ?>
                <td><?php echo isset($ids[$cid]) ? 'X' : ''; ?></td>
                <?php endforeach; ?>
                <td>
                    <a href="<?php eUrl('personel','edit',$id); ?>" class="btn btn-primary btn-xs glyphicon glyphicon-pencil">
                        <span class="sr-only">Edit</span>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#checks-table').dataTable();
        } );
    </script>
</div>
