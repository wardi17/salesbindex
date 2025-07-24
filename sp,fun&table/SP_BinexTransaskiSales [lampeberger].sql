ALTER PROCEDURE [dbo].[SP_BinexTransaskiSales]
@tahun int,
@bulan int
AS
BEGIN
  -- Hapus tabel sementara jika sudah ada sebelumnya
    IF OBJECT_ID('tempdb..#temptess') IS NOT NULL DROP TABLE #temptess;
    IF OBJECT_ID('tempdb..#temptess2') IS NOT NULL DROP TABLE #temptess2;
    IF OBJECT_ID('tempdb..#temptess3') IS NOT NULL DROP TABLE #temptess3;
    IF OBJECT_ID('tempdb..#temptess4') IS NOT NULL DROP TABLE #temptess4;
    IF OBJECT_ID('tempdb..#temptess5') IS NOT NULL DROP TABLE #temptess5;
    IF OBJECT_ID('tempdb..#temptess6') IS NOT NULL DROP TABLE #temptess6;

	
 create table #temptess(
    tanggal int NOT NULL,
    Hari datetime
 )
  create table #temptess2(
	id int IDENTITY(1,1) NOT NULL,
	Tgl int,
	Hari DATETIME,
	CORPORATE FLOAT,
	DEALER FLOAT,
	DEPSTORE FLOAT,
	STORE FLOAT,
	USERS FLOAT,
	ONLINE FLOAT
 );
 create table #temptess3(
	id int IDENTITY(1,1) NOT NULL,
	Tgl int,
	Hari DATETIME,
	CORPORATE FLOAT,
	DEALER FLOAT,
	DEPSTORE FLOAT,
	STORE FLOAT,
	USERS FLOAT,
	ONLINE FLOAT,
	TOTAL FLOAT
 );

  create table #temptess4(
	id int IDENTITY(1,1) NOT NULL,
	Tgl int,
	Hari DATETIME,
	CORPORATE FLOAT,
	DEALER FLOAT,
	DEPSTORE FLOAT,
	STORE FLOAT,
	USERS FLOAT,
	ONLINE FLOAT,
	TOTAL FLOAT,
	TOTAL_SEBLUM FLOAT,
 );

   create table #temptess5(
	id int IDENTITY(1,1) NOT NULL,
	Tgl int,
	Hari DATETIME,
	CORPORATE FLOAT,
	DEALER FLOAT,
	DEPSTORE FLOAT,
	STORE FLOAT,
	USERS FLOAT,
	ONLINE FLOAT,
	TOTAL FLOAT,
    ACCUMULATION FLOAT,
 );

