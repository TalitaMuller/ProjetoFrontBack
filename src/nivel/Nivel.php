<?php

    Class Nivel{

        private $id;
        private $ponto;
        private $exercicio;


        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }


        public function getPonto(){
            return $this->nome;
        }
        public function setPonto($ponto){
            $this->ponto = $ponto;
        }


        public function getExercicio(){
            return $this->exercicio;
        }
        public function setexercicio($exercicio){
            $this->exercicio = $exercicio;
        }

    }

?>