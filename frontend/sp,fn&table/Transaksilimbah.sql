CREATE TABLE HeaderTransaksiLimbah(
    id_transo  varchar(50) NOT NULL,
    nama_petugas VARCHAR(150) NULL,
    jabatan VARCHAR(10) NULL,
    divisi VARCHAR(10) NULL,
    Tanggal DATETIME,
    userlog VARCHAR(150) NULL,
    las_akses DATETIME,
    typehp VARCHAR(150),
    lat FLOAT NOT NULL ,
    lng FLOAT NOT NULL,
    PRIMARY KEY(id_transo)
);

CREATE TABLE DetailTransaksiLimbah(
    item_no int,
     id_transo  varchar(50) NOT NULL,
     jenis_limbah VARCHAR(100) NOT NULL,
     berat FLOAT DEFAULT 0,
     pcs FLOAT  DEFAULT 0,
     total_kg FLOAT DEFAULT 0,
     harga FLOAT DEFAULT 0,
     subtotal FLOAT DEFAULT 0,
     images TEXT
);



