import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.LinkedList;

public class CervejaDAO {
private Connection conexao;
	
	public CervejaDAO() {
		this.conexao = Conexao.getConexao();
	}
	
public boolean adicionar(Cerveja cerv) {
		
	String sql = "INSERT INTO cerveja (nome, tipo, teor_alcolico, IBU, pais_origem, fabricante, data_degustacao, avaliacao, comentarios, img,iduser) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
		try {
			PreparedStatement stmt = (PreparedStatement) this.conexao.prepareStatement(sql);
			
			stmt.setString(1, cerv.getNome());
            stmt.setString(2, cerv.getTipo());
            stmt.setInt(3, cerv.getTeor_alcolico());
            stmt.setInt(4, cerv.getIBU());
            stmt.setString(5, cerv.getPais_origem());
            stmt.setString(6, cerv.getFabricante());
            stmt.setDate(7, cerv.getData_Degustacao());
            stmt.setDouble(8, cerv.getAvaliacao());
            stmt.setString(9, cerv.getComentarios());
            stmt.setString(10, cerv.getImg());
            stmt.setInt(11, cerv.getIduser());
			stmt.execute();
			stmt.close();
			return true;
		}catch(SQLException e) {
			System.out.println(e);
			return false;
		}
	}

public LinkedList<Cerveja> listar(int id) {
	String sql = "SELECT * FROM cerveja WHERE iduser = ?";
	
	try {
		LinkedList<Cerveja> cervejas = new LinkedList<Cerveja>();
		PreparedStatement stmt = this.conexao.prepareStatement(sql);
		stmt.setInt(1, id);
		ResultSet rs = stmt.executeQuery();

		while (rs.next()) {
			
			Cerveja c = new Cerveja(rs.getString("nome"),
	                rs.getString("tipo"),
	                rs.getInt("teor_alcolico"),
	                rs.getInt("IBU"),
	                rs.getString("pais_origem"),
	                rs.getString("fabricante"),
	                rs.getDate("data_degustacao"),
	                rs.getDouble("avaliacao"),
	                rs.getString("comentarios"),
	                rs.getString("img"));
			c.setId(rs.getInt("id"));				

			cervejas.add(c);
		}
		rs.close();
		stmt.close();
		return cervejas;
	} catch (SQLException e) {
		throw new RuntimeException(e);
	}
}

public LinkedList<Cerveja> listarPorNota(int id) {
	String sql = "SELECT * FROM cerveja WHERE iduser = ? ORDER BY avaliacao DESC";
	
	try {
		LinkedList<Cerveja> cervejas = new LinkedList<Cerveja>();
		PreparedStatement stmt = this.conexao.prepareStatement(sql);
		stmt.setInt(1, id);
		ResultSet rs = stmt.executeQuery();

		while (rs.next()) {
			
			Cerveja c = new Cerveja(rs.getString("nome"),
	                rs.getString("tipo"),
	                rs.getInt("teor_alcolico"),
	                rs.getInt("IBU"),
	                rs.getString("pais_origem"),
	                rs.getString("fabricante"),
	                rs.getDate("data_degustacao"),
	                rs.getDouble("avaliacao"),
	                rs.getString("comentarios"),
	                rs.getString("img"));
			c.setId(rs.getInt("id"));				

			cervejas.add(c);
		}
		rs.close();
		stmt.close();
		return cervejas;
	} catch (SQLException e) {
		throw new RuntimeException(e);
	}
}



public LinkedList<Object[]> listarDegustacaoMensal(int id) {
    String sql = "SELECT TO_CHAR(data_degustacao, 'MM/YYYY') as mes_ano, COUNT(*) as quantidade " +
                 "FROM cerveja WHERE iduser = ? GROUP BY mes_ano ORDER BY mes_ano DESC";
    
    try {
        LinkedList<Object[]> resultado = new LinkedList<>();
        PreparedStatement stmt = this.conexao.prepareStatement(sql);
        stmt.setInt(1, id);
        ResultSet rs = stmt.executeQuery();

        while (rs.next()) {
            resultado.add(new Object[]{
                rs.getString("mes_ano"),
                rs.getInt("quantidade")
            });
        }
        rs.close();
        stmt.close();
        return resultado;
    } catch (SQLException e) {
        System.out.print(e);
    }
	return null;
}

public LinkedList<Cerveja> listarFiltroDate(int id,Date data) {
	String sql = "SELECT * FROM cerveja WHERE iduser = ? AND  data_degustacao = ?";
	
	try {
		LinkedList<Cerveja> cervejas = new LinkedList<Cerveja>();
		PreparedStatement stmt = this.conexao.prepareStatement(sql);
		stmt.setInt(1, id);
		stmt.setDate(2, data);
		ResultSet rs = stmt.executeQuery();

		while (rs.next()) {
			
			Cerveja c = new Cerveja(rs.getString("nome"),
	                rs.getString("tipo"),
	                rs.getInt("teor_alcolico"),
	                rs.getInt("IBU"),
	                rs.getString("pais_origem"),
	                rs.getString("fabricante"),
	                rs.getDate("data_degustacao"),
	                rs.getDouble("avaliacao"),
	                rs.getString("comentarios"),
	                rs.getString("img"));
			c.setId(rs.getInt("id"));				

			cervejas.add(c);
		}
		rs.close();
		stmt.close();
		return cervejas;
	} catch (SQLException e) {
		throw new RuntimeException(e);
	}
}

public LinkedList<Cerveja> listarFiltroNota(int id,double avaliacao) {
	String sql = "SELECT * FROM cerveja WHERE iduser = ? AND  avaliacao = ?";
	
	try {
		LinkedList<Cerveja> cervejas = new LinkedList<Cerveja>();
		PreparedStatement stmt = this.conexao.prepareStatement(sql);
		stmt.setInt(1, id);
		stmt.setDouble(2, avaliacao);
		ResultSet rs = stmt.executeQuery();

		while (rs.next()) {
			
			Cerveja c = new Cerveja(rs.getString("nome"),
	                rs.getString("tipo"),
	                rs.getInt("teor_alcolico"),
	                rs.getInt("IBU"),
	                rs.getString("pais_origem"),
	                rs.getString("fabricante"),
	                rs.getDate("data_degustacao"),
	                rs.getDouble("avaliacao"),
	                rs.getString("comentarios"),
	                rs.getString("img"));
			c.setId(rs.getInt("id"));				

			cervejas.add(c);
		}
		rs.close();
		stmt.close();
		return cervejas;
	} catch (SQLException e) {
		throw new RuntimeException(e);
	}
}

public Cerveja buscarPorId(int id) {
    String sql = "SELECT * FROM cerveja WHERE id = ?";
    
    try {
        PreparedStatement stmt = this.conexao.prepareStatement(sql);
        stmt.setInt(1, id);
        ResultSet rs = stmt.executeQuery();

        if (rs.next()) {
            return new Cerveja(
                rs.getString("nome"),
                rs.getString("tipo"),
                rs.getInt("teor_alcolico"),
                rs.getInt("IBU"),
                rs.getString("pais_origem"),
                rs.getString("fabricante"),
                rs.getDate("data_degustacao"),
                rs.getDouble("avaliacao"),
                rs.getString("comentarios"),
                rs.getString("img")
            );
        }
        rs.close();
        stmt.close();
        return null;
    } catch (SQLException e) {
        throw new RuntimeException(e);
    }
}

public boolean editar(int id, Cerveja cerv) {
    String sql = "UPDATE cerveja SET nome = ?, tipo = ?, teor_alcolico = ?, IBU = ?, pais_origem = ?,"
    		+ " fabricante = ?, data_degustacao = ?, avaliacao = ?, comentarios = ?, img = ? WHERE id = ?";
    
    try {
        PreparedStatement stmt = this.conexao.prepareStatement(sql);
        
        stmt.setString(1, cerv.getNome());
        stmt.setString(2, cerv.getTipo());
        stmt.setInt(3, cerv.getTeor_alcolico());
        stmt.setInt(4, cerv.getIBU());
        stmt.setString(5, cerv.getPais_origem());
        stmt.setString(6, cerv.getFabricante());
        stmt.setDate(7, cerv.getData_Degustacao());
        stmt.setDouble(8, cerv.getAvaliacao());
        stmt.setString(9, cerv.getComentarios());
        stmt.setString(10, cerv.getImg());
        stmt.setInt(11, id);
        
        int rowsAffected = stmt.executeUpdate();
        stmt.close();
        return rowsAffected > 0;
    } catch(SQLException e) {
        return false;
    }
}


public LinkedList<Object[]> listarMediaPorTipo(int id) {
    String sql = "SELECT tipo, AVG(avaliacao) as media, COUNT(*) as quantidade " +
                 "FROM cerveja WHERE iduser = ? GROUP BY tipo ORDER BY media DESC";
    
    try {
        LinkedList<Object[]> resultado = new LinkedList<>();
        PreparedStatement stmt = this.conexao.prepareStatement(sql);
        stmt.setInt(1, id);
        ResultSet rs = stmt.executeQuery();

        while (rs.next()) {
            resultado.add(new Object[]{
                rs.getString("tipo"),
                rs.getDouble("media"),
                rs.getInt("quantidade")
            });
        }
        rs.close();
        stmt.close();
        return resultado;
    } catch (SQLException e) {
        throw new RuntimeException(e);
    }
}




public LinkedList<Cerveja> listarPorNome(int id) {
    String sql = "SELECT * FROM cerveja WHERE iduser = ? ORDER BY nome ASC";
    
    try {
        LinkedList<Cerveja> cervejas = new LinkedList<Cerveja>();
        PreparedStatement stmt = this.conexao.prepareStatement(sql);
        stmt.setInt(1, id);
        ResultSet rs = stmt.executeQuery();

        while (rs.next()) {
            Cerveja c = new Cerveja(
                rs.getString("nome"),
                rs.getString("tipo"),
                rs.getInt("teor_alcolico"),
                rs.getInt("IBU"),
                rs.getString("pais_origem"),
                rs.getString("fabricante"),
                rs.getDate("data_degustacao"),
                rs.getDouble("avaliacao"),
                rs.getString("comentarios"),
                rs.getString("img")
            );
            c.setId(rs.getInt("id"));
            cervejas.add(c);
        }
        rs.close();
        stmt.close();
        return cervejas;
    } catch (SQLException e) {
        throw new RuntimeException(e);
    }
}

public LinkedList<Cerveja> listarPorPais(int id) {
    String sql = "SELECT * FROM cerveja WHERE iduser = ? ORDER BY pais_origem ASC";
    
    try {
        LinkedList<Cerveja> cervejas = new LinkedList<Cerveja>();
        PreparedStatement stmt = this.conexao.prepareStatement(sql);
        stmt.setInt(1, id);
        ResultSet rs = stmt.executeQuery();

        while (rs.next()) {
            Cerveja c = new Cerveja(
                rs.getString("nome"),
                rs.getString("tipo"),
                rs.getInt("teor_alcolico"),
                rs.getInt("IBU"),
                rs.getString("pais_origem"),
                rs.getString("fabricante"),
                rs.getDate("data_degustacao"),
                rs.getDouble("avaliacao"),
                rs.getString("comentarios"),
                rs.getString("img")
            );
            c.setId(rs.getInt("id"));
            cervejas.add(c);
        }
        rs.close();
        stmt.close();
        return cervejas;
    } catch (SQLException e) {
        throw new RuntimeException(e);
    }
}

public LinkedList<Cerveja> listarPorData(int id) {
    String sql = "SELECT * FROM cerveja WHERE iduser = ? ORDER BY data_degustacao DESC";
    
    try {
        LinkedList<Cerveja> cervejas = new LinkedList<Cerveja>();
        PreparedStatement stmt = this.conexao.prepareStatement(sql);
        stmt.setInt(1, id);
        ResultSet rs = stmt.executeQuery();

        while (rs.next()) {
            Cerveja c = new Cerveja(
                rs.getString("nome"),
                rs.getString("tipo"),
                rs.getInt("teor_alcolico"),
                rs.getInt("IBU"),
                rs.getString("pais_origem"),
                rs.getString("fabricante"),
                rs.getDate("data_degustacao"),
                rs.getDouble("avaliacao"),
                rs.getString("comentarios"),
                rs.getString("img")
            );
            c.setId(rs.getInt("id"));
            cervejas.add(c);
        }
        rs.close();
        stmt.close();
        return cervejas;
    } catch (SQLException e) {
        throw new RuntimeException(e);
    }
}
}
