USE [um_db]
GO
/****** Object:  StoredProcedure [dbo].[SP_SimpanListTelpon]    Script Date: 05/24/2024 08:10:53 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_GetPetugas]
@tanggal datetime
AS
BEGIN
	SELECT a.tanggal,a.jam,b.nama,b.jabatan,b.divisi,b.jabatan FROM [um_db].[dbo].JadwalPetugas as a
	INNER JOIN [um_db].[dbo]. Petugas as b   ON b.id_petugas=a.id_petugas
	WHERE a.tanggal = convert(datetime,@tanggal,103)
END
	
GO
EXEC SP_GetPetugas '2024/07/25'