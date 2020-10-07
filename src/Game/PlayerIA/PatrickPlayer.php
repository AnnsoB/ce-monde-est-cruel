<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class PatrickPlayers
 * @package Hackathon\PlayerIA
 * @author TEFAK BIMBIA Anne Solène
 */
class PatrickPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function fiveLastChoices()
    {
        $opChoices = $this->result->getChoicesFor($this->opponentSide);
        $last = $opChoices;
        $size = count($opChoices);

        if ($size > 7)
            $last = array_slice($opChoices, ($size - 8));
        
        return $last;
    }

    public function sameLast()
    {
        $opFive = $this->fiveLastChoices();
        
        $first = $opFive[0];
        foreach($opFive as $elmt)
        {
            if ($first != $elmt)
                return 0;
        }
        return $first;
    }

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------

        if ($this->result->getNbRound() > 4)
        {
            $lasts = $this->sameLast();
            if ($lasts != 0)
            {
                if ($lasts == 'paper')
                    return parent::scissorsChoice();
                if ($lasts == 'rock')
                    return parent::paperChoice();
                if ($lasts == 'scissors')
                    return parent::rockChoice();
            }
        }


        /*if ($value == 2)
            $value = 0;
        else
            $value = $value + 1;

        if ($value == 0)
            $result = parent::rockChoice();
        else if ($value == 1)
            $result = parent::paperChoice();
        else
            $result = parent::scissorsChoice();*/

        return parent::paperChoice();

    }
};
