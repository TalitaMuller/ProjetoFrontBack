<?php

    Class Turma{

        private $id;
        private $nome;
        private $idEntidade;

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


        public function getIdEntidade() {
            return $this->idEntidade;
        }
        public function setIdEntidade($idEntidade) {
            $this->idEntidade = $idEntidade;
        }
    }

?>