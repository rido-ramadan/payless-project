package Model;

import Model.QueryResult;
import java.sql.Statement;
import java.sql.Array;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

/*
 * To change this template, choose Tools | Templates and open the template in
 * the editor.
 */
public class MySQLConnect {

    private String connectionURL = "jdbc:mysql://localhost:3306/progin_171_13509078";
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
    public void connectAble(Connection conn) throws Exception {
        conn = DriverManager.getConnection(connectionURL, username, password);
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
    
    public Statement createStatement() throws SQLException {
        return connection.createStatement();
    }

    public static String[] query2(String mQuery){
        String[] result = null;
        try{
            MySQLConnect mysql = new MySQLConnect();
            mysql.connect();
            ResultSet rs = mysql.executeQuery(mQuery);
            System.out.println("jumlah row="+rs.getRow());
            // Get the column names; column indices start from 1
            for (int i=1; i<rs.getMetaData().getColumnCount()+1; i++) {
                String columnName = rs.getMetaData().getColumnName(i);
                System.out.println("column:"+columnName);
            }
            int i=0;
                    System.out.println("column:");
            while (rs.next()) {
                System.out.println(rs.getString("GENDER")+"aaa");
                ResultSet rsa = mysql.executeQuery("select * from konten where ID_USER="+rs.getString("ID_USER"));
                System.out.println("column:");
                while (rsa.next()) {
                    System.out.println(rsa.getString("ID_KONTEN"));                
                }
                i++;
            }
            System.out.println("AAAAAAAAAAAAAAAAAAAAAAAAA");
            i=0;
            while (rs.next()) {
                //System.out.println(rs.getString("ID_USER")+"aaa");
                ResultSet rsa = mysql.executeQuery("select * from konten where ID_USER="+rs.getString("ID_USER"));
                System.out.println("column:");
                while (rsa.next()) {
                    //System.out.println(rsa.getString("ID_KONTEN"));                
                }
                i++;
            }
            System.out.println("column:");
        }catch(Exception ex){
            System.out.println("EXCEPTION : "+ex);
        }
        return result;
    }

    public static QueryResult query(String mQuery){
        QueryResult result = null;
        result = new QueryResult();
        boolean debug = false;
        try{
            MySQLConnect mysql = new MySQLConnect();
            mysql.connect();
            String[] columnName;
            String[][] content;
            ResultSet rs = mysql.executeQuery(mQuery);
            rs.last();
            int countRow = rs.getRow();
            rs.beforeFirst();
            if(countRow>0){
                if(debug) System.out.println("jumlah row="+countRow);
                if(debug) System.out.println("jumlah column:"+rs.getMetaData().getColumnCount());
                columnName = new String[rs.getMetaData().getColumnCount()];
                content= new String[countRow][rs.getMetaData().getColumnCount()];
                // Get the column names; column indices start from 1
                for (int i=1; i<rs.getMetaData().getColumnCount()+1; i++) {
                    columnName[i-1] = rs.getMetaData().getColumnName(i);
                    if(debug) System.out.println("column:"+columnName[i-1]);
                }
                int j=0;
                while (rs.next()) {
                    for (int i=0; i<columnName.length; i++) {
                        content[j][i] = rs.getString(i+1); 
                        if(debug) System.out.print("get="+rs.getString(i+1));
                        if(debug) System.out.print(i+":"+j+"."+content[j][i]+" ");
                    }
                    if(debug) System.out.println("");
                    j++;
                }
                result.setColumnName(columnName);
                result.setContent(content);
            }
            result.setCountRow(countRow);
        }catch(Exception ex){
            System.out.println("EXCEPTION : "+ex);
        }
        return result;
    }
    
    public static QueryResult query(MySQLConnect conn, String mQuery){
        QueryResult result = null;
        result = new QueryResult();
        boolean debug = false;
        try{
            MySQLConnect mysql = conn;
            String[] columnName;
            String[][] content;
            ResultSet rs = mysql.executeQuery(mQuery);
            rs.last();
            int countRow = rs.getRow();
            rs.beforeFirst();
            if(countRow>0){
                if(debug) System.out.println("jumlah row="+countRow);
                if(debug) System.out.println("jumlah column:"+rs.getMetaData().getColumnCount());
                columnName = new String[rs.getMetaData().getColumnCount()];
                content= new String[countRow][rs.getMetaData().getColumnCount()];
                // Get the column names; column indices start from 1
                for (int i=1; i<rs.getMetaData().getColumnCount()+1; i++) {
                    columnName[i-1] = rs.getMetaData().getColumnName(i);
                    if(debug) System.out.println("column:"+columnName[i-1]);
                }
                int j=0;
                while (rs.next()) {
                    for (int i=0; i<columnName.length; i++) {
                        content[j][i] = rs.getString(i+1); 
                        if(debug) System.out.print("get="+rs.getString(i+1));
                        if(debug) System.out.print(i+":"+j+"."+content[j][i]+" ");
                    }
                    if(debug) System.out.println("");
                    j++;
                }
                result.setColumnName(columnName);
                result.setContent(content);
            }
            result.setCountRow(countRow);
        }catch(Exception ex){
            System.out.println("EXCEPTION : "+ex);
        }
        return result;
    }

    public static boolean sQuery(String mQuery){
        boolean result = false;
        try {
            MySQLConnect mysql = new MySQLConnect();
            mysql.connect();
            try{
                mysql.executeUpdate(mQuery);
                result = true;
            }catch(Exception ex){
                System.out.println("exception : "+ex);
            }
            mysql.close();
        } catch (Exception ex) {
            System.out.println("exception : "+ex);
        }
        return result;
    }
    public static void main(String[] Args) throws Exception {
        QueryResult QR= MySQLConnect.query("select * from user"); 
        if(QR.count()>0){
            for(int i=0;i<QR.count();i++){
                System.out.println(QR.get(i, "TGL_LAHIR"));
            }
        }
        if(MySQLConnect.sQuery("INSERT INTO tag (ID_TAG, NAMA_TAG) VALUES('16', 'rajin')"))
            System.out.println("true");else System.out.println("false");
//        MySQLConnect.query("SELECT * from user");
//        
//        MySQLConnect mysql = new MySQLConnect();
//        mysql.connect();
//        try{
//            ResultSet rs = mysql.executeQuery("SELECT * FROM user");
//            while (rs.next()) {
//                System.out.println(rs.getString("GENDER"));
//            }
//        }catch(Exception ex){
//            System.out.println("exception : "+ex);
//        }
//        
//        try{
//            mysql.executeUpdate("INSERT INTO tag (ID_TAG, NAMA_TAG) VALUES('15', 'belajar')");
//                }catch(Exception ex){
//                    System.out.println("exception : "+ex);
//                    
//                }
//        mysql.close();
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
