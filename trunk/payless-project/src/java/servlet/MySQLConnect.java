package servlet;

import java.beans.Statement;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

/*
 * To change this template, choose Tools | Templates and open the template in
 * the editor.
 */
/**
 *
 * @author FAISAL
 */
public class MySQLConnect {

    private String connectionURL = "jdbc:mysql://localhost:3306/progin_171_13509048";
    private Connection connection = null;
    private String username = "progin";
    private String password = "progin";
    private Object driver;

    public MySQLConnect() throws Exception {
        driver = Class.forName("com.mysql.jdbc.Driver").newInstance();
    }

    public void connect() throws Exception {
        connection = DriverManager.getConnection(connectionURL, username, password);
    }

    public ResultSet executeQuery(String query) throws Exception {
        Connection _connection = getConnection();
        PreparedStatement st = _connection.prepareStatement(query);
        ResultSet rs = st.executeQuery();
        return rs;
    }

    public int executeUpdate(String query) throws Exception {
        Connection _connection = getConnection();
        PreparedStatement st = _connection.prepareStatement(query);
        int affected = st.executeUpdate();
        return affected;
    }

    public void close() throws Exception {
        connection.close();
    }

    public Connection getConnection() {
        return connection;
    }

    public static void main(String[] Args) throws Exception {
        MySQLConnect mysql = new MySQLConnect();
        mysql.connect();
        ResultSet rs = mysql.executeQuery("SELECT * FROM post WHERE ID_post='3'");
        while (rs.next()) {
            System.out.println(rs.getString("judul"));
        }
        mysql.close();
    }

//    public static ArrayList<Post> getPosts() throws Exception {
//        ArrayList<Post> posts = new ArrayList<Post>();
//        MySQLConnect mysql = new MySQLConnect();
//        mysql.connect();
//        ResultSet result = mysql.executeQuery("SELECT * FROM post");
//        while (result.next()) {
//            Post post = new Post(result.getInt("ID_post"), result.getString("judul"), result.getString("konten_link"), result.getString("konten_deskripsi"), result.getDate("Time"), result.getTime("Time"), result.getString("tipe"), result.getString("username"));
//            posts.add(post);
//        }
//        mysql.close();
//        return posts;
//    }
}
