<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1>Wine Ratings</h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
            
            <div class="pull-right" style="margin-top:10px;">
                <a href="<?php echo $add ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
            </div>
            
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Rating</th>
                                <th>Type</th>
                                <th>Range</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>                          
                            <?php foreach($ratings as $r): ?>
                                <tr>
                                    <td><?php echo $r['name']  ?></td>
                                    <td><?php echo $r['typeH'] ?></td>
                                    <td><?php echo $r['range'] ?></td>
                                    <td class="text-right">
                                        <a href="<?php echo $r['edit'] ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                        <a href="<?php echo $r['delete'] ?>" class="btn btn-warning"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>