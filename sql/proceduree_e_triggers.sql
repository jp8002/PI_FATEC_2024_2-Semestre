delimiter $$

CREATE OR REPLACE PROCEDURE atualiza_estoque(IN id_epi INT, IN quantidade INT,  IN acao char)
	begin
		
		if acao = "R" then
			UPDATE epis SET estoque = estoque - quantidade WHERE id = id_epi; 
		
		ELSEif acao = "D" then
			UPDATE epis SET estoque = estoque + quantidade WHERE id = id_epi; 
		end if;
	END$$

delimiter ;

delimiter $$

create or replace TRIGGER TRG_retirada_epi after insert ON funcionarios_retira for each ROW
	BEGIN 
	
		CALL atualiza_estoque(NEW.epis_id, NEW.quantidade ,"R");
	
	END$$

delimiter ;


delimiter $$

CREATE OR REPLACE PROCEDURE registrar_saida(in idepi int, in idalmoxarife int, in nquantidade INT, in id_funcionario INT)
	BEGIN 
		
		INSERT INTO funcionarios_retira (epis_id, almoxarife_id, data_retirada, quantidade, funcionarios_idfuncionario)
				 VALUES (idepi, idalmoxarife, NOW(), nquantidade, id_funcionario);
	
	END$$
delimiter ; 

delimiter $$

CREATE OR REPLACE TRIGGER TGR_devolve_epi AFTER UPDATE ON funcionarios_retira FOR EACH ROW
	begin
		
		CALL atualiza_estoque(OLD.epis_id, old.quantidade, "D");
	
	END$$

delimiter ;


delimiter $$

CREATE OR REPLACE PROCEDURE registrar_devolucao(IN id_retirada INT, IN comentario CHAR(255))

  begin
  
  	UPDATE funcionarios_retira  SET devolvido = 1, data_devolucao	= NOW(), comentario_devolucao = comentario WHERE id = id_retirada;  
  
  END$$

delimiter ; 

delimiter $$

CREATE OR REPLACE PROCEDURE ver_entradas()

BEGIN

	SELECT fr.id, f.nome_funcionario, e.nome, fr.data_retirada, fr.data_devolucao, fr.comentario_devolucao 
	FROM funcionarios_retira fr, epis e, funcionarios f 
	where fr.funcionarios_idfuncionario = f.idfuncionario and fr.epis_id = e.id and fr.devolvido = 1; 

END$$

delimiter ;

delimiter $$

CREATE OR REPLACE PROCEDURE ver_saidas()

BEGIN

	SELECT fr.id, e.nome, f.nome_funcionario, fr.quantidade, fr.data_retirada, a.usuario 
	FROM funcionarios_retira fr, almoxarife a, epis e, funcionarios f 
	WHERE fr.epis_id = e.id and fr.almoxarife_id = a.id and fr.funcionarios_idfuncionario = f.idfuncionario;

END $$

delimiter ;

delimiter $$

CREATE OR REPLACE PROCEDURE ver_estoque(IN pesquisa CHAR(45))

BEGIN

	SELECT * FROM epis e WHERE e.nome like pesquisa;

END $$

delimiter ;


delimiter $$


CREATE OR REPLACE PROCEDURE cadastrar_fornecedor(IN nome CHAR(100), IN cnpj CHAR(14), telefone CHAR(11))

BEGIN

	INSERT INTO fornecedor VALUES("", nome, cnpj, telefone);

END$$


delimiter ;

delimiter $$


CREATE OR REPLACE PROCEDURE cadastrar_funcionario(IN nome CHAR(25))

BEGIN

	INSERT INTO funcionarios VALUES("", nome);

END$$


delimiter ;

delimiter $$

CREATE OR REPLACE TRIGGER TGR_compra_epi AFTER INSERT ON compras FOR EACH ROW
	begin
		
		UPDATE epis e SET estoque = estoque + NEW.quantidade WHERE NEW.epis_id= e.id;
	
	END$$

delimiter ;

