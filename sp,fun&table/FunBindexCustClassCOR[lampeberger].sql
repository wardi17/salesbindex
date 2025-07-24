ALTER FUNCTION dbo.FunBindexCustClassCOR(
 @custClass VARCHAR(15),
 @tanggal DATETIME
)
RETURNS FLOAT
AS
BEGIN
	DECLARE @total FLOAT;
	SET @total =(SELECT --c.CustomerID,s.shipdate,d.UnitPrice,d.Quantity,d.discpercen,
COALESCE(SUM(((d.Quantity*d.unitprice)-(((d.Quantity*d.unitprice)*d.discpercen)/100))),0) AS total 
FROM [lampeberger].[dbo].[customer] c
 INNER JOIN [lampeberger].[dbo].[SOTRANSACTION] as s
 ON s.CustomerID=c.CustomerID
 RIGHT JOIN  [lampeberger].[dbo].[SOTRANSACTIONDETAIL] as d
 ON d.SOTransacID =s.SOTransacID
 WHERE  c.CustomerClass =@custClass AND s.flagcancelso IS NULL
 AND  convert(datetime,s.shipdate ,103)=convert(datetime,@tanggal ,103));
	
	
	
    RETURN @total;
END
GO  

PRINT dbo.FunBindexCustClassCOR('COR','2024/08/05')