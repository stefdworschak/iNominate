<?php

class Winner {
  function setWinner($in_id, $in_name, $in_score,$in_rank1, $in_rank2, $in_rank3, $in_place, $in_win){
    $this->id = $in_id;
    $this->name = $in_name;
    $this->score = $in_score;
    $this->rank1 = $in_rank1;
    $this->rank2 = $in_rank2;
    $this->rank3 = $in_rank3;
    $this->place = $in_place;
    $this->win = $in_win;
    return $this;
  }

  function getId(){
    return $this->id;
  }

  function getName(){
    return $this->name;
  }

  function getScore(){
    return $this->score;
  }

  function getRank1(){
    return $this->rank1;
  }

  function getRank2(){
    return $this->rank2;
  }

  function getRank3(){
    return $this->rank3;
  }

  function getPlace(){
    return $this->place;
  }

  function getWin(){
    return $this->win;
  }

  function getAll(){
    return $this;
  }
}

?>
