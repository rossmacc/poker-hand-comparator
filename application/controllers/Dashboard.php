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

class Dashboard extends MY_Controller{
    //
    public function __construct()
    {
        parent::__construct();
        $this->require_role('admin');
        $this->load->helper('array','hands_helper');
    }

    public function index() {

            $data['player1'] = $this->hand_player1();
            $data['player2'] = $this->hand_player2();
            $data['tie'] = $this->hand_tie();
            $data['total'] = $this->hand_total();
        //  $this->lang->load('header_footer');
            $this->load->view('templates/header');
            $this->load->view('templates/main_header');
            $this->load->view('templates/main_sidebar');
            $this->load->view('dashboard/dash_index', $data);
        //  $this->load->view('templates/control_sidebar');
            $this->load->view('templates/footer');


    }

    public function dataTable() {
        //Important to NOT load the model and let the library load it instead.
        $this -> load -> library('Datatable', array('model' => 'Hands_model_datatable', 'rowIdCol' => 'id_hand'));
        $this -> datatable -> setColumnSearchType('$.url', 'both');
        $json = $this -> datatable -> datatableJson(
            array(
                'a_boolean_col' => 'boolean',
                'a_percent_col' => 'percent',
                'a_currency_col' => 'currency'
            )
        );

        $this -> output -> set_header("Pragma: no-cache");
        $this -> output -> set_header("Cache-Control: no-store, no-cache");
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($json));

    }

    public function hand_player1() {

        $this->db->from('hands');
        $p1 = "winner_player='1'";
        $this->db->where($p1,NULL);
        $query = $this->db->count_all_results();
        return $query;

    }
        

    public function hand_player2() {

        $this->db->from('hands');
        $p1 = "winner_player='2'";
        $this->db->where($p1,NULL);
        $query = $this->db->count_all_results();
        return $query;
        
    }

    public function hand_tie() {

        $this->db->from('hands');
        $p1 = "winner_player='0'";
        $this->db->where($p1,NULL);
        $query = $this->db->count_all_results();
        return $query;
        
    }

    public function hand_total() {

        $this->db->from('hands');
        $query = $this->db->count_all_results();
        return $query;
        
    }


}