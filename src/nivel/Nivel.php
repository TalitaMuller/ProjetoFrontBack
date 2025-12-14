<?php

    Class Nivel{

        private $id;
        private $ponto;
        private $exercicio;
        private $idGrupo;

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
        public function setExercicio($exercicio){
            $this->exercicio = $exercicio;
        }


        public function getIdGrupo(){
            return $this->idGrupo;
        }
        public function setIdGrupo($idGrupo){
            $this->idGrupo = $idGrupo;
        }

    }

?>