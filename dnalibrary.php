<?php
class Gene
{
	private $dnaString;

	public static $dna_nucleotides = array('g','c','a','t');
	public static $rna_nucleotides = array('c','g','u','a');
	public static $3LetterChart = array(
		'UUU' => 'Phe', 'UCU' => 'Ser', 'UAU' => 'Tyr',  'UGU' => 'Cys',
		'UUC' => 'Phe', 'UCC' => 'Ser', 'UAC' => 'Tyr',  'UGC' => 'Cys',
		'UUA' => 'Leu', 'UCA' => 'Ser', 'UAA' => 'Stop', 'UGA' => 'Stop',
		'UUG' => 'Leu', 'UCG' => 'Ser', 'UAG' => 'Stop', 'UGG' => 'Trp',
		'CUU' => 'Leu', 'CCU' => 'Pro', 'CAU' => 'His',
		'CUC' => 'Leu', 'CCC' => 'Pro', 'CAC' => 'His',
		'CUA' => 'Leu', 'CCA' => 'Pro', 'CAA' => 'Glu',
		'CUG' => 'Leu', 'CCG' => 'Pro', 'CAG' => 'Glu',
	);

	public __construct($string) {
		$this->dnaString = strtoupper($this->removeChars($string));
	}

	public function returnDNA() {
		return $this->dnaString;
	}

	public function returnTotalBaseCount() {
		return strlen($this->dnaString);
	}

	public function returnBaseCount($base) {
		if (strlen($base) > 1) {
			throw new Exception('The length of the base must be one character in length.');
		}

		if (!in_array($this->dna_nucleotides, $base)) {
			throw new Exception("The value passed is not a valid nucleotide.");
		}
		return substr_count($this->dnaString, $base);
	}

	public function removeChars($string) {
		$chars = array('b','d','e','f','h','i','j','k','l','m','n','o','p','q','r','s','u','v','w','x','y','z');
		return str_replace($chars, "", $string);
	}

	public function returnRNA() {
		$rna = '';
		$onerep = array('1','2','3','4');
		$rna = str_replace($this->dna_nucleotides, $onerep, $this->dnaString);
		$rna = str_replace($onerep, $this->rna_nucleotides, $this->dnaString);
		return $rna;
	}

	public function returnGCContent(){
		return ($this->returnBaseCount('G') + $this->returnBaseCount('C')) / ($this->returnTotalBaseCount());
	}
}
?>