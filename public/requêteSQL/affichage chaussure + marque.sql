-- Active: 1794173388340@@gateway01.eu-central-1.prod.aws.tidbcloud.com@4000@gestion_chaussures
select * FROM chaussure
c inner join marque m 
on c.idMarque = m.idMarque
where c.idChaussure = 1;
