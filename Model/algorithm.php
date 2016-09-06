<?php
/* Nick Thomas and Andrew Stoddard
University of Utah
cs4000 - Capstone
4/17/2016
CSynapse
*/

class Algorithm
{
    public $name, $status, $value, $data;

    public function __construct( $name, $status, $value, $data ){
        $this->name = $name;
        $this->status = $status;
        $this->value = $value; 
        $this->data = $data; 
    }

}

?>