<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class PatrickPlayers
 * Je récupère les statistiques du joueur et je joue la valeur qui bat la valeur qu'il joue le
 * @package Hackathon\PlayerIA
 * @author Anne Solène TEFAK BIMBIA
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

        if ($this->result->getNbRound() > 3)
        {
            $opStat = $this->result->getStatsFor($this->opponentSide);
            $paper = $opStat['paper'];
            $rock = $opStat['rock'];
            $scissors = $opStat['scissors'];

            $max = 'paper';

            if (($rock > $paper) && ($rock > $scissors))
                $max = 'rock';
            else if (($scissors > $paper) && ($scissors > $rock))
                $max = 'scissors';

            if ($max == 'rock')
                return parent::paperChoice();
            if ($max == 'paper')
                return parent::scissorsChoice();
            if ($max == 'scissors')
                return parent::rockChoice();
        }
        
        if ($this->result->getNbRound() == 1)
            return parent::rockChoice();
        if ($this->result->getNbRound() == 2)
            return parent::scissorsChoice();

        return parent::paperChoice();
    }
};
