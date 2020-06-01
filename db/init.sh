sudo mysql -u root -e "CREATE DATABASE univille"
sleep 1
sudo mysql -u root -e "Create table usuarios (
ID Int UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT primary key,
login Varchar(30),
senha Varchar(40));"
sleep 1
sudo mysql -u root -e "create table lista_de_jogos( 
idjogo Int UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT primary key, 
idusuario int UNSIGNED ZEROFILL NOT NULL, nomejogo Varchar(30), data_insercao date, 
CONSTRAINT FK_iduser FOREIGN KEY (idusuario)
    REFERENCES usuarios(id));"
sleep 1
sudo mysql -u root -e "GRANT ALL PRIVILEGES ON univille.* TO 'root'@'%' WITH GRANT OPTION; "
sleep 1
sudo mysql -u root -e "FLUSH PRIVILEGES;"