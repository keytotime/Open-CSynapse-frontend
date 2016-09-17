<?php
/* Nick Thomas and Andrew Stoddard
University of Utah
cs4000 - Capstone
4/17/2016
CSynapse
*/

require '../Model/algorithm.php';

class CSynapse
{
    public $id, $name, $algorithms, $completion, $type, $size, $graphdata;

    public function __construct( $fetch ){
        $this->id = $fetch;
        $this->name = "";
        $this->algorithms = array();
        $this->completion = 0;
        $this->size = 0;
        $this->type = "Vector";
        $this->populate( );
        
    }

    /* Fetches the information from a specific user from the db */
    private function populate ( ){
        $url = "localhost:8888/app/check?id=" . $this->id;
        $json = file_get_contents($url);
        $allobj = json_decode($json);

        foreach($allobj as $obj){
            if($obj->{'algorithm'} != 'graphData'){
                $algo = new algorithm($obj->{'algorithm'}, $obj->{'status'}, $obj->{'value'}, json_decode($obj->{'return_object'}));
                array_push($this->algorithms, $algo);
                $this->name = $obj->{'description'};
                $this->completion = $this->completion + $obj->{'status'};
            }
            else{
                $this->graphdata = json_decode($obj->{'return_object'});
            }

        }
        $this->size = count($this->algorithms);

        if($this->size > 0){
            $this->completion = $this->completion / count($this->algorithms);
        }

        
    }
}

?>