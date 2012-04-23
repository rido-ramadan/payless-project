package Model;

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

    private String connectionURL = "jdbc:mysql://localhost:3306/progin_171_13509078";
    private Connection connection = null;
    private String username = "root";
    private String password = "";
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

    public static String[] query(String mQuery){
        String[] result = null;
        return result;
    }
    
    public static void main(String[] Args) throws Exception {
        MySQLConnect mysql = new MySQLConnect();
        mysql.connect();
        ResultSet rs = mysql.executeQuery("SELECT * FROM user");
        while (rs.next()) {
            System.out.println(rs.getString("GENDER"));
        }
        
        try{
            mysql.executeUpdate("INSERT INTO tag (ID_TAG, NAMA_TAG) VALUES('15', 'belajar')");
                }catch(Exception ex){
                    System.out.println("exception : "+ex);
                    
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
