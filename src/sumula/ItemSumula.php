<?php

    Class ItemSumula{

        private $id;
        private $idGinasta;
        private $idNivel;

        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }


        public function getIdGinasta(){
            return $this->idGinasta;
        }
        public function setIdGinasta($idGinasta){
            $this->idGinasta = $idGinasta;
        }


        public function getIdNivel(){
            return $this->idNivel;
        }
        public function setIdNivel($idNivel){
            $this->idNivel = $idNivel;
        }

    }

?>