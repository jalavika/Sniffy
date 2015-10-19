<?php

/*
|--------------------------------
| Library by Synth
| Please don't change the copyright
| Take a look on the example.php file
|--------------------------------
*/

class Object {
	
	public function __construct($id)
	{
		$this->id = $id;
		$this->source = file_get_contents('http://www.dofusbook.net/fr/encyclopedie/objet/'.$this->id.'.html');
	}

	private function textBetween($data, $tagOpen, $tagClose)
	{
        $startIn = strpos($data, $tagOpen) + strlen($tagOpen);
        $endIn = strpos($data, $tagClose, $startIn);
        $result = substr($data, $startIn, $endIn - $startIn);
        return (empty($result) ? FALSE : $result);
    }

    public function desc()
    {
    	$this->desc = $this->textBetween($this->source, '<div class="item-desc" style="display:none">', '</div>');
    	return $this->desc;
    }

    public function level()
    {
    	$this->level = $this->textBetween($this->source, ' - Niveau ', '</span></h2>');
    	return $this->level;
    }

    public function gfx()
    {
    	$this->gfx = $this->textBetween($this->source, '<div class=\'item-img relative\'><img src="http://static.dofusbook.net/Contenu/images/items/', '_0.png" width="114" height="114" alt=""/>');
    	return $this->gfx;
    }

    public function type()
    {
    	$this->type = $this->textBetween($this->source, '&nbsp;&nbsp;&nbsp;<span>', ' - Niveau');
    	$type = array(
    		'Amulette' => 1,
    		'Anneau' => 9,
    		'Cape' => 17,
    		'Familier' => 18,
    		'Ceinture' => 10,
    		'Bottes' => 11,
    		'Bouclier' => 82,
    		'Dofus' => 23,
    		'Chapeau' => 16,
    	);
    	return $type[$this->type];
    }

    public function name()
    {
    	$this->name = $this->textBetween($this->source, "<div class='item-header'>", '&nbsp;&nbsp;&nbsp;<span>');
    	return substr($this->name, 5);
    }

    //Affichage des effets comme sur le site
    public function effects_string()
    {
    	$this->effects = $this->textBetween($this->source, '<div class="item-effet"><h2>Effets</h2>', '</div>');
    	$explode = explode('<br/>', $this->effects);
    	foreach($explode as $bonus){
    		if(!empty($bonus)){
	    		$get1 = explode('<span style="color:', $bonus);
	    		if(!empty($get1[1])){
		    		$get3 = explode('">', $get1[1]);
		    		if(!empty($get3[1])){
			    		$get2 = explode('</span>', $get3[1]);
			    		echo $get2[0].'<br>';
		    		}
	    		}
    		}
    	}
    }

    private function element($type)
    {
    	$this->type = $type;
    	$data = array(
    		'Vitalité' => 125,
    		'Force' => 118,
    		'Chance' => 123,
    		'Agilité' => 119,
    		'Intelligence' => 126,
    		'Sagesse' => 124,
    		'Vitalité -' => 153,
    		'Force -' => 157,
    		'Chance -' => 152,
    		'Agilité -' => 154,
    		'Intelligence -' => 155,
    		'Sagesse -' => 156,
    		'PO' => 117,
    		'PO -' => 116,
    		'PA' => 111,
    		'PA -' => 168,
       		'PM' => 128,
       		'PM -' => 169,
    		'Dommages' => 112,
    		'Neutre Dommages' => 112,
    		'Terre Dommages' => 112,
    		'Feu Dommages' => 112,
    		'Air Dommages' => 112,
    		'Eau Dommages' => 112,
    		'Dommages -' => 145,
    		'Puissance' => 138,
    		'Prospection' => 176,
    		'Prospection -' => 177,
    		'Initiative' => 174,
    		'Initiative -' => 175,
    		'Invocations' => 182,
    		'Soins' => 178,
    		'Soins -' => 179,
    		'Critique %' => 115,
    		'Critique % -' => 171,
    		'Pièges Dommages' => 225,
    		'Pièges Dommages %' => 226,
    		'PM Esquive' => 161,
    		'PM Esquive -' => 163,
    		'PA Esquive' => 160,
    		'PA Esquive -' => 162,
    		'Terre Résistance %' => 210,
    		'Eau Résistance %' => 211,
    		'Feu Résistance %' => 213,
    		'Air Résistance %' => 212,
    		'Neutre Résistance %' => 214,
    		'Terre Résistance % -' => 215,
    		'Eau Résistance % -' => 216,
    		'Feu Résistance % -' => 218,
    		'Air Résistance % -' => 217,
    		'Neutre Résistance % -' => 219,
    		'Terre Résistance' => 240,
    		'Eau Résistance' => 241,
    		'Feu Résistance' => 243,
    		'Air Résistance' => 242,
    		'Neutre Résistance' => 244,
    		'Terre Résistance -' => 245,
    		'Eau Résistance -' => 246,
    		'Feu Résistance -' => 248,
    		'Air Résistance -' => 247,
    		'Neutre Résistance -' => 249,
    	);
    	return (isset($data[$this->type])) ? $data[$this->type] : NULL ;
    }

