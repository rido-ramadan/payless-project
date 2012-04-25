package Model;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Marchy Panggabean
 */
import java.io.*;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.text.SimpleDateFormat;
import java.text.ParseException;

public class userData {
    String username;
    String name;
    String password;
    String confirm;
    String email;
    String birthdate;
    File avatar;
    String gender;
    String status;
    String about;
    int age;
    
    public userData(){
        this.username = "";
        this.name = "";
        this.password = "";
        this.confirm = "";
        this.email = "";
        this.birthdate = "";
        this.gender = "";
        this.status = "";
        this.about = "";
    }
    
    public void setUsername(String username){
        this.username = username;
    }
    
    public void setName(String name){
        this.name = name;
    }
    
    public void setPassword(String password){
        this.password = password;
    }
    
    public void setConfirm(String confirm){
        this.confirm = confirm;   
    }
    
    public void setEmail(String email){
        this.email = email;
    }
    public void setBirthdate(String birthdate){
        this.birthdate = birthdate;
    }
    
    public void setAvatar(File avatar){
        this.avatar = avatar;
    }
    
    public void setGender(String gender){
        this.gender = gender;
    }
    
    public void setStatus(String status){
        this.status = status;
    }
    
    public void setAbout (String about){
        this.about = about;
    }
    
    public String getAbout(){
        return this.about;
    }
    
    public File getAvatar(){
        return this.avatar;
    }
    
    public String getBirthdate(){
        return this.birthdate;
    }
    
    public String getConfirm(){
        return this.confirm;
    }
    
    public String getEmail(){
        return this.email;
    }
    
    public String getGender(){
        return this.gender;
    }
    
    public String getName(){
        return this.name;
    }
    
    public String getPassword(){
        return this.password;
    }
    
    public String getStatus(){
        return this.status;
    }
    
    public String getUsername(){
        return this.username;
    }
    public static boolean checkUsername(String username) {
        QueryResult qr = MySQLConnect.query("select * from user where USERNAME=\""+username+"\"");
        if(qr.count()>0){
            return true;
        }else
            return false;
        }
    public static boolean checkEmail(String email){
        QueryResult qr = MySQLConnect.query("select * from user where EMAIL=\""+email+"\"");
        if(qr.count()>0){
            return true;
        }else
            return false;
    }
    
    public static boolean checkDate(String inDate) {

    if (inDate == null)
      return false;

    //set the format to use as a constructor argument
    SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
    
    if (inDate.trim().length() != dateFormat.toPattern().length())
      return false;

    dateFormat.setLenient(false);
    
    try {
      //parse the inDate parameter
      dateFormat.parse(inDate.trim());
    }
    catch (ParseException pe) {
      return false;
    }
    return true;
  }
}
