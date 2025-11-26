<?php
class Block {
    public $index;
    public $timestamp;
    public $data;
    public $previousHash;
    public $hash;
    public function __construct($index, $data, $previousHash){
        $this->index = $index;
        $this->timestamp = date("Y-m-d H:i:s");
        $this->data = $data;
        $this->previousHash = $previousHash;
        $this->hash = $this->computeHash();
    }
    private function computeHash(){
        return hash('sha256', $this->index.$this->timestamp.$this->data.$this->previousHash);
    }
}
?>