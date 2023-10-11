<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Update_Id_User extends CI_Migration
{
	public function up()
	{
		echo PHP_EOL."--- Migrasi 1 ---".PHP_EOL;

		$this->db->query('ALTER TABLE pengumuman DROP FOREIGN KEY pengumuman_ibfk_2');
		$this->db->query('ALTER TABLE pengumuman CHANGE id_admin id_user INT(9) NOT NULL');
		echo "Kolom `id_admin` diubah menjadi `id_user` di tabel pengumuman".PHP_EOL;

		$this->db->query('ALTER TABLE pengumuman ADD FOREIGN KEY (id_user) REFERENCES user(id_user)');
		echo "Ubah foreign key id_user di tabel pengumuman".PHP_EOL;
	}

	public function down()
	{
		echo PHP_EOL."--- Migrasi 1 ---".PHP_EOL;

		// harus truncate tabel pengumuman dulu
		$this->db->query('ALTER TABLE pengumuman DROP FOREIGN KEY pengumuman_ibfk_2');
		$this->db->query('ALTER TABLE pengumuman CHANGE id_user id_admin INT(9)');
		echo "Kolom `id_user` diubah menjadi `id_admin` di tabel pengumuman".PHP_EOL;

		$this->db->query('ALTER TABLE pengumuman ADD FOREIGN KEY (id_admin) REFERENCES admin(id_admin)');
		echo "Ubah foreign key id_user di tabel pengumuman".PHP_EOL;
	}
}
