<?php
echo $header;
echo $column_left;
?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-liveengage" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title_m; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-liveengage" class="form-horizontal">
         
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="liveengage_id"><?php echo $form_liveengage_id; ?></label>
            <div class="col-sm-10">
              <input type="text" name="liveengage_id" id="liveengage-id" class="form-control" value="<?php echo $liveengage_id; ?>" />

              <?php if ($error_liveengage_id) { ?>
              <div class="text-danger"><?php echo $error_liveengage_id; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-test"><?php echo $form_enabled; ?></label>
            <div class="col-sm-10">
              <select name="liveengage_status" id="input-liveengage" class="form-control">
                <option value="<?php echo $text_off;?>" <?php echo ($liveengage_status == $text_off ? ' selected="selected"' : '')?>><?php echo $text_off; ?></option>
                <option value="<?php echo $text_on;?>" <?php echo ($liveengage_status == $text_on ? ' selected="selected"' : '')?>><?php echo $text_on; ?></option>
              </select>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 