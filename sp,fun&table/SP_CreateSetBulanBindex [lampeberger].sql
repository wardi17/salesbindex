USE [lampeberger]
GO
/****** Object:  StoredProcedure [dbo].[SP_SimpanListTelpon]    Script Date: 05/24/2024 08:10:53 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_CreateSetBulanBindex]
@tgl int,
@bulan int,
@tahun int
AS
BEGIN
	INSERT INTO [lampeberger].[dbo].MothdayBindex(tanggal,bulan,tahun)VALUES(@tgl,@bulan,@tahun)
END
--SELECT * FROM [lampeberger].[dbo].MothdayBindex WHERE tanggal=@tgl AND  bulan=@bulan AND tahun=@tahun

GO
--EXEC SP_CreateSetBulanBindex '1','4','2023'