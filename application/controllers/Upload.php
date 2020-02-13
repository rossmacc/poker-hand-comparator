<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * ***************************************************************
 * Script :
 * Version :
 * Date :
 * Author : Rosario Maccarrone
 * Email : r.maccarrone@outlook.com
 * Description : poker hand comparator
 * ***************************************************************
 */

class Upload extends MY_Controller{
    //
    public function __construct()
    {
        parent::__construct();
        $this->require_role('admin');
        $this->load->helper(array('form', 'url'));
    }

    public function index() {


        //  $this->lang->load('header_footer');
            $this->load->view('templates/header');
            $this->load->view('templates/main_header');
            $this->load->view('templates/main_sidebar');
            $this->load->view('upload/upload_index', array('error' => ' ' ));
            $this->load->view('templates/control_sidebar');
            $this->load->view('templates/footer');
        //  $this->output->enable_profiler(TRUE);

    }

    // Start uploading file with CodeIgniter's File Uploading Class
    
    public function upload_file(){

        //initialize image upload error array to empty
        $data['error'] = '';
        
        //set various preferences, restricting the type and size of the files
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'txt';
        $config['max_size'] = '3000';

        //initialize Upload Class
        $this->load->library('upload', $config);

        //if upload failed, display error
        if ( ! $this->upload->do_upload('userfile')) {

            $data['error'] = $this->upload->display_errors();
            
            $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Warning!</h4>' .$data['error']. '</div>');       
            redirect('upload/index');
            

        } else {

        //parse file into DB            
           $file_data = $this->upload->data();
           $file_path = './uploads/'.$file_data['file_name'];
           
           $num_lines = count(file($file_path));
           $txt_file  = file_get_contents($file_path);
           $rows      = explode("\n", $txt_file, $num_lines);
           $hands     = array();
           
           foreach($rows as $row => $data)
           {
               //get row data
               $row_data = explode(' ', $data);
           
               $info[$row]['P1_C1']           = isset ($row_data[0]) ? $row_data[0] : null;
               $info[$row]['P1_C2']           = isset ($row_data[1]) ? $row_data[1] : null;
               $info[$row]['P1_C3']           = isset ($row_data[2]) ? $row_data[2] : null;
               $info[$row]['P1_C4']           = isset ($row_data[3]) ? $row_data[3] : null;
               $info[$row]['P1_C5']           = isset ($row_data[4]) ? $row_data[4] : null;
               $info[$row]['P2_C1']           = isset ($row_data[5]) ? $row_data[5] : null;
               $info[$row]['P2_C2']           = isset ($row_data[6]) ? $row_data[6] : null;
               $info[$row]['P2_C3']           = isset ($row_data[7]) ? $row_data[7] : null;
               $info[$row]['P2_C4']           = isset ($row_data[8]) ? $row_data[8] : null;
               $info[$row]['P2_C5']           = isset ($row_data[9]) ? $row_data[9] : null;

               $hands [] = array(
                'p1_c1' => $info[$row]['P1_C1'],
                'p1_c2' => $info[$row]['P1_C2'],
                'p1_c3' => $info[$row]['P1_C3'],
                'p1_c4' => $info[$row]['P1_C4'],
                'p1_c5' => $info[$row]['P1_C5'],
                'p2_c1' => $info[$row]['P2_C1'],
                'p2_c2' => $info[$row]['P2_C2'],
                'p2_c3' => $info[$row]['P2_C3'],
                'p2_c4' => $info[$row]['P2_C4'],
                'p2_c5' => $info[$row]['P2_C5']                
                );
                        
           }

            $this->db->truncate('hands');
            $this->db->insert_batch('hands',$hands);
            // get hands from db and start comparing
            $this->hands();
            
            
            $data = array('upload_data' => $this->upload->data());
            
            
            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Great!</h4>File ' .$data['upload_data']['file_name']. ' uploaded. 
                <br/>'.$this->db->count_all('hands').' hands added.</div>');
            redirect('upload/index');
                   
        }


    }

    public function hands() {

        //get hands and divide the cards to each player
        $query = $this->db->query("SELECT * FROM hands"); 
        

        foreach ($query->result() as $row)
        {
            $hand      = $row->id_hand;
            $player1c1 = $row->p1_c1;
            $player1c2 = $row->p1_c2;
            $player1c3 = $row->p1_c3;
            $player1c4 = $row->p1_c4;
            $player1c5 = $row->p1_c5;
            $player2c1 = $row->p2_c1;
            $player2c2 = $row->p2_c2;
            $player2c3 = $row->p2_c3;
            $player2c4 = $row->p2_c4;
            $player2c5 = $row->p2_c5;

            $hands [] = array(
                
                'p1_c1' => $player1c1,
                'p1_c2' => $player1c2,
                'p1_c3' => $player1c3,
                'p1_c4' => $player1c4,
                'p1_c5' => $player1c5,
                'p2_c1' => $player2c1,
                'p2_c2' => $player2c2,
                'p2_c3' => $player2c3,
                'p2_c4' => $player2c4,
                'p2_c5' => $player2c5,
                'hand' => $hand

                );   
        
        }
         
         $this->get_hand($hands);
         
}

public function get_hand($hands) {

    foreach ($hands as $hand){
            $handplayer = $hand['hand'];
            $player1 = array_slice($hand, 0, 5);
            $player2 = array_slice($hand, 5, 5);
            
        //get rank from each hand
        $handp1 = get_hands($player1,$handplayer); 
        $handp2 = get_hands($player2,$handplayer);              
        
        if ($handp1 > $handp2){
            $winnerplayer = '1';
            $winnerhand = $handp1;
        }elseif ($handp1 < $handp2){
            $winnerplayer = '2';
            $winnerhand = $handp2;
        }else {
            $winnerplayer = compare_hands($player1,$handp1,$player2);
            $winnerhand = $handp2;
        }
        
        $hand_player [] = array(
            'id_hand' => $handplayer,
            'p1_hand' => $handp1,
            'p2_hand' => $handp2,
            'winner_player' => $winnerplayer,
            'winner_hand' => $winnerhand
            );              
          
        }
          
        $this->db->update_batch('hands', $hand_player, 'id_hand');

}



}
