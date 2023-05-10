<?php 
	function clean($str) 
	{
	    // Verilen metindeki HTML etiketlerini temizleme ve baştaki ve sondaki boşlukları kırpma
	    $data = htmlspecialchars(strip_tags(trim($str)));
	    return $data;
	}

	function safe_data($str)
	{
	    // Verilen metindeki HTML özel karakterlerini orijinal hallerine dönüştürme
	    $data = htmlspecialchars_decode($str);
	    return $data;
	}
?>