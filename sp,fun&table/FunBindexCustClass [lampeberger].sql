ALTER FUNCTION dbo.FunBindexCustClass
(
    @custClass VARCHAR(15),  -- Kelas pelanggan
    @tanggal DATETIME        -- Tanggal transaksi
)
RETURNS FLOAT
AS
BEGIN
    DECLARE @total FLOAT;

    -- Hitung total berdasarkan CustomerClass dan tanggal pengiriman
    SET @total = (
        SELECT COALESCE(SUM(
            (d.Quantity * d.UnitPrice) - ((d.Quantity * d.UnitPrice * d.DiscPercen) / 100)
        ), 0) AS Total
        FROM [lampeberger].[dbo].[customer] c
        INNER JOIN [lampeberger].[dbo].[SOTRANSACTION] s
            ON s.CustomerID = c.CustomerID
        RIGHT JOIN [lampeberger].[dbo].[SOTRANSACTIONDETAIL] d
            ON d.SOTransacID = s.SOTransacID
        WHERE c.CustomerClass = @custClass 
          AND s.FlagCancelSO IS NULL
          AND CONVERT(DATETIME, s.ShipDate, 103) = CONVERT(DATETIME, @tanggal, 103)
    );

    -- Kembalikan hasil total
    RETURN @total;
END;
GO
PRINT dbo.FunBindexCustClass('DEA','2024/11/18')