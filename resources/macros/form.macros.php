<?php 

/**
* For generating form fields
*/

function inputField($type,$name,$value=NULL,$placeholder =NULL, $required=NULL)
{
	$label = '<label for='.$name.'>'.ucfirst($name).'</label>';
    return $label.'<input type="'.$type.'" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" '.$required.'">';
}