<?php

// Classe ISBN
// Author : Emilie Rollandin

class ISBN {

    private $_ISBNn = array();
    private $_ISBNc = array();
    private $_ini = "101";
    private $_med = "01010";
    private $_fin = "101";
    
    function Codifica($ISBN) {
        
        // Verifica che il codice sia numerico
        if(!is_numeric($ISBN))
        {
            throw new Exception("ISBN deve essere composto solo da numeri");
        }
        
        // Converti la stringa in un array
        $this->_ISBNn = str_split($ISBN);
        
        // Verifica che sia un ISBN
        if($this->_ISBNn[0]!=='9')
        {
            throw new Exception("ISBN deve cominciare con un 9");
        }
        
        // 0=A, 1=B
        $codI[0] = "000000";
        $codI[1] = "001011";
        $codI[2] = "001101";
        $codI[3] = "001110";
        $codI[4] = "010011";
        $codI[5] = "011001";
        $codI[6] = "011100";
        $codI[7] = "010101";
        $codI[8] = "010110";
        $codI[9] = "011010";

        // CODIFICA A
        $codA[0] = "0001101";
        $codA[1] = "0011001";
        $codA[2] = "0010011";
        $codA[3] = "0111101";
        $codA[4] = "0110001";
        $codA[5] = "0110001";
        $codA[6] = "0101111";
        $codA[7] = "0111011";
        $codA[8] = "0110111";
        $codA[9] = "0001011";

        // CODIFICA B
        $codB[0] = "0100111";
        $codB[1] = "0110011";
        $codB[2] = "0011011";
        $codB[3] = "0100001";
        $codB[4] = "0011101";
        $codB[5] = "0111001";
        $codB[6] = "0000101";
        $codB[7] = "0010001";
        $codB[8] = "0001001";
        $codB[9] = "0010111";

        // CODIFICA C
        $codC[0] = "1110010";
        $codC[1] = "1100110";
        $codC[2] = "1101100";
        $codC[3] = "1000010";
        $codC[4] = "1011100";
        $codC[5] = "1001110";
        $codC[6] = "1010000";
        $codC[7] = "1000100";
        $codC[8] = "1001000";
        $codC[9] = "1110100";
        
        // SE INIZIA CON 9 "011010" -> ABBABA
        
        $cod[2] = $codA[$this->_ISBNn[2-1]];
        $cod[3] = $codB[$this->_ISBNn[3-1]];
        $cod[4] = $codB[$this->_ISBNn[4-1]];
        $cod[5] = $codA[$this->_ISBNn[5-1]];
        $cod[6] = $codB[$this->_ISBNn[6-1]];
        $cod[7] = $codA[$this->_ISBNn[7-1]];
        
        $cod[8] = $codC[$this->_ISBNn[8-1]];
        $cod[9] = $codC[$this->_ISBNn[9-1]];
        $cod[10] = $codC[$this->_ISBNn[10-1]];
        $cod[11] = $codC[$this->_ISBNn[11-1]];
        $cod[12] = $codC[$this->_ISBNn[12-1]];
        $cod[13] = $codC[$this->_ISBNn[13-1]];
        
        // Implementare successivamente se si vuole gestire tutto il EAN13
        
        // CREA ARRAY CON I VARI 7 bit
        $risultato = array($this->_ini, $cod[2], $cod[3], $cod[4], $cod[5], $cod[6], $cod[7], $this->_med, $cod[8], $cod[9], $cod[10], $cod[11], $cod[12], $cod[13], $this->_fin);
        
        // COPIA NELLA VARIABILE PRIVATA
        $this->_ISBNc = $risultato;
        return implode("", $this->_ISBNc);
    }

    // METODO CHE RESTITUISCE LA STRINGA CON L'ISBN
    function getISBN() {
        return implode("", $this->_ISBNc);
    }
    
    function getISBNarray() {
        return $this->_ISBNc;
    }
}
?>