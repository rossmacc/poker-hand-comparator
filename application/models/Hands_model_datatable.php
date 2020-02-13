<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * ***************************************************************
 * Script :
 * Version :
 * Date :
 * Author : Rosario Maccarrone
 * Email : r.maccarrone@outlook.com
 * Description :
 * ***************************************************************
 */


class Hands_model_datatable extends MY_Model implements DatatableModel{
    
    public function __construct()
    {
        parent::__construct();

    }


    public function appendToSelectStr() {
            return NULL;
        }

    public function fromTableStr() {
            return 'hands';
        }
    public function joinArray(){
        return array(
            'holdem_hand|left join' => 'hands.winner_hand = holdem_hand.id_holdem_hand',
            'player|left join' => 'hands.winner_player = player.id_player'
            );
        }
  /*  public function joinArray(){
        return array(
            'holdem_hand p1|left join' => 'hands.p1_hand = p1.id_holdem_hand',
            'holdem_hand p2|left join' => 'hands.p2_hand = p2.id_holdem_hand'
            );
        }
  */
    public function whereClauseArray(){
            return NULL;
        }

}