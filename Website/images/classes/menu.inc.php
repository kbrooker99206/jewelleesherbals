<?php

/*********************************
* xpandMenu class
**********************************
*
* Given a set of parent and child
* nodes, this class generates an
* organised menu with expand/collapse
* function.
* The menu is enterely rendered using
* DIVs, hence it can be fully
* personnalised using CSS rules.
* The expand/collapse function is
* done by javascript the class
* also generates.
*
**********************************
* How to use the class
**********************************
*
* Include the class file
* include('menu.inc.php');
* $myMenu = new xPandMenu();
* $myMenu->addParent($name[,$link]);
* $myMenu->addChild($name[,$link]);
*	Optionnaly, set an image that will be
* used as the parent node expand/collapse
* box (you may also set the left and right
* margin to position the image)
* $myMenu->setXCbox(array("c"=>"absolutePathToClosedBoxImage","o"=>"absolutePathToOpenBoxImage"),array("l"=>imageLeftMargin,"r"=>imageRightMargin));
*
* Add parents and children
* $myMenu->addParent($name[,$link]);
* $myMenu->addChild($name[,$link]);
*
* When entering a child node, it is
* added into the last parent added and
* follows the last child added.
* When entering a new parent, the previous
* parent is closed.
* Just remember to enter your items in
* the order you would like to see them.
*
**********************************
*
* Patrick Brosset 2004
* patrickbrosset@gmail.com
*
**********************************
*/
class xpandMenu {


	/* VARIABLES */
	
	// Array containing all the parent nodes in order
	var $parents = array();
	// Array containing, in each cell, an array of children
	var $children = array();
	// Index of the current parent, used to store the children at the right index in the $children Array
	var $countParent;
	// Index of the current child, used to number xChild objects
	var $currentChildID;
	// String containing the generated javscript for expanding/collapsing the menus (and optionnaly, swapping the box images)
	var $javaScript;
	// String containing the absolute path to the box image (for parent nodes) in its closed state
	var $boxC;
	// String containing the absolute path to the box image (for parent nodes) in its opened state
	var $boxO;
	// Int containing the number of pixels to used as left margin of the box image
	var $boxImgMarginL;
	// Int containing the number of pixels to used as right margin of the box image
	var $boxImgMarginR;

	
	/* CONSTRUCTOR */
	
	function xpandMenu(){
	
		$this->countParent = 0;
		$this->currentChildID = 0;
	
	}//xpandMenu constructor


	/* EXTERNAL FUNCTIONS */
	
	// setXCbox : The use of this function is optional, it allows the use of an image for the parent nodes x/c box
	function setXCbox($imgs = array(),$margin = array()){
		
		if(isset($imgs['c']) && isset($imgs['o'])){
			$this->boxC = $imgs['c'];
			$this->boxO = $imgs['o'];
		}
		if(isset($margin['l']) && isset($margin['r'])){
			$this->boxImgMarginL = $margin['l'];
			$this->boxImgMarginR = $margin['r'];
		}
		
	}//setXCbox
	
	
	// addParent : Appends a new parent in the menu list
	function addParent($title,$link = false){
		
		$this->countParent ++;
		$newParent = new xParent($title,$link);
		$this->parents[$this->countParent] = $newParent;
		
	}//addParent


	// addChild : Appends a new child in the menu list and under the last parent added
	function addChild($title,$link = false){
		
		$this->currentChildID ++;
		$newChild = new xChild($this->currentChildID,$title,$link);
		$this->children[$this->countParent][] = $newChild;
		
	}//addChild
	
	
	// generateMenu : Lists the parents and children and generates both html and javascript code
	// The code is ready to be use in the webpage to display the menu
	function generateMenu(){
		
		foreach($this->parents as $index=>$parent){
			
			if(!empty($parent)){
				
				//Opening the parent DIV
				$str .= "<div id=\"parentX\" onClick=\"xMenu".$index."();\">";
				
				//Adding the XC images if it is set
				if(isset($this->boxC) && isset($this->boxO)){
					$str .= "<img src=\"".$this->boxC."\" border=\"0\" id=\"xcBox".$index."\" style=\"margin-right:".$this->boxImgMarginR."px;margin-left:".$this->boxImgMarginL."px;\">";
				}
				
				//This parent may have a link on itself to display
				if(empty($parent->link)){
					$str .= $parent->title."</div>\n";
				}else{
					$str .= "<a href=\"".$parent->link."\">".$parent->title."</a></div>\n";
				}
				
				//If this parent has children (1 or more)
				if(isset($this->children[$index])){

					//create the js for showing/hiding the children
					$this->jsOnClickStr($index);
					
					//List the children of this parent
					foreach($this->children[$index] as $child){
						
						if(empty($child->link)){
							$str .= "	<div id=\"xChild".$child->id."\" style=\"display:none;\"><div id=\"childX\"><span style=\"cursor:text;\">".$child->title."</span></div></div>\n";
						}else{
							$str .= "	<div id=\"xChild".$child->id."\" style=\"display:none;\"><div id=\"childX\"><a href=\"".$child->link."\">".$child->title."</a></div></div>\n";
						}
							
					}//for each child
					
				}//if there are one or more children

			}//if not empty
		
		}//for each parent
		
		return array("html"=>$str,"js"=>$this->javaScript);
		
	}//generateMenu


	/* INTERNAL FUNCTIONS */

	// jsOnClickStr : Called by the function 'generateMenu', this function create the correct
	// javascript for showing or hiding a specific parent's children
	function jsOnClickStr($index){
	
		$str .= "function xMenu".$index."(){\n";
		foreach($this->children[$index] as $child){
			$str .= "	if(document.getElementById('xChild".$child->id."').style.display=='none'){document.getElementById('xChild".$child->id."').style.display='block';}else{document.getElementById('xChild".$child->id."').style.display='none';}\n";
		}
		//Adding the script to swap the XC box image when clicked
		if(isset($this->boxC) && isset($this->boxO)){
			$str .= "	if(document.getElementById('xcBox".$index."').src == '".$this->boxC."'){document.getElementById('xcBox".$index."').src = '".$this->boxO."';}else{document.getElementById('xcBox".$index."').src = '".$this->boxC."';}\n";
		}
		$str .= "}\n";
		$this->javaScript .= $str;
	
	}//jsOnClickStr


}//class xpandMenu



/* INTERNAL CLASSES */


// xParent : Created by the 'xpandMenu' object, contains all information about a specific parent
class xParent {
	
	var $title;
	var $link;
	
	function xParent($title,$link = false){
		
		$this->title = $title;
		$this->link = $link;
		
	}//xParent constructor
	
}//xParent


// xChild : Created by the 'xpandMenu' object, contains all information about a specific child
class xChild {

	var $title;
	var $link;
	var $id;
	
	function xChild($id,$title,$link = false){
		
		$this->id = $id;
		$this->title = $title;
		$this->link = $link;
	
	}//xChild constructor

}//xChild



?>