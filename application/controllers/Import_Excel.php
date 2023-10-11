<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Import_Excel extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (ENVIRONMENT !== 'development') show_404();
	}

	/**
	 * Input items
	 * 
	 * @param    string    $file    path file
	 * @return   void
	 */
	public function items($file)
	{
		$hasil = 'berhasil';
		$pesan = 'Import data berhasil';

		// $start = microtime(TRUE);

		$reader = ReaderEntityFactory::createXLSXReader();

		$reader->open('uploads/file_excel/'.$file);

		$item       = [];
		$etalase    = [];
		$etalase_id = 1;

		foreach ($reader->getSheetIterator() as $sheet) {
			$numRow = 1;

			foreach ($sheet->getRowIterator() as $row) {
				if ($numRow > 1) {

					// field yg tidak boleh NULL berdasarkan skema database tabel produk
					$item_code = $row->getCellAtIndex(1)->getValue();
					$item_name = $row->getCellAtIndex(2)->getValue();
					$category  = $row->getCellAtIndex(6)->getValue();

					// jika field di atas ada yang kosong maka keluar loop untuk berhenti mengambil data di file excel
					if (
						empty($item_code) ||
						empty($item_name) ||
						empty($category)
					) {

						$hasil = 'gagal';
						$pesan = 'Terdapat baris pada spreadsheet yang tidak sesuai format. Periksa kembali data yang harus diisi.'.PHP_EOL.PHP_EOL.
							'Kemungkinan kesalahan berada pada baris ke-' . $numRow;

						break 2;
					}


					if (! array_key_exists($category, $etalase)) {
						$etalase[$category] = [
							'id_etalase'   => $etalase_id++,
							'nama_etalase' => $category,
							'id_ke'        => '1'
						];
					}

					array_push($item, array(
						'no_item'         => $item_code,
						'nama_item'       => $item_name,
						'uom'             => $row->getCellAtIndex(3)->getValue(),
						'id_etalase'      => $etalase[$category]['id_etalase'],
					));
				}

				$numRow++;
			}
		}

		$reader->close();

		// $finish = microtime(TRUE);

		if ($hasil === 'berhasil') {
			$this->load->model('Model_index');
			$this->Model_index->import_item($etalase, $item);
		}

		echo $pesan;

		// $limit = count($item) < 25 ? count($item) : 25;
		// for ($i=0; $i < 123; $i++) { 
		// 	print_r($item[$i]);
		// }

		// print_r(array_values($etalase));
		// // echo PHP_EOL;
		// // echo ($finish - $start)." - ".($finish - $start)*20;
		// die();
	}
}