    //Affichage des effets encodés pour Dofus 1.29
    public function effects_encode()
    {
    	$data = array();
    	$this->effects = $this->textBetween($this->source, '<div class="item-effet"><h2>Effets</h2>', '</div>');
    	$explode = explode('<br/>', $this->effects);
    	$string = '';
        //On parcoure chaque bonus
    	foreach($explode as $pos => $bonus){
    		if(!empty($bonus)){
	    		$get1 = explode('<span style="color:', $bonus);
	    		if(!empty($get1[1])){
		    		$get3 = explode('">', $get1[1]);
		    		if(!empty($get3[1])){
			    		$get2 = explode('</span>', $get3[1]);
	                    //Récupération de la ligne en question
			    		$infos = explode(' ', $get2[0]);
			    		$type = '';
			    		$type .= $infos[count($infos) - 1];
	                    if(substr_count($get2[0], 'à') > 0){
	                    	if(substr_count($get2[0], ' ') >= 4){
	                    		$type .= ' '.$infos[count($infos) - 2];
	                    	}
	                    	if(substr_count($get2[0], '%') > 0){
	                    		$type .= ' %';
	                    	}
	                    	if(substr_count($get2[0], '-') > 0){
	                    		$type .= ' -';
	                    	}
	                    }
	                    else{
	                    	if(substr_count($get2[0], ' ') >= 2){
	                    		$type .= ' '.$infos[count($infos) - 2];
	                    	}
	                    	if(substr_count($get2[0], '%') > 0){
	                    		$type .= ' %';
	                    	}
	                    	if(substr_count($get2[0], '-') > 0){
	                    		$type .= ' -';
	                    	}
	                    }
		    		}
	    		}
                //Si l'élément n'est pas geré dans la fonction element() on le passe
	    		if($this->element($type) != NULL && !in_array($this->element($type), $data)){
                    //Récupération des valeurs
	    			$type = $this->element($type);
	    			$min = $infos[0];
	    			$min = (substr_count($get2[0], '-')) ? substr($infos[0], 1) : $min ;
	    			$max = (substr_count($get2[0], 'à') != 0) ? $infos[2] : 0 ;
	    			$max = (substr_count($get2[0], '-')) ? substr($max, 1) : $max ;
	    			array_push($data, $type);
                    //Génération des variables pour la partie random du jet
	    			$number1 = ($max == 0) ? 0 : 1 ;
                    $number3 = ($max == 0) ? $min : $min - 1;
                    $number2 = ($max == 0) ? 0 : $max - $number3 ;                    
                    //On sépare chaque bonus
	    			if($pos != 0){
	    				$string .= ',';
	    			}
                    //Génération du bonus
	    			$string .= dechex($type).'#'.dechex($min).'#'.dechex($max).'#0#'.$number1.'d'.$number2.'+'.$number3;
	    		}
    		}
    	}
    	return $string;
    }
}