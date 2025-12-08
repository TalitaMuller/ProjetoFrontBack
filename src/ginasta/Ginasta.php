<?php

    Class Ginasta{

        private $id;
        private $nome;
        private $anoNasc;
        private $foto;


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


        public function getAnoNasc(){
            return $this->anoNasc;
        }
        public function setAnoNasc($anoNasc){
            $this->anoNasc = $anoNasc;
        }


        public function getFoto(){
            return $this->foto;
        }
        public function setFoto($foto){
            $this->foto = $foto;
        }

    }

?>