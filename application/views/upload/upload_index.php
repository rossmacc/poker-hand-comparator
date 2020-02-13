  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Upload file
        <small>Poker Hands</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Upload file</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Select file to import</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open_multipart('upload/upload_file');?>
              <div class="box-body">
              
                <div class="form-group">
                  <label for="InputFile">File input</label>
                  <input id="InputFile" type="file" name="userfile" size="20" />

                  <p class="help-block">File must be in txt format, each line must contain ten cards (space separated). </br>Example: 8C TS KC 9H 4S 7D 2S 5D 3S AC</p>
                </div>
                
              </div>
              <!-- /.box-body -->
              <?php echo $error;?>
              <div class="box-footer">
                <input type="submit" id="input" value="upload" style="display: none;" />
                <label for="input" class="btn btn-primary">
                  Upload
                </label>
                
              </div>
            </form>
          </div>

          <?php echo $this->session->flashdata('msg'); ?>
          <!-- /.box -->

         

         

          

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          
          
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->     