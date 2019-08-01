<?php

class Game
{


    //Properties
	public $frames     = [[]];


    /**
     * Add a roll to the frame property array
     *
     * @param  int  $pins
     *
     */
	public function roll($pins)
    {

        //Set the pointer to the last frame
        //Get the key of the current frame
        //Count how many rolls have been made for this frame
    	end($this->frames);
		$lastFrame 			= key($this->frames);
		$rollsCurrentFrame 	= count($this->frames[$lastFrame]);

		//Is Valid Pins?
		if($pins > 10){
			throw new Exception("Invalid Pins quantity");
		}

		//Is Pins Max reached?
		if($rollsCurrentFrame == 1){
			$isPinsMax = ($this->frames[$lastFrame][0] + $pins > 10 ? true : false );

			if ($isPinsMax) {
				throw new Exception("The pins limit for this ball is ".(10 - $this->frames[$lastFrame][0]));
			}
		}

		//Is Max Rolled reached?
		if($lastFrame == 9){
			if(isset($this->frames[$lastFrame][0]) && isset($this->frames[$lastFrame][1]) && $this->frames[$lastFrame][0] + $this->frames[$lastFrame][1] != 10){
				throw new Exception("The game is over. Please reset the game if you want to start a new one");
			}
		}
		elseif($lastFrame == 10 || $lastFrame == 11){
			if($this->frames[9][0] != 10 && $this->frames[9][1] != 10){
				throw new Exception("The game is over. Please reset the game if you want to start a new one");
			}
		}
		elseif($lastFrame == 12){
			throw new Exception("The game is over. Please reset the game if you want to start a new one");
		}

		//Update Frame property
		if($rollsCurrentFrame >= 2){
    		$this->frames[][] = $pins;
    	}
    	else{
    		$this->frames[$lastFrame][] = $pins;
    	}

    	if($pins == 10){
    		$this->frames[] = [];
    	}
    	
    }

    /**
     * Add the total score for each frames to the frame property array
     */
    public function score()
    {

        foreach ($this->frames as $frame => $rolls) {

        	//STRIKE
        	if(isset($this->frames[$frame][0]) && $this->frames[$frame][0] == 10){

        		if(!$this->isBonusStrikeReady($frame)){
        			continue;
        		}

        		$bonus1 = $this->frames[$frame + 1][0];
        		$bonus2 = $this->frames[$frame + 1][1] ?? $this->frames[$frame + 2][0];

        		$this->frames[$frame]["total"] = 10 + $bonus1 + $bonus2;
        	}
        	//SPARE
        	elseif(isset($this->frames[$frame][0]) && isset($this->frames[$frame][1]) && $this->frames[$frame][0] + $this->frames[$frame][1] == 10) {

        		if(!$this->isBonusSquareReady($frame)){
        			continue;
        		}

        		$bonus = $this->frames[$frame + 1][0];

        		$this->frames[$frame]["total"] = 10 + $bonus;
        	}
        	else{
        		
        		if(count(($this->frames[$frame])) !== 2){
        			continue;
        		}
        		
        		$this->frames[$frame]["total"] = $rolls[0] + $rolls[1];
        	}
        
        }
    }


    /**
     * Verify if the bonuses are ready for a Strike
     *
     * @param  int  $frame index
     *
     */
    private function isBonusStrikeReady($frame){
    	if(!isset($this->frames[$frame + 1][0])){
    		return false;
    	}

		if(!isset($this->frames[$frame + 1][1])){
			if(!isset($this->frames[$frame + 2][0])){
				return false;
			}
		}

		return true;
    }

    /**
     * Verify if the bonuses are ready for a Spare
     *
     * @param  int  $frame index
     *
     */
    private function isBonusSquareReady($frame){
    	if(!isset($this->frames[$frame + 1][0])){
    		return false;
    	}

		return true;
    }

}