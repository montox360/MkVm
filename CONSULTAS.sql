SELECT E.IdCliente, E.Codigo, C.Nombre, A.Descripcion FROM [GALENA_MK].[dbo].[ExpedientesPrimarios] as E, 
[GALENA_MK].[dbo].[Tareas] as T, 
[GALENA_MK].[dbo].[Agendas] as A,
[GALENA_MK].[dbo].[Clientes] as C
WHERE E.Tipo = 'MARCA' AND E.Inactivo = 0 AND E.Id = A.IdExpediente AND A.Id = T.IdAgenda AND T.Completada = 0
AND T.Vencimiento < DATEADD(month, 6, GETDATE()) AND T.Vencimiento > (GETDATE()) AND E.IdCliente = C.Id AND C.IdPais != 434
AND (A.Descripcion = 'RENOVACIÓN (10 años)' OR A.Descripcion = 'RENOVACION') 
GROUP BY C.Nombre, E.Codigo, E.IdCliente, A.Descripcion