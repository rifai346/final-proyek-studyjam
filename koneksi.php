<?php

class database
{
    public $host = "localhost";
    public $user = "root";
    public $pass = "";
    public $db = "akademik";
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        // Mengecek apakah koneksi berhasil; jika gagal, tampilkan pesan error
        if ($this->conn->connect_error) {
            die("Gagal terhubung ke database: " . $this->conn->connect_error);
        }
    }

    public function __destruct()
    {
        $this->conn->close(); // Menutup koneksi saat objek dihancurkan
    }
}

class mahasiswa extends database
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function tampil_data()
    {
        $sql = "SELECT * FROM mahasiswa";
        $q = $this->conn->query($sql);

        $data = array();
        while ($r = $q->fetch_assoc()) {
            $data[] = $r;
        }
        return $data;
    }

    function tampil_data_by_id($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
        $stmt->bind_param("i", $id); // 'i' berarti integer
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Mengembalikan data mahasiswa sebagai array asosiatif
    }

    function tambah_data($nama, $nim, $prodi)
    {
        $stmt = $this->conn->prepare("INSERT INTO mahasiswa (nama, nim, prodi) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $nim, $prodi); // 'sss' berarti semua parameter adalah string
        return $stmt->execute(); // Mengembalikan hasil eksekusi
    }

    function update_data($id, $nama, $nim, $prodi)
    {
        $stmt = $this->conn->prepare("UPDATE mahasiswa SET nama=?, nim=?, prodi=? WHERE id=?");
        $stmt->bind_param("sssi", $nama, $nim, $prodi, $id); // 'sssi' berarti 3 string dan 1 integer
        return $stmt->execute(); // Mengembalikan hasil eksekusi
    }

    function hapus_data($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM mahasiswa WHERE id=?");
        $stmt->bind_param("i", $id); // 'i' berarti integer
        return $stmt->execute(); // Mengembalikan hasil eksekusi
    }
}
