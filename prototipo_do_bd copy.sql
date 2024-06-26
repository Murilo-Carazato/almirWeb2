--requisição q mostra o quanto custa cada um dos pedidos dos produtos q o usuário fez
SELECT 
	u.id AS user_id,
    u.name AS user_name,
    p.description AS product_description,
    COUNT(o.id) AS total_orders,
    SUM(CASE WHEN u.type = 'admin' THEN o.total_price ELSE 0 END) AS total_admin_costs,
    SUM(CASE WHEN u.type = 'client' THEN o.total_price ELSE 0 END) AS total_client_costs
FROM 
    almirweb.order o
JOIN 
    almirweb.user u ON o.user_id = u.id
JOIN 
    almirweb.product p ON o.product_id = p.id
GROUP BY 
	u.id,
    u.name,
    p.description
