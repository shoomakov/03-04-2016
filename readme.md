```SQL
SELECT t1.active_scompany, t2.id, t2.name2
substring_index(t2.name2, '«', -1) as new_name,
  FROM strahovye AS t1
  INNER JOIN scompany AS t2 ON t1.active_scompany=t2.id
  ORDER BY new_name ASC
```
