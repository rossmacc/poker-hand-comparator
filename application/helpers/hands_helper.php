<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


    function get_hands ($hand,$handplayer){
        $value = array_values($hand);
        $rank_card = array($value['0'][0],$value['1'][0],$value['2'][0],$value['3'][0],$value['4'][0]);
        // check first if are all of the same suit
        if ($value['0'][1] == $value['1'][1] && $value['1'][1] == $value['2'][1] && $value['2'][1] == $value['3'][1] && $value['3'][1] == $value['4'][1])
        {
            $same_suit = TRUE;
            // check with is_flush function if is flush, straight flush or royal flush
            $hand = is_flush($rank_card,$same_suit);

        } elseif (is_straight($rank_card)) {
            // check if if straight
            $hand = is_straight($rank_card);
     
        } elseif (no_same_suit($rank_card)) {
            // check if is four of kind, three of a kind, full house, two pair or on pair
            $hand = no_same_suit($rank_card);

        } else {
            /* if it is none of the above is high card (value = 1)
               I have given a value from 10 to 1 to each kind of hand, at the first check, I see what kind
               of hand it is, then I compare the value, if is the same I compare the value of each card to 
               determine the winning hand
            */ 
            $hand = '1';

        }
        return $hand;

    }

    function is_flush ($rank_card,$same_suit)
    {
           // $rank_card = array ('14','13','12','11','10');
              $rank_card = array($rank_card['0'][0],$rank_card['1'][0],$rank_card['2'][0],$rank_card['3'][0],$rank_card['4'][0]);
              $card = array('/A/','/K/','/Q/','/J/','/T/');
              $card_value = array ('14','13','12','11','10');
              $hand = preg_replace($card, $card_value, $rank_card);
                switch (true) {
                     case (is_royal_flush($hand)):
                        return '10';
                        break;
                     case (is_straight_flush($hand)):
                        return '9';
                        break;
                     case 2:
                        return '6';
                        break;
                    }
                    
                return;
                
    }

    function is_royal_flush($hand) {
        $straights = array(range(10,14));
        foreach($straights as $solution) {
            if(array_intersect($solution, $hand) == $solution) {
                return $solution;
            }
        }
        return false;
    }

    function is_straight_flush($hand) {
        $straights = array(range(2, 6), range(3, 7), range(4, 8), range(5, 9), range(6, 10), range(7, 11), range(8, 12), range(9,13));
        foreach($straights as $solution) {
            if(array_intersect($solution, $hand) == $solution) {
                return $solution;
            }
        }
        return false;
    }

    function is_straight($rank_card) {
        $straights = array(range(2, 6), range(3, 7), range(4, 8), range(5, 9), range(6, 10), range(7, 11), range(8, 12), range(9,13),range(10,14));
        $rank_card = array($rank_card['0'][0],$rank_card['1'][0],$rank_card['2'][0],$rank_card['3'][0],$rank_card['4'][0]);
        $card = array('/A/','/K/','/Q/','/J/','/T/');
        $card_value = array ('14','13','12','11','10');
        $hand = preg_replace($card, $card_value, $rank_card);
        foreach($straights as $solution) {
            if(array_intersect($solution, $hand) == $solution) {
                return '5';
            }
        }
        return false;
    }

    function no_same_suit ($rank_card)
    {
           // $rank_card = array ('14','13','12','11','10');
              $rank_card = array($rank_card['0'][0],$rank_card['1'][0],$rank_card['2'][0],$rank_card['3'][0],$rank_card['4'][0]);
              $card = array('/A/','/K/','/Q/','/J/','/T/');
              $card_value = array ('14','13','12','11','10');
              $hand = preg_replace($card, $card_value, $rank_card);

              switch (true) {
                     case (is_four_of_a_kind($hand)):
                        return '8';
                        break;
                     case (is_three_of_a_kind($hand)):
                        return '4';
                        break;
                     case (is_three_of_a_kind($hand) && is_one_pair($hand)):
                        return '7';
                        break;
                     case (is_two_pair($hand)):
                        return '3';
                        break;
                     case (is_one_pair($hand)):
                        return '2';
                        break;
                    }
                    
                return;
                
    }

    function is_four_of_a_kind($hand) {
        $four_of = array_count_values($hand);
                foreach($four_of as $val){
                    if($val == 4){
                        return '8';
                    }
                }
                
        return false;
    }

    function is_three_of_a_kind($hand) {
        $three_of = array_count_values($hand);
                foreach($three_of as $val){
                    if($val == 3){
                        return '4';
                    }
                }
                
        return false;
    }

    function is_two_pair($hand) {
        $pairs = 0; 
        // for each index i and j 
        for ( $i = 0; $i < count($hand); $i++) {
            for ( $j = $i + 1; $j < count($hand); $j++) {
            // finding the index with same 
            // value but different index. 
                if ($hand[$i] == $hand[$j]) {
                    $pairs++; 
                }
        
            }
        
        }

        if ($pairs == 2) {
            return '3'; 
        }
    
        return false;
    }

    function is_one_pair($hand) {
        $four_of = array_count_values($hand);
        
                foreach($four_of as $val){
                    if($val == 2){
                        return '2';
                    }
                }
                
        return false;
    }
       
    function compare_hands($player1,$handp,$player2){
        $valuep1 = array_values($player1);
        $valuep2 = array_values($player2);
        $rank_cardp1 = array($valuep1['0'][0],$valuep1['1'][0],$valuep1['2'][0],$valuep1['3'][0],$valuep1['4'][0]);
        $rank_cardp2 = array($valuep2['0'][0],$valuep2['1'][0],$valuep2['2'][0],$valuep2['3'][0],$valuep2['4'][0]);
        $card = array('/A/','/K/','/Q/','/J/','/T/');
        $card_value = array ('14','13','12','11','10');
        $cardp1 = preg_replace($card, $card_value, $rank_cardp1);
        $cardp2 = preg_replace($card, $card_value, $rank_cardp2);
       
        switch ($handp) {
            case 10:
               return '0';
               break;
            case 9:
            if(array_sum($cardp1) > array_sum($cardp2)){
                $player = '1'; 
            }elseif(array_sum($cardp1) < array_sum($cardp2)) {
                $player = '2';
            }else{
                $player = '0';
            }
               return $player;
               break;
            case 8:
              //not completed yet
               $player = '0';
               return $player;
               break;
            case 7:
              //not completed yet
               $player = '0';
               return $player;
               break;
            case 6:
            for ($i = 1; $i <= 5; $i++) { 
            if(max($cardp1) > max($cardp2)){
               $player = '1';
                break;
            }elseif (max($cardp1) < max($cardp2)) {
               $player = '2';
                break;
            }else{
               asort($cardp1);
               asort($cardp2);    
               array_pop($cardp1);
               array_pop($cardp2);
               $player = '0'; 
            }
            }
               return $player;
               break;
            case 5:
            if(array_sum($cardp1) > array_sum($cardp2)){
                $player = '1'; 
            }elseif(array_sum($cardp1) < array_sum($cardp2)) {
                $player = '2';
            }else{
                $player = '0';
            }
               return $player;
            case 4:
            //not completed yet
               return '0';
               break;
            case 3:
            //not completed yet
               return '0';
               break;
            case 2:
            //not completed yet
               return '0';
               break;
            case 1:
            for ($i = 1; $i <= 5; $i++) { 
            if(max($cardp1) > max($cardp2)){
               $player = '1';
                break;
            }elseif (max($cardp1) < max($cardp2)) {
               $player = '2';
                break;
            }else{
               asort($cardp1);
               asort($cardp2);    
               array_pop($cardp1);
               array_pop($cardp2);
               $player = '0'; 
            }
            }
               return $player;
               break;
        }
           
       return;

       
    }

