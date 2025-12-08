<?php

    Class Aparelho{

        private $id;
        private $nome;
        private $quantExerc;


        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }


        public function getNome(){
            return $this->nome;
        }
        public function setNome($nome){
            $this->nome = $nome;
        }


        public function getQuantExerc(){
            return $this->quantExerc;
        }
        public function setQuantExerc($quantExerc){
            $this->quantExerc = $quantExerc;
        }

    }

?>