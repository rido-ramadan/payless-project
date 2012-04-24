/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller.User;

/**
 *
 * @author Edgar Drake
 */
import Model.MySQLConnect;
import Model.User;
import java.sql.*;

public class UserDAO {

    static ResultSet rs = null;

    public static User login(User bean) {
        //preparing some objects for connection 
        MySQLConnect mySQL;
//        Statement statement = null;

        String username = bean.getUsername();
        String password = bean.getPassword();

        String searchQuery = "select * from USER where USERNAME='" + username + "' and PASSWORD='" + password + "'";

        // "System.out.println" prints in the console; Normally used to trace the process
        System.out.println("Your user name is " + username);
        System.out.println("Your password is " + password);
        System.out.println("Query: " + searchQuery);

        try {
            mySQL = new MySQLConnect();
            mySQL.connect();
            rs = mySQL.executeQuery(searchQuery);
//            statement = mySQL.createStatement();
//            rs = statement.executeQuery(searchQuery);
            boolean more = rs.next();

            // if user does not exist set the isValid variable to false
            if (!more) {
                System.out.println("Sorry, you are not a registered user! Please sign up first");
                bean.setValid(false);
            } //if user exists set the isValid variable to true
            else if (more) {
                String name = rs.getString("NAMA");
                System.out.println("Welcome " + name);

                bean.setID_User(rs.getInt("ID_USER"));
                bean.setName(name);
                bean.setEmail(rs.getString("EMAIL"));
                bean.setBirthdate(rs.getDate("TGL_LAHIR"));
                bean.setAvatar(rs.getString("AVATAR"));
                bean.setGender(rs.getString("GENDER"));
                bean.setAboutMe(rs.getString("ABOUT_ME"));
                bean.setValid(true);
            }
//            if (statement != null) {
//                try {
//                    statement.close();
//                } catch (Exception e) {
//                }
//                statement = null;
//            }
            mySQL.close();
        } catch (Exception ex) {
            System.out.println("Log In failed: An Exception has occurred! " + ex);
            ex.printStackTrace();
        } //some exception handling
        finally {
            if (rs != null) {
                try {
                    rs.close();
                } catch (Exception e) {
                }
                rs = null;
            }
//            if (statement != null) {
//                try {
//                    statement.close();
//                } catch (Exception e) {
//                }
//                statement = null;
//            }
        }
        return bean;

    }
}