<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1><?php echo $title ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
            
            <div class="pull-right" style="margin-top:10px;">
                <button type="submit" form="form" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Save"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel ?>" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
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
                    
                    <form id="form" action="<?php echo $action ?>" method="POST" class="form-horizontal" style="overflow: hidden;">
                        
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="name">Name</label>
                            <div class="col-sm-4"> 
                                <input type="text" name="name" value="<?php echo $rating['rating']['name'] ?>" placeholder="Name" id="name" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="type">Type</label>
                            <div class="col-sm-4">
                                <select name="type" id="type" class="form-control">
                                    <option value="points" <?php echo $rating['rating']['type']=='points'?"selected":"" ?>>Points</option>
                                    <option value="award" <?php echo $rating['rating']['type']=='award'?"selected":"" ?>>Award</option>
                                    <option value="award_places" <?php echo $rating['rating']['type']=='award_places'?"selected":"" ?>>Award with places</option>
                                    <option value="stars" <?php echo $rating['rating']['type']=='stars'?"selected":"" ?>>Star rating</option>
                                </select>
                            </div>
                        </div>
                        
                        <div id="range" class="form-group required" >
                            <label class="col-sm-2 control-label" for="range">Range</label>
                            <div class="col-sm-4"> 
                                <input type="number" name="rangemin" min="0" value="<?php echo isset($rating['rating']['rangemin'])?$rating['rating']['rangemin']:0 ?>" placeholder="min" id="range" class="form-control" style="float:left;width:100px;margin-right:10px;">
                                <input type="number" name="rangemax" min="0" value="<?php echo isset($rating['rating']['rangemax'])?$rating['rating']['rangemax']:100 ?>" placeholder="max" id="rangemax" class="form-control" style="float:left;width:100px;">
                            </div>
                        </div>

                        <?php if(empty($rating['rating_values'])): ?>    
                            <div id="places" class="form-group required" >
                                <label class="col-sm-2 control-label" for="place">Places</label>
                                <div class="col-sm-4 place_holder"> 
                                    <div>
                                        <input type="text" name="place[]" value="" placeholder="Place" class="form-control place" />
                                        <a href="#" class="btn btn-primary add_place"><i class="fa fa-plus"></i></a>
                                    </div>

                                </div>
                            </div>
                        <?php else: ?>
                            <div id="places" class="form-group required" >
                                <label class="col-sm-2 control-label" for="place">Places</label>
                                <div class="col-sm-4 place_holder"> 
                                    <?php $i=0; foreach($rating['rating_values'] as $r): 
                                        if($i == 0): ?>                                        
                                            <div>
                                                <input type="text" name="place[]" value="<?php echo $r['value'] ?>" placeholder="Place" class="form-control place" />
                                                <a href="#" class="btn btn-primary add_place"><i class="fa fa-plus"></i></a>
                                            </div>
                                        <?php ++$i; else: ?>
                                            <div>
                                                <input type="text" name="place[]" value="<?php echo $r['value'] ?>" placeholder="Place" class="form-control place" />
                                                <a href="#" class="btn btn-warning remove_place"><i class="fa fa-trash"></i></a>
                                            </div>
                                    <?php ++$i; endif;
                                    endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function(){
        
        var placeInput = '<input type="text" name="place[]" value="" placeholder="Place" class="form-control place" />';
        var removeBtn = '<a href="#" class="btn btn-warning remove_place"><i class="fa fa-trash"></i></a>';
        
        if($('#type').val() !== 'points' && $('#type').val() !== 'stars')
        {
            $('#range').hide();
        }
        
        if($('#type').val() !== 'award_places')
        {
            $('#places').hide();
        }
            
        $('#type').change(function(){
            if($(this).val() === 'points' || $(this).val() === 'stars')
            {
                $('#range').fadeIn('slow');
            } else {
                $("#range").fadeOut('slow');
            }
            
            if($(this).val() === 'award_places')
            {
                $('#places').fadeIn('slow');
            } else {
                $('#places').fadeOut('slow');
            }
            
        });
        
        $(".add_place").click(function(e){
            e.preventDefault();
            $('.place_holder').append("<div>"+placeInput+removeBtn+"</div>");
        });
        
        $('.place_holder').on('click','.remove_place',function(e){
            e.preventDefault();
            $(this).parent().fadeOut().remove();
        });
    });

</script>
<style>
    .place{margin-bottom:10px;}
    .add_place,.remove_place{    
        position: absolute;
        right: -35px;
        top: 0;
    }
    .place_holder > div{
        position:relative;
    }
</style>
<?php echo $footer; ?>