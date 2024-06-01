<?php 
class t_jawaban_mahasiswa {
    public $db;
    protected $table = 't_jawaban_mahasiswa';

    public function __construct($db) {
        $this->db = $db;
        $this->db->set_charset('utf8');
    }

    public function insertData($data) {
        // prepare statement untuk query insert
        $query = $this->db->prepare("INSERT INTO {$this->table} (responden_mahasiswa_id, soal_id, jawaban) VALUES (?, ?, ?)");

        // binding parameter ke query, "iis" berarti integer, integer, string
        $query->bind_param('iis', $data['responden_mahasiswa_id'], $data['soal_id'], $data['jawaban']);

        // eksekusi query untuk menyimpan ke database
        $query->execute();

        // Tutup statement setelah selesai
        $query->close();
    }

    public function getData() {
        // query untuk mengambil data dari tabel t_jawaban_mahasiswa
        return $this->db->query("SELECT * FROM {$this->table}");
    }

    public function getDataById($id) {
        // query untuk mengambil data berdasarkan id
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE t_jawaban_mahasiswa_id = ?");
        
        // binding parameter ke query "i" berarti integer. Biar tidak kena SQL Injection
        $query->bind_param('i', $id);

        // eksekusi query
        $query->execute();

        // ambil hasil query
        $result = $query->get_result();

        // Tutup statement setelah selesai
        $query->close();

        return $result;
    }

    public function updateData($id, $data) {
        // query untuk update data
        $query = $this->db->prepare("UPDATE {$this->table} SET jawaban = ? WHERE t_jawaban_mahasiswa_id = ?");

        // binding parameter ke query
        $query->bind_param('si', $data['jawaban'], $id);

        // eksekusi query
        $query->execute();

        // Tutup statement setelah selesai
        $query->close();
    }

    public function deleteData($id) {
        // query untuk delete data
        $query = $this->db->prepare("DELETE FROM {$this->table} WHERE t_jawaban_mahasiswa_id = ?");

        // binding parameter ke query
        $query->bind_param('i', $id);

        // eksekusi query
        $query->execute();

        // Tutup statement setelah selesai
        $query->close();
    }
}
?>
