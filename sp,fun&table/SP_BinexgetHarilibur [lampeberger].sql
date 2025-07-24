USE [lampeberger]
GO
/****** Object:  StoredProcedure [dbo].[SP_SimpanListTelpon]    Script Date: 05/24/2024 08:10:53 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[SP_BinexgetHarilibur]
@tahun int,
@bulan int
AS
BEGIN
	SELECT tanggal FROM [cuti_bmi].[dbo].hari_libur WHERE YEAR(tanggal)=@tahun AND MONTH(tanggal)=@bulan
END

GO
--EXEC SP_BinexgetHarilibur '2024','4'