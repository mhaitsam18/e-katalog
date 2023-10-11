<?php

if (! function_exists('d'))
{
	/**
	 * Dump data apa saja dengan print_r()
	 * 
	 * @param    mixed    $data     Data yang mau di-dump
	 * @param    bool     $isVarDump    Apakah ingin menggunakan var_dump()
	 * @return   mixed
	 */
	function d($data, $isVarDump = FALSE)
	{
		// echo __FILE__;
		echo '<pre>';
		$isVarDump ? var_dump($data) : print_r($data);
		echo '</pre>';
	}
}

if (! function_exists('dd'))
{
	/**
	 * Print data apa saja dengan print_r()
	 * dan menghentikan eksekusi php setelah dump
	 * 
	 * @param   mixed    $data    Data yang mau di-dump
	 * @param   bool     $isVarDump    Apakah ingin menggunakan var_dump()
	 * @return  mixed
	 */
	function dd($data, $isVarDump = FALSE)
	{
		d($data, $isVarDump);
		die();
	}
}
