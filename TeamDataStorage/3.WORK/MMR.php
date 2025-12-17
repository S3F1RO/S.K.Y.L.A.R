<?php
include_once("./node.php");

class MMR {
    public $nodes;

    function __toconstruct(){
        $this->nodes = [];
    }
    function getNode($idNode){
        $node = $this->nodes[$idNode];
        return $node;
    }
    function getNodeLevel($idNode){
        $node=$this->getNode($idNode);
        return $node->level;
    }
    function addLeaf($node){
        $this->nodes[]=$node;
    }
    function getPeakOfLevel($level){
        for ($i=0; $i < count($this->nodes) ; $i++){
            $this->getNodeLevel($this->nodes[$i]->idNode);
            if ($this->nodes[$i]['isPeak']) echo json_encode($nodes[$i]);
        }
    }
}

$testNode = new Node(0,"xxc",1,NULL,NULL,true);
$testNode2 = new Node(1,"xxc",1,1,2,true);
$testPeak = new Node(2,"xxc",2,0,1,true);

$MMR = new MMR();
$MMR->addLeaf($testNode);
$MMR->addLeaf($testNode2);
$MMR->addLeaf($testPeak);
$node0=$MMR->getNode(0);
// echo "-----------------Get Node Level -------------------\n";
// echo json_encode($MMR->getNodeLevel(0));
// echo "\n";
// echo json_encode($MMR->getNodeLevel(1));
// echo "\n";
// echo json_encode($MMR->getNodeLevel(2));
// echo "\n";
// echo json_encode($MMR,JSON_PRETTY_PRINT);
// echo "-----------------Get MMR-------------------\n";
// echo json_encode($MMR,JSON_PRETTY_PRINT);
// echo "\n-----------------Get Node------------------\n";
// echo json_encode($node0,JSON_PRETTY_PRINT);
echo "\n-----------------Get Peak Of Level------------------\n";

echo $MMR->getPeakOfLevel(1);


?>