create table #temptess6(
	id int IDENTITY(1,1) NOT NULL,
    Tgl int,
    Hari DATETIME,
    Corporate FLOAT,
    Dealer FLOAT,
    Depstore FLOAT,
    Store FLOAT,
    Users FLOAT,
    Online FLOAT,
    Total FLOAT,
    Accumulation FLOAT,
    Current_day_targets FLOAT,
    Achivement1 FLOAT,
    Projection FLOAT,
    Achivement2 FLOAT,
    TargetBulana FLOAT,
    TargetHarian FLOAT,
	TargetCorporate FLOAT,
    TargetDealer FLOAT,
	TargetDepstore FLOAT,
	TargetStore FLOAT,
	TargetUsers FLOAT,
	TargetOnline FLOAT,
	HariLibur int,
	Totalw1 FLOAT,
	Totalw2 FLOAT,
	Totalw3 FLOAT,
	Totalw4 FLOAT,
	Rowspan1 INT,
	Rowspan2 INT,
	Rowspan3 INT,
	Rowspan4 INT,
 );

 DECLARE @Hk INT;

  BEGIN
	SET @Hk = (SELECT MAX(tanggal) FROM [lampeberger].[dbo].[MothdayBindex]  WHERE tahun =@tahun AND bulan =@bulan);

	 INSERT INTO #temptess
    SELECT tanggal,(CAST(tahun AS  VARCHAR(10))+'-'+CAST(bulan AS VARCHAR(10))+'-'+CAST(tanggal AS VARCHAR(10))) as dt FROM  [lampeberger].[dbo].[MothdayBindex]  WHERE tahun =@tahun AND bulan =@bulan  ORDER BY  tanggal ASC;

		INSERT INTO #temptess2(Tgl,Hari,CORPORATE,DEALER,DEPSTORE,STORE,USERS,ONLINE)
		SELECT tanggal,Hari,
		[lampeberger].dbo.FunBindexCustClass('COR',Hari),
		[lampeberger].dbo.FunBindexCustClass('DEA',Hari),
		[lampeberger].dbo.FunBindexCustClass('DEP',Hari),
		[lampeberger].dbo.FunBindexCustClass('STO',Hari),
		[lampeberger].dbo.FunBindexCustClass('USE',Hari),
		[lampeberger].dbo.FunBindexCustClass('ONL',Hari)
		FROM #temptess
	END
	
	 BEGIN
	 INSERT INTO #temptess3
	   SELECT Tgl,Hari,CORPORATE,DEALER,DEPSTORE,STORE,USERS,ONLINE,
	  (CORPORATE+DEALER+DEPSTORE+STORE+USERS+ONLINE) as Total 
	  FROM #temptess2 
	 
	INSERT INTO #temptess5
	SELECT a.Tgl,a.Hari,a.CORPORATE,a.DEALER,a.DEPSTORE,a.STORE,a.USERS,a.ONLINE,a.TOTAL,
	(SELECT SUM(b.TOTAL) FROM #temptess3 as b  WHERE b.Tgl <= a.Tgl) AS Accumulation 	
	 FROM #temptess3 as a
	 END
	
	BEGIN

		DECLARE @targetHarian FLOAT;
		DECLARE @targetBulan FLOAT;
		DECLARE @libur int;
		 SET @targetBulan = (SELECT TargetAll FROM [lampeberger].[dbo].TargertBindexBulan WHERE tahun=@tahun AND bulan =@bulan); 
		 SET @targetHarian = (@targetBulan/@Hk);
		 SET @libur =(SELECT COUNT(*) libur FROM [cuti_bmi].[dbo].[hari_libur] WHERE YEAR(tanggal) =@tahun AND MONTH(tanggal)=@bulan);

		-- untuk w1
			DECLARE @w1star INT;
			DECLARE @w1and INT;
			DECLARE @totalw1 FLOAT;
			SET @w1star =(SELECT tgl_awal FROM  [lampeberger].[dbo].WeekBindex WHERE tahun=@tahun AND bulan=@bulan AND wilayah='w1');
			SET @w1and =(SELECT tgl_akhir FROM  WeekBindex WHERE tahun=@tahun AND bulan=@bulan AND wilayah='w1');
			SET @totalw1 =(SELECT COALESCE(SUM(TOTAL),0) FROM #temptess5  WHERE	Tgl BETWEEN	@w1star AND @w1and );
		
		--and w1
		-- untuk w2
			DECLARE @w2star INT;
			DECLARE @w2and INT;
			DECLARE @totalw2 FLOAT;
			SET @w2star =(SELECT tgl_awal FROM  [lampeberger].[dbo].WeekBindex WHERE tahun=@tahun AND bulan=@bulan AND wilayah='w2');
			SET @w2and =(SELECT tgl_akhir FROM  WeekBindex WHERE tahun=@tahun AND bulan=@bulan AND wilayah='w2');
			SET @totalw2 =(SELECT COALESCE(SUM(TOTAL),0) FROM #temptess5  WHERE	Tgl BETWEEN	@w2star AND @w2and );
		
		--and w2
		-- untuk w3
			DECLARE @w3star INT;
			DECLARE @w3and INT;
			DECLARE @totalw3 FLOAT;
			SET @w3star =(SELECT tgl_awal FROM  [lampeberger].[dbo].WeekBindex WHERE tahun=@tahun AND bulan=@bulan AND wilayah='w3');
			SET @w3and =(SELECT tgl_akhir FROM  WeekBindex WHERE tahun=@tahun AND bulan=@bulan AND wilayah='w3');
			SET @totalw3 =(SELECT COALESCE(SUM(TOTAL),0) FROM #temptess5  WHERE	Tgl BETWEEN	@w3star AND @w3and );
		
		--and w4
		-- untuk w4
			DECLARE @w4star INT;
			DECLARE @w4and INT;
			DECLARE @totalw4 FLOAT;
			SET @w4star =(SELECT tgl_awal FROM  [lampeberger].[dbo].WeekBindex WHERE tahun=@tahun AND bulan=@bulan AND wilayah='w4');
			SET @w4and =(SELECT tgl_akhir FROM  WeekBindex WHERE tahun=@tahun AND bulan=@bulan AND wilayah='w4');
			SET @totalw4 =(SELECT COALESCE(SUM(TOTAL),0) FROM #temptess5  WHERE	Tgl BETWEEN	@w4star AND @w4and );
		
		--and w4
		--rowspan week
		  DECLARE @rowspan1 INT;
		  DECLARE @rowspan2 INT;
		  DECLARE @rowspan3 INT;
		  DECLARE @rowspan4 INT;
		--and rowspan week
		 SET @rowspan1 =(SELECT tgl_akhir FROM [lampeberger].[dbo].WeekBindex WHERE tahun=@tahun AND bulan=@bulan AND wilayah='w1');
		  SET @rowspan2 =(SELECT tgl_akhir FROM [lampeberger].[dbo].WeekBindex WHERE tahun=@tahun AND bulan=@bulan AND wilayah='w2');
		   SET @rowspan3 =(SELECT tgl_akhir FROM [lampeberger].[dbo].WeekBindex WHERE tahun=@tahun AND bulan=@bulan AND wilayah='w3');
		    SET @rowspan4 =(SELECT tgl_akhir FROM [lampeberger].[dbo].WeekBindex WHERE tahun=@tahun AND bulan=@bulan AND wilayah='w4');
		--and set rowspan	
		INSERT INTO #temptess6 
		SELECT Tgl,Hari,CORPORATE,DEALER,DEPSTORE,STORE,USERS,ONLINE,TOTAL,ACCUMULATION,
		 CASE WHEN Tgl =1 THEN @targetHarian ELSE (@targetHarian * Tgl) END AS CURRENT_DAY_TARGETS,
		 ((ACCUMULATION /@targetBulan)* 100) AS ACHIVEMENT1, ((ACCUMULATION * @Hk) /Tgl) AS PROJECTION,
		 (((ACCUMULATION * @Hk) /Tgl) / @targetBulan * 100) AS ACHIVEMENT2,@targetBulan,@targetHarian,
		 (SELECT Target_Corporate FROM [lampeberger].[dbo].TargertBindexBulan WHERE tahun=@tahun AND bulan =@bulan),
		 (SELECT Target_Dealer FROM [lampeberger].[dbo].TargertBindexBulan WHERE tahun=@tahun AND bulan =@bulan),
		 (SELECT Target_Depstore FROM [lampeberger].[dbo].TargertBindexBulan WHERE tahun=@tahun AND bulan =@bulan),
		 (SELECT Target_Store FROM [lampeberger].[dbo].TargertBindexBulan WHERE tahun=@tahun AND bulan =@bulan),
		 (SELECT Target_User FROM [lampeberger].[dbo].TargertBindexBulan WHERE tahun=@tahun AND bulan =@bulan),
		 (SELECT Target_Online FROM [lampeberger].[dbo].TargertBindexBulan WHERE tahun=@tahun AND bulan =@bulan),
		 @libur,@totalw1,@totalw2,@totalw3,@totalw4,@rowspan1,@rowspan2,@rowspan3,@rowspan4
	

		 FROM #temptess5
	END
	
 SELECT * FROM #temptess6;
END





GO
EXEC SP_BinexTransaskiSales '2024','10'