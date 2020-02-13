<script class="init" type="text/javascript">
$(document).ready(function() {
    var rows_selected = [];
    var table =  $('#poker_hands_list').DataTable( {
    	responsive: {
        details: {
            type: 'column'
        }
    },

    	autoWidth: false,

    	columnDefs: [
    	{

        className: 'control',
        orderable: false,
        targets:   0
    },
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 1 },
        { responsivePriority: 3, targets: 2 },
        { responsivePriority: 4, targets: -1 },
        { responsivePriority: 5, targets: -2 }
    ],
        processing: true,
        serverSide: true,
        ajax: {
            "url": "<?=base_url('dashboard/dataTable');?>",
            "type": "POST"
        },

       
        aoColumns: [

            { data : "id_hand" },
            { data: "p1_c1",
              'sWidth': "5%",
              "render": function ( data, type, row ) {
                         return '<img src="<?=base_url('assets/pokercards/');?>'+ data +'.png",width=70px, height=90px />';
                        }
              },
            { data: "p1_c2",
              'sWidth': "5%",
              "render": function ( data, type, row ) {
                         return '<img src="<?=base_url('assets/pokercards/');?>'+ data +'.png",width=70px, height=90px />';
                        }
              },
            { data: "p1_c3",
              'sWidth': "5%",
              "render": function ( data, type, row ) {
                         return '<img src="<?=base_url('assets/pokercards/');?>'+ data +'.png",width=70px, height=90px />';
                        }
              },
            { data: "p1_c4",
              'sWidth': "5%",
              "render": function ( data, type, row ) {
                         return '<img src="<?=base_url('assets/pokercards/');?>'+ data +'.png",width=70px, height=90px />';
                        }
              },
            { data: "p1_c5",
              'sWidth': "5%",
              "render": function ( data, type, row ) {
                         return '<img src="<?=base_url('assets/pokercards/');?>'+ data +'.png",width=70px, height=90px />';
                        }
              },
       //     { data : "p1.name_holdem_hand" },
            { data : "p1_hand" },
            { data: "p2_c1",
              'sWidth': "5%",
              "render": function ( data, type, row ) {
                         return '<img src="<?=base_url('assets/pokercards/');?>'+ data +'.png",width=70px, height=90px />';
                        }
              },
            { data: "p2_c2",
              'sWidth': "5%",
              "render": function ( data, type, row ) {
                         return '<img src="<?=base_url('assets/pokercards/');?>'+ data +'.png",width=70px, height=90px />';
                        }
              },
            { data: "p2_c3",
              'sWidth': "5%",
              "render": function ( data, type, row ) {
                         return '<img src="<?=base_url('assets/pokercards/');?>'+ data +'.png",width=70px, height=90px />';
                        }
              },
            { data: "p2_c4",
              'sWidth': "5%",
              "render": function ( data, type, row ) {
                         return '<img src="<?=base_url('assets/pokercards/');?>'+ data +'.png",width=70px, height=90px />';
                        }
              },
            { data: "p2_c5",
              'sWidth': "5%",
              "render": function ( data, type, row ) {
                         return '<img src="<?=base_url('assets/pokercards/');?>'+ data +'.png",width=70px, height=90px />';
                        }
              },
          //  { data : "p2.name_holdem_hand" },
            { data : "p2_hand" },
            { data : "name_player" },
            { data : "name_holdem_hand" },

           // { data: "$.city_state_zip" } //refers to the expression in the "More Advanced DatatableModel Implementation"
        ],

   });

  });
</script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $player1;?></h3>

              <p>hands</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer"><b>Player 1 Win </b><i class="fa fa-arrow-circle-up"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $player2;?></h3>

              <p>hands</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer"><b>Player 2 Win </b><i class="fa fa-arrow-circle-up"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $tie;?></h3>

              <p>hands</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"><b>Tied</b></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $total;?></h3>

              <p>Total Hands</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"><b>Total Hands</b></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
  
    <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Poker Hands List</h3>
      <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>

    </div><!-- /.box-header -->
    <div class="box-body">
      <table id="poker_hands_list" class="table table-hover dataTable" width="100%">
        <thead>
        <tr> <th rowspan="2">Hand</th> <th colspan="6">Player 1</th> <th colspan="6">Player 2</th><th colspan="2">Winner</th> </tr>
          <tr>
            <th>Card 1</th>
            <th>Card 2</th>
            <th>Card 3</th>
            <th>Card 4</th>
            <th>Card 5</th>
            <th>Hold'em Hand</th>
            <th>Card 1</th>
            <th>Card 2</th>
            <th>Card 3</th>
            <th>Card 4</th>
            <th>Card 5</th>
            <th>Hold'em Hand</th>
            <th>Player</th>
            <th>Hand</th>
          </tr>
        </thead>

         <tfoot>
         <tr> <th rowspan="2">Hand</th> <th colspan="6">Player 1</th> <th colspan="6">Player 2</th><th colspan="2">Winner</th>  </tr>
          <tr>
            <th>Card 1</th>
            <th>Card 2</th>
            <th>Card 3</th>
            <th>Card 4</th>
            <th>Card 5</th>
            <th>Hold'em Hand</th>
            <th>Card 1</th>
            <th>Card 2</th>
            <th>Card 3</th>
            <th>Card 4</th>
            <th>Card 5</th>
            <th>Hold'em Hand</th>
            <th>Player</th>
            <th>Hand</th>
          </tr>
        </tfoot>

        <tbody>

        </tbody>

      </table>
      
    </div>
    
    <!-- /.row (main row) -->
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->