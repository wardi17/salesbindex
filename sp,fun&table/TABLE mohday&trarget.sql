CREATE TABLE MothdayBindex(
    tanggal int,
    bulan int,
    tahun int
);


CREATE TABLE TargertBindexBulan(
    TargetAll FLOAT  DEFAULT 0,
    Target_Corporate FLOAT  DEFAULT 0,
    Target_Dealer FLOAT  DEFAULT 0,
    Target_Depstore FLOAT  DEFAULT 0,
    Target_Store FLOAT  DEFAULT 0,
    Target_User FLOAT  DEFAULT 0,
    Target_Online FLOAT  DEFAULT 0,
    bulan int,
    tahun int
);

UPDATE TargertBindexBulan SET Target_Online=300000000
WHERE bulan IN(11,12) AND tahun=2024


UPDATE TargertBindexBulan SET Target_Dealer=250000000,Target_Depstore=335000000,Target_Store=90000000,Target_User=50000000,Target_Online=350000000
WHERE bulan=8 AND tahun=2024


INSERT INTO TargertBindexBulan(TargetAll,Target_Corporate,Target_Dealer,Target_Depstore,Target_Store,Target_User,Target_Online,bulan,tahun)
VALUES(1275000000,2000000000,2000000000,2000000000,2000000000,2000000000,2000000000,8,2024)


INSERT INTO TargertBindexBulan(TargetAll,Target_Corporate,Target_Dealer,Target_Depstore,Target_Store,Target_User,Target_Online,bulan,tahun)
VALUES(1275000000,2000000000,2000000000,2000000000,2000000000,2000000000,2000000000,2,2024)

INSERT INTO TargertBindexBulan(TargetAll,Target_Corporate,Target_Dealer,Target_Depstore,Target_Store,Target_User,Target_Online,bulan,tahun)
VALUES(1275000000,2000000000,2000000000,2000000000,2000000000,2000000000,2000000000,1,2024)

INSERT INTO TargertBindexBulan(TargetAll,Target_Corporate,Target_Dealer,Target_Depstore,Target_Store,Target_User,Target_Online,bulan,tahun)
VALUES(1275000000,2000000000,2000000000,2000000000,2000000000,2000000000,2000000000,3,2024)

INSERT INTO TargertBindexBulan(TargetAll,Target_Corporate,Target_Dealer,Target_Depstore,Target_Store,Target_User,Target_Online,bulan,tahun)
VALUES(1275000000,2000000000,2000000000,2000000000,2000000000,2000000000,2000000000,4,2024)

INSERT INTO TargertBindexBulan(TargetAll,Target_Corporate,Target_Dealer,Target_Depstore,Target_Store,Target_User,Target_Online,bulan,tahun)
VALUES(1275000000,2000000000,2000000000,2000000000,2000000000,2000000000,2000000000,5,2024)

INSERT INTO TargertBindexBulan(TargetAll,Target_Corporate,Target_Dealer,Target_Depstore,Target_Store,Target_User,Target_Online,bulan,tahun)
VALUES(1275000000,2000000000,2000000000,2000000000,2000000000,2000000000,2000000000,6,2024)

INSERT INTO TargertBindexBulan(TargetAll,Target_Corporate,Target_Dealer,Target_Depstore,Target_Store,Target_User,Target_Online,bulan,tahun)
VALUES(1275000000,2000000000,2000000000,2000000000,2000000000,2000000000,2000000000,7,2024)

INSERT INTO TargertBindexBulan(TargetAll,Target_Corporate,Target_Dealer,Target_Depstore,Target_Store,Target_User,Target_Online,bulan,tahun)
VALUES(1275000000,2000000000,2000000000,2000000000,2000000000,2000000000,2000000000,9,2024)

INSERT INTO TargertBindexBulan(TargetAll,Target_Corporate,Target_Dealer,Target_Depstore,Target_Store,Target_User,Target_Online,bulan,tahun)
VALUES(1275000000,2000000000,2000000000,2000000000,2000000000,2000000000,2000000000,10,2024)

INSERT INTO TargertBindexBulan(TargetAll,Target_Corporate,Target_Dealer,Target_Depstore,Target_Store,Target_User,Target_Online,bulan,tahun)
VALUES(1275000000,2000000000,2000000000,2000000000,2000000000,2000000000,2000000000,11,2024)

INSERT INTO TargertBindexBulan(TargetAll,Target_Corporate,Target_Dealer,Target_Depstore,Target_Store,Target_User,Target_Online,bulan,tahun)
VALUES(1275000000,2000000000,2000000000,2000000000,2000000000,2000000000,2000000000,12,2024)






CREATE TABLE WeekBindex(
  id int IDENTITY(1,1),
  tgl_awal INT NOT NULL,
  tgl_akhir INT NOT NULL,
  wilayah VARCHAR(2),
  tahun int,
  bulan int,
  PRIMARY KEY(Id)
)

INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(1,7,'w1',2024,1);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(8,14,'w2',2024,1);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(15,21,'w3',2024,1);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(22,31,'w4',2024,1);


INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(1,4,'w1',2024,2);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(5,11,'w2',2024,2);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(12,18,'w3',2024,2);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(19,29,'w4',2024,2);

INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(1,3,'w1',2024,3);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(4,10,'w2',2024,3);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(11,17,'w3',2024,3);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(18,31,'w4',2024,3);

INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(1,7,'w1',2024,4);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(8,14,'w2',2024,4);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(15,21,'w3',2024,4);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(21,30,'w4',2024,4);

INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(1,4,'w1',2024,5);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(5,12,'w2',2024,5);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(13,19,'w3',2024,5);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(20,31,'w4',2024,5);

INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(1,2,'w1',2024,6);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(3,9,'w2',2024,6);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(10,16,'w3',2024,6);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(17,30,'w4',2024,6);


INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(1,7,'w1',2024,7);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(8,14,'w2',2024,7);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(15,21,'w3',2024,7);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(22,31,'w4',2024,7);

INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(1,4,'w1',2024,8);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(5,11,'w2',2024,8);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(12,18,'w3',2024,8);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(19,31,'w4',2024,8);

INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(1,8,'w1',2024,9);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(9,15,'w2',2024,9);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(16,22,'w3',2024,9);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(23,30,'w4',2024,9);


INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(1,6,'w1',2024,10);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(7,13,'w2',2024,10);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(14,20,'w3',2024,10);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(21,31,'w4',2024,10);


INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(1,3,'w1',2024,11);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(4,10,'w2',2024,11);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(11,17,'w3',2024,11);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(18,30,'w4',2024,11);

INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(1,8,'w1',2024,12);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(9,15,'w2',2024,12);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(16,22,'w3',2024,12);
INSERT INTO WeekBindex(tgl_awal,tgl_akhir,wilayah,tahun,bulan)
VALUES(23,31,'w4',2024,12